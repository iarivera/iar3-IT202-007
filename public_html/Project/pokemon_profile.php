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
        <div class="card-header text-center">
            <?php se($mons); ?>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col">
                    <h5 class="card-title"><?php se($mons, "name"); ?> - <?php se($mons, "type_1"); ?>  - <?php se($mons, "type_2"); ?></h5>
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
                    <div><strong>Pokemon: </strong><?php se($mons); ?></div>
                </div>
            </div>
        </div>
    </div>
    <?php
    require_once(__DIR__ . "/../../partials/footer.php");
    ?>