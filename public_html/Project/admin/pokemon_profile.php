<?php
//note we need to go up 1 more directory
require(__DIR__ . "/../../../partials/nav.php");

if (!has_role("Admin")) {
    flash("You don't have permission to view this page", "warning");
    //die(header("Location: " . get_url("home.php")));
    redirect("home.php");
}

$pokemon = [];
$pokemonTypes = ["Normal", "Fire", "Water", "Electric", "Grass", "Ice", "Fighting", "Poison", "Ground", "Flying", "Psychic", "Bug", "Rock", "Ghost", "Dark", "Steel", "Dragon", "Fairy"];
$statuses = ["Caught", "Not Caught"];
$statuses = array_map(function ($v) {
    return ["label" => $v, "value" => strtolower($v)];
}, $statuses);
$result = get_pokemon();
// convert breed data to render_input's expected "options" data
$pokemon = array_map(function ($v) {
    return ["label" => $v["name"], "value" => $v["id"]];
}, $result);

$id = (int)se($_GET, "id", 0, false);
$mons = []; //mons will refer specific pokemon
if (count($_POST) > 0) {
    $mons = $_POST;
    $mons_id = -1;
    if (validate_mons($_POST)) {
        if ($id > 0) {
            if (update_data("CA_Pokemon", $id, $_POST, ["id"])) {
                $mons_id = $id;
            }
        } else {
            $mons_id = save_data("CA_Pokemon", $_POST);
        }
    }
    if ($mons_id > 0) {
        flash("Successfully set profile for " . $mons["name"], "success");
        redirect("admin/pokemon_profile.php?id=$mons_id");
    }
}

if ($id > 0) {
    $db = getDB();
    // query happens here
    $query = "SELECT name, type_1, type_2 FROM CA_Pokemon";
    $stmt = $db->prepare($query);
    try {
        $stmt->execute([":id" => $id]);
        $result = $stmt->fetch();
        if ($result) {
            $mons = $result;
            error_log("Pokemon result: " . var_export($mons, true));
        } else {
            flash("Error finding pokemon", "danger");
        }
    } catch (PDOException $e) {
        error_log("Error fetching pokemon by id: " . var_export($e, true));
        flash("An unhandled error occurred", "danger");
    }
}
?>
<div class="container-fluid>">
    <h1>Pokemon Profile</h1>
    <form method="POST">
        <?php render_input(["type" => "text", "id" => "name", "name" => "name", "label" => "Name", "rules" => ["minlength" => 2, "required" => true], "value" => se($mons, "name", "", false)]) ?>
        <?php render_input(["type" => "select", "id" => "type_1", "name" => "type_1", "label" => "Type", "rules" => ["required" => true], "options" => array_combine($pokemonTypes, $pokemonTypes), "value" => se($mons, "type_1", "Unknown", false)]); ?>
        <?php render_input(["type" => "select", "id" => "type_2", "name" => "type_2", "label" => " 2nd Type", "rules" => ["required" => false], "options" => array_combine($pokemonTypes, $pokemonTypes), "value" => se($mons, "type_2", "", false)]); ?> 
        <?php render_button(["text" => "Save", "type" => "submit"]); ?>
    </form>
</div>
<style>
    .selected {
        border: 3px solid black;
    }
</style>
<?php
//note we need to go up 1 more directory
require_once(__DIR__ . "/../../../partials/flash.php");
?>