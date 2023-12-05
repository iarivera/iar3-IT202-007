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
                </div>
            </div>
        </div>
    </div>
    <?php
    require_once(__DIR__ . "/../../partials/footer.php");
    ?>