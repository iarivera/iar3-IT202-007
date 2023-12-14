<?php
/* iar3 12/13/2023 Due to lack of time, the functionality remains the same.
It currently acts as intermediary page that simply marks a Pokemon as caught.
The plan was to make this a full fledged page, with an option to set which
user caught the Pokemon, do all the Pokemon association without an intent
request*/
require(__DIR__ . "/../../../lib/functions.php");
// don't forget to start the session if you need it since this is done in nav.php and not functions.php
if (session_status() != PHP_SESSION_ACTIVE) {
    session_start();
}
if (!has_role("Admin")) {
    error_log("Doesn't have permission");
    flash("You don't have permission to view this page", "warning");
    //die(header("Location: " . get_url("home.php")));
    redirect("home.php");
}


$id = (int)se($_GET, "id", 0, false);
if ($id <= 0) {
    flash("Invalid Pokemon", "danger");
} else {
    $db = getDB();
    $query = "UPDATE CA_Pokemon set caught = 'Caught' WHERE id = :id";
    $stmt = $db->prepare($query);
    try {
        $stmt->execute([":id" => $id]);
        flash("Successfully marked Pokemon as caught", "success");
    } catch (PDOException $e) {
        flash("Error updating Pokemon profile", "danger");
        error_log("Error setting Pokemon as caught: " . var_export($e, true));
    }
}

if (isset($_SESSION["previous"]) && strpos($_SESSION["previous"], "admin") !== false) {
    $url = "admin/list_pokemon.php";
} else {
    $url = "browse.php";
}
$url .= "?" . http_build_query($_GET);
error_log("redirecting to " . var_export($url, true));
redirect(get_url($url));