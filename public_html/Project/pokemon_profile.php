<?php /* Note this file is different than admin/cat_profile.php*/ ?>
<?php
require(__DIR__ . "/../../partials/nav.php");
$id = se($_GET, "id", -1, false);
if ($id <= 0) {
    flash("Invalid Pokemon", "danger");
    $url = "browse.php?" . http_build_query($_GET);
    error_log("redirecting to " . var_export($url, true));
    redirect(get_url($url));
}
$_GET["image_limit"] = 10;
$mons = search_mons();
$mons = $mons[0];
$pokemon_id = se($mons, "id", 0, false);
$mon = [];
if ($pokemon_id != 0) {
    $mon = get_pokemon_by_id($pokemon_id);
    error_log("Mon: " . var_export($mon, true));
}
?>
<div class="container-fluid">

    <h1>Current Pokemon</h1>
    <div class="card">
        <div class="card-header text-center">
            <?php se($mons); ?>
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
                        <?php foreach ($urls as $url) : ?>
                            <div class="col">
                                <img class="p-3" style="width: 100%; aspect-ratio: 1; object-fit: scale-down; max-height: 256px;" src="<?php se($url, null, get_url("images/missingNo.png")); ?>" />
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
                <div class="col">
                    <div><strong>About:</strong><br>
                        <?php se($mons, "description"); ?>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <h5>Info</h5>
                    <div><strong>Type 1: </strong><?php se($mons, "type_1"); ?></div>
                    <div><strong>Type 2: </strong><?php se($mons, "type_2"); ?></div>
                </div>
                <div class="col">
                </div>
            </div>
        </div>
    </div>
    <?php
    require_once(__DIR__ . "/../../partials/footer.php");
    ?>