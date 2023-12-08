<?php
require(__DIR__ . "/../../partials/nav.php");

// remove single view filter
if (isset($_GET["id"])) {
    unset($_GET["id"]);
}
$pokemon = search_mons();
?>
<div class="container-fluid">
    <h4>Pokemon</h4>
    <div class="container mx-auto">
        <div>
            <?php include(__DIR__ . "/../../partials/search_form.php"); ?>
        </div>
        <div class="row justify-content-center">
            <?php foreach ($pokemon as $mon) : ?>
                <div class="col">
                    <?php render_pokemon_list_item($mon); ?>
                </div>
            <?php endforeach; ?>
            <?php if (count($pokemon) === 0) : ?>
                <div class="col-12">
                    No Pokemon found
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

