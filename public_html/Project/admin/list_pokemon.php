<?php
//note we need to go up 1 more directory
require(__DIR__ . "/../../../partials/nav.php");

if (!has_role("Admin")) {
    flash("You don't have permission to view this page", "warning");
    redirect("home.php");
}

$mons = search_mons(); // will define later
$table = ["data" => $mons, "delete_url" => "admin/disable_pokemon_profile.php", "view_url" => "admin/pokemon_profile.php", "edit_url" => "admin/pokemon_profile.php"];

?>
<div class="container-fluid">
    <h1>List Pokemon</h1>
    <div>
        <?php include(__DIR__ . "/../../../partials/search_form.php"); ?>
    </div>
    <div>
        <?php render_table($table); ?>
    </div>
</div>

<?php
//note we need to go up 1 more directory
require_once(__DIR__ . "/../../../partials/footer.php");
?>