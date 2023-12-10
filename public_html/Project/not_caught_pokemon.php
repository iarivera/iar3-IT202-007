<?php
require_once(__DIR__ . "/../../partials/nav.php");

$search["caught"] = "Not Caught";
$search["column"] = "modified";
$search["order"] = "desc";
$mons = search_mons();

?>
<div class="container-fluid">
    <h4>Uncaught Pokemon</h4>
    <div class="container mx-auto">
        <div class="row justify-content-center">
            <?php foreach ($mons as $mon) : ?>
                <div class="col">
                    <?php render_pokemon_list_item($mon); ?>
                </div>
            <?php endforeach; ?>
            <?php if (count($mons) === 0) : ?>
                <div class="col-12">
                    All Pokemon have been caught!
                </div>
            <?php endif; ?>
        </div>
        <div class="row">
            <?php include(__DIR__ . "/../../partials/pagination_nav.php"); ?>
        </div>
    </div>
</div>
<?php
require_once(__DIR__ . "/../../partials/footer.php");
?>