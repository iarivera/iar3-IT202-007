<?php
require_once(__DIR__ . "/../../partials/nav.php");
is_logged_in(true);
?>
<?php
$my_user_id = get_user_id();
$is_edit = isset($_GET["edit"]);
$target_user_id = (int)se($_GET, "id", 0, false);
if ($target_user_id < 1) {
    $target_user_id = $my_user_id;
}
error_log("Target user id: $target_user_id");
$is_me = $my_user_id == $target_user_id;
if ($is_me && $is_edit && isset($_POST["save"])) {
    $email = se($_POST, "email", null, false);
    $username = se($_POST, "username", null, false);

    $params = [":email" => $email, ":username" => $username, ":id" => $my_user_id];
    $db = getDB();
    $stmt = $db->prepare("UPDATE Users set email = :email, username = :username where id = :id");
    try {
        $stmt->execute($params);
        flash("Profile saved", "success");
    } catch (PDOException $e) {
        if ($e->errorInfo[1] === 1062) {
            //https://www.php.net/manual/en/function.preg-match.php
            preg_match("/Users.(\w+)/", $e->errorInfo[2], $matches);
            if (isset($matches[1])) {
                flash("The chosen " . $matches[1] . " is not available.", "warning");
            } else {
                //TODO come up with a nice error message
                echo "<pre>" . var_export($e->errorInfo, true) . "</pre>";
            }
        } else {
            //TODO come up with a nice error message
            echo "<pre>" . var_export($e->errorInfo, true) . "</pre>";
        }
    }

    //check/update password
    $current_password = se($_POST, "currentPassword", null, false);
    $new_password = se($_POST, "newPassword", null, false);
    $confirm_password = se($_POST, "confirmPassword", null, false);
    if (!empty($current_password) && !empty($new_password) && !empty($confirm_password)) {
        if ($new_password === $confirm_password) {
            //TODO validate current
            $stmt = $db->prepare("SELECT password from Users where id = :id");
            try {
                $stmt->execute([":id" => $my_user_id]);
                $result = $stmt->fetch(PDO::FETCH_ASSOC);
                if (isset($result["password"])) {
                    if (password_verify($current_password, $result["password"])) {
                        $query = "UPDATE Users set password = :password where id = :id";
                        $stmt = $db->prepare($query);
                        $stmt->execute([
                            ":id" => $my_user_id,
                            ":password" => password_hash($new_password, PASSWORD_BCRYPT)
                        ]);

                        flash("Password reset", "success");
                    } else {
                        flash("Current password is invalid", "warning");
                    }
                }
            } catch (PDOException $e) {
                echo "<pre>" . var_export($e->errorInfo, true) . "</pre>";
            }
        } else {
            flash("New passwords don't match", "warning");
        }
    }
}
$db = getDB();
//select fresh data from table
$stmt = $db->prepare("SELECT id, email, username, created from Users where id = :id LIMIT 1");
try {
    $stmt->execute([":id" => $target_user_id]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($user) {
        if ($is_me && $is_edit) {
            $_SESSION["user"]["email"] = $user["email"];
            $_SESSION["user"]["username"] = $user["username"];
        }
    } else {
        flash("User doesn't exist", "danger");
    }
} catch (PDOException $e) {
    flash("An unexpected error occurred, please try again", "danger");
    error_log("Error getting profile: " . var_export($e, true));
}
$search["owner_id"] = $target_user_id;
error_log("Owner id: $target_user_id");
$mons = search_mons();
?>

<?php
$email = get_user_email();
$username = get_username();
?>
<div class="container-fluid">
    <h3>Profile</h3>
    <?php if ($is_me) : ?>
        <?php if (!$is_edit) : ?>
            <a href="?edit">Edit</a>
        <?php else : ?>
            <a href="?">View</a>
        <?php endif; ?>
    <?php endif; ?>
    <?php if ($is_me && $is_edit) : ?>
        <form method="POST" onsubmit="return validate(this);">
            <?php render_input(["type" => "email", "id" => "email", "name" => "email", "label" => "Email", "value" => $email, "rules" => ["required" => true]]); ?>
            <?php render_input(["type" => "text", "id" => "username", "name" => "username", "label" => "Username", "value" => $username, "rules" => ["required" => true, "maxlength" => 30]]); ?>
            <!-- DO NOT PRELOAD PASSWORD -->
            <div class="lead">Password Reset</div>
            <?php render_input(["type" => "password", "id" => "cp", "name" => "currentPassword", "label" => "Current Password", "rules" => ["minlength" => 8]]); ?>
            <?php render_input(["type" => "password", "id" => "np", "name" => "newPassword", "label" => "New Password", "rules" => ["minlength" => 8]]); ?>
            <?php render_input(["type" => "password", "id" => "conp", "name" => "confirmPassword", "label" => "Confirm Password", "rules" => ["minlength" => 8]]); ?>
            <?php render_input(["type" => "hidden", "name" => "save"]);/*lazy value to check if form submitted, not ideal*/ ?>
            <?php render_button(["text" => "Update Profile", "type" => "submit"]); ?>
        </form>
    <?php else : ?>
        <div class="card">
            <div class="card-body">
                <div class="card-title"><?php se($user, "username"); ?></div>
                <div class="card-text">Joined: <?php se($user, "created"); ?></div>
            </div>
            <div class="card-body">
                <div class="row justify-content-center">
                    <?php foreach ($mons as $mon) : ?>
                        <div class="col">
                            <?php render_pokemon_list_item($mon); ?>
                        </div>
                    <?php endforeach; ?>
                    <?php if (count($mons) === 0) : ?>
                        <div class="col-12">
                            No caught Pokemon
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    <?php endif; ?>
</div>
<script>
    function validate(form) {
        let pw = form.newPassword.value;
        let con = form.confirmPassword.value;
        let isValid = true;
        //TODO add other client side validation....

        //example of using flash via javascript
        //find the flash container, create a new element, appendChild
        if (!isEqual(pw, con)) {
            flash("Password and Confrim password must match", "warning");
            isValid = false;
        }
        return isValid;
    }
</script>
<?php
require_once(__DIR__ . "/../../partials/footer.php");
?>