<?php
require_once(__DIR__ . "/../../../partials/nav.php");
if (!has_role("Admin")) {
    flash("You don't have permission to view this page", "warning");
    redirect("home.php");
}
$user_id = get_user_id();
$id = (int)se($_GET, "id", -1, false);
if ($id < 1) {
    unset($_GET["id"]);
    redirect("admin/requests.php?" . http_build_query($_GET));
}
if (count($_POST) > 0) {
    $action = strtolower(se($_POST, "action", "", false));
    $query = "UPDATE CA_Intents set processor_notes = :processor_notes, processor_id = :processor_id";
    $params[":processor_notes"] = se($_POST, "processor_notes", "", false);
    $params[":processor_id"] = $user_id;
    $is_approved = false;
    $is_rejected = false;
    if (in_array($action, ["approve", "reject"])) {
        $query .= ", status = (select id FROM CA_Intent_Status WHERE label = :status LIMIT 1)";
        $params[":status"] = $action == "approve" ? "approved" : "rejected"; // my status is past tense
        $is_approved = ($action == "approve");
        $is_rejected = ($action == "reject");
    } else {
        $query .= ", status = (select id FROM CA_Intent_Status WHERE label = 'in progress' LIMIT 1)";
    }
    $query .= " WHERE id = :id";
    $params[":id"] = $id;
    $db = getDB();
    $stmt = $db->prepare($query);
    error_log("Intent query: " . var_export($query, true));
    error_log("Intent params: " . var_export($params, true));
    $db->beginTransaction();
    $did_update = false;
    try {
        $stmt->execute($params);
        $did_update = true;
    } catch (PDOException $e) {
        error_log("Error updating request $id: " . var_export($e, true));
        flash("Error updating request", "danger");
        $db->rollBack(); //rollback
    }
    if ($did_update) {
        $pokemon_id = (int)se($_POST, "pokemon_id", -1, false);
        $has_error = false;
        if ($pokemon_id < 1) {
            error_log("Invalid Pokemon id");
            flash("Invalid Pokemon id", "danger");
            $has_error = true;
        }
        if ($is_approved) {
            $owner_id = (int)se($_POST, "requestor_id", -1, false);

            if ($owner_id < 1) {
                error_log("Invalid owner/requestor id");
                flash("Invalid owner/requestor id", "danger");
                $has_error = true;
            }

            if (!$has_error) {
                //insert or update ownership
                $query = "INSERT INTO CA_Pokemon_Trainer (pokemon_id, owner_id, intent_id) VALUES (:cid, :oid, :iid) ON DUPLICATE KEY UPDATE
            owner_id = :oid, intent_id = :iid";
                $stmt = $db->prepare($query);
                try {
                    $stmt->execute([":cid" => $pokemon_id, ":oid" => $owner_id, ":iid" => $id]);
                } catch (PDOException $e) {
                    $db->rollBack(); //rollback
                    error_log("Error creating or updating Pokemon Reference: " . var_export($e, true));
                    flash("Error assigning Pokemon ownership", "danger");
                    $has_error = true;
                }
                if (!$has_error) {
                    //update the Pokemon
                    $intent_type = se($_POST, "intent_type", "unavailable", false);
                    if ($intent_type == "Catch") {
                        $intent_type = "Caught";
                    }
                    $query = "UPDATE CA_Pokemon set previous_status = caught, caught = :caught WHERE id = :cid";
                    $stmt = $db->prepare($query);
                    try {
                        $stmt->execute([":cid" => $pokemon_id, ":caught" => $intent_type]);
                        $db->commit(); //commit
                        flash("Approved request", "success");
                    } catch (PDOException $e) {
                        $db->rollBack(); //rollback
                        error_log("Error creating or updating Pokemon Trainer Reference: " . var_export($e, true));
                        flash("Error updating Pokemon profile", "danger");
                    }
                }
            } else {
                $db->rollBack();
            }
        } else if ($is_rejected) {
            if (!$has_error) {
                //update the cat
                $query = "UPDATE CA_Pokemon set caught = previous_status, previous_status = caught WHERE id = :cid";
                $stmt = $db->prepare($query);
                try {
                    $stmt->execute([":cid" => $pokemon_id]);
                    $db->commit(); //commit
                    flash("Rejected request", "success");
                } catch (PDOException $e) {
                    $db->rollBack(); //rollback
                    error_log("Error creating or updating Pokemon Reference: " . var_export($e, true));
                    flash("Error updating Pokemon profile", "danger");
                }
            } else {
                $db->rollBack();
            }
        }
    } else if ($did_update) {
        //just an intent update, no ownership/pokemon change
        $db->commit(); //commit
        flash("Updated request", "success");
    }
}


$request = search_intents();
if (count($request) == 1) {
    $request = $request[0];
}
?>

<div class="contaner-fluid">
    <form method="POST">
        <?php render_input(["type" => "hidden", "name" => "pokemon_id", "value" => se($request, "pokemon_id", -1, false)]); ?>
        <?php render_input(["type" => "hidden", "name" => "requestor_id", "value" => se($request, "requestor_id", -1, false)]); ?>
        <?php render_input(["type" => "hidden", "name" => "intent_type", "value" => se($request, "intent_type", -1, false)]); ?>
        <div class="card">
            <div class="card-header">
                <h1><?php se($request, "intent_type"); ?> - <?php se($request, "intent_status"); ?></h1>
            </div>
            <div class="card-body">
                <div class="card-title">
                    <strong>Pokemon: </strong><?php se($request, "pokemon_name"); ?>
                </div>
                <div class="card-text">
                    <strong>Last Action: </strong><?php se($request, "modified", "N/A"); ?>
                </div>
                <div class="card-text">
                    <strong>Requestor Note: </strong><?php se($request, "requestor_notes", "-"); ?>
                </div>
                <div class="card-text">
                    <strong>Processor Note: </strong>
                    <?php render_input(["type" => "textarea", "label" => "", "name" => "processor_notes", "id" => "processor_notes", "value" => se($request, "processor_notes", "", false)]); ?>
                </div>
            </div>
            <div class="card-footer">
                <div class="row justify-content-center">
                    <div class="col-auto">
                        <?php 
                        if ($request["intent_status"] == "pending")
                        {render_button(["type" => "submit", "extras" => ["name" => "action"], "text" => "Approve", "color" => "success"]);}
                        ?>
                    </div>
                    <div class="col-auto">
                    <?php 
                        if ($request["intent_status"] == "pending")
                        {render_button(["type" => "submit", "extras" => ["name" => "action"], "text" => "Reject", "color" => "danger"]);}
                    ?>
                    </div>
                        <a class="btn btn-secondary" href="requests.php">Back</a>
                    <div class="col-auto">
                        
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
<?php
require_once(__DIR__ . "/../../../partials/footer.php");
?>