<?php /* Note this file is different than admin/pokemon_profile.php*/ ?>
<?php
require(__DIR__ . "/../../partials/nav.php");
$id = se($_GET, "id", -1, false);
if ($id <= 0) {
    flash("Invalid Pokemon", "danger");
    $url = "browse.php?" . http_build_query($_GET);
    error_log("redirecting to " . var_export($url, true));
    redirect(get_url($url));
}
if (count($_POST) > 0) {
    $action = se($_POST, "action", "", false);
    $requestor_notes = se($_POST, "details", "", false);
    if (in_array($action, ["adopt", "foster"])) {
        $intent_id = create_intent($id, get_user_id(), null, $action, $requestor_notes);
        if ($intent_id > 0) {
            flash("Your request has been submitted!", "success");
        } else {
            flash("There was a problem submitting your request", "danger");
        }
    }
}
$mons = search_mons();
$mons = $mons[0];
$pokemon_id = se($mons, "id", 0, false);
$mon = [];
if ($pokemon_id != 0) {
    $mon = get_pokemon_by_id($pokemon_id);
    error_log("Pokemon: " . var_export($mon, true));
}
?>
<div class="container-fluid">

    <h1>Current Pokemon</h1>
    <div class="card">
        <div class="card-header text-left">
            <?php se($mons, "caught"); ?>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col">
                    <h5 class="card-title"><?php se($mons, "name"); ?></h5>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <div class="row">
                    <?php /* handle image*/
                        $urls = isset($mons["urls"]) ? $mons["urls"] : "";
                        error_log("urls data: " . var_export($urls, true));
                        $urls = explode(",", $urls);
                        error_log("urls data after explode:" . var_export($urls, true));
                        ?>
                        <?php foreach ($urls as $url) : ?>
                            <div class="col">
                                <img class="p-3" style="width: 100%; aspect-ratio: 1; object-fit: scale-down; max-height: 256px;" src="images/missingNo.png"; ?>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
                <div class="col">
                    <div><strong>About:</strong><br>
                        <p>
                            <?php se($mons, "name")?> is a <?php se($mons,"type_1")?>
                        <?php
                            if ($mons["type_2"] === "None" || $mons["type_2"] === "")
                            {
                                ;
                            }
                            else {
                                echo "and " . $mons["type_2"];
                            }
                        ?>
                        type pokemon from
                            <?php
                                if ($mons["id"] < 152) {
                                    echo "the Kanto";
                                }
                                elseif ($mons["id"] < 252) {
                                    echo "the Johto";
                                }
                                elseif ($mons["id"] < 387) {
                                    echo "the Hoenn";
                                }
                                elseif ($mons["id"] < 494) {
                                    echo "the Sinnoh";
                                }
                                elseif ($mons["id"] < 650) {
                                    echo "the Unova";
                                }
                                elseif ($mons["id"] < 722) {
                                    echo "the Kalos";
                                }
                                elseif ($mons["id"] < 810) {
                                    echo "the Alola";
                                }
                                elseif ($mons["id"] < 906) {
                                    echo "the Galar";
                                }
                                elseif ($mons["id"] < 1009) {
                                    echo "the Paldea";
                                }
                                else {
                                    echo "an unknown";
                                }
                            ?>
                            region.
                        </p>
                    </div>
                    <div class="col">
                        <div><strong>Type: </strong><?php render_like(["value" => se($mons, "type_1", 0, false)]); ?></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-footer">
            <div class="row">
                <button class="btn btn-success" type="button" data-bs-toggle="modal" data-bs-target="#actionModal" data-bs-action="Caught">Mark as Caught</button>
            </div>
        </div>
    </div>
    <div class="modal fade" id="actionModal" tabindex="-1" aria-labelledby="actionModal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="POST">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="actionModalLabel">Action Prompt</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">

                        <div class="mb-3">
                            <?php
                            render_input(["type" => "textarea", "name" => "details", "label" => "Request Details", "rules" => ["required" => true]]);
                            ?>
                            <?php render_input(["type" => "hidden", "id" => "action", "name" => "action", "value" => ""]); ?>
                        </div>


                    </div>
                    <div class="modal-footer">
                        <?php
                        render_button(["type" => "button", "color" => "secondary", "extras" => ["data-bs-dismiss" => "modal"], "text" => "Close"]);
                        render_button(["type" => "submit", "color" => "primary", "text" => "Submit Request"]);
                        ?>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        const actionModal = document.getElementById('actionModal')
        if (actionModal) {
            actionModal.addEventListener('show.bs.modal', event => {
                // Button that triggered the modal
                const button = event.relatedTarget;
                // Extract info from data-bs-* attributes
                const action = button.getAttribute('data-bs-action');
                // If necessary, you could initiate an Ajax request here
                // and then do the updating in a callback.
                const pokemonName = "<?php se($mons, "name"); ?>";

                // Update the modal's content.
                const modalTitle = actionModal.querySelector('.modal-title')

                modalTitle.textContent = `${action} ${catName}`
                const actionInput = actionModal.querySelector("#action");
                actionInput.value = action;
            })
        }
    </script>
    <style>
        .modal-title {
            text-transform: capitalize;
        }
    </style>
    <?php
    require_once(__DIR__ . "/../../partials/footer.php");
    ?>