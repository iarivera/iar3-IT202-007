<?php
require_once(__DIR__ . "/../../partials/nav.php");
is_logged_in(true); //login guard 
$user_id = get_user_id();

$search["owner_id"] = $user_id;
$mons = search_mons();

?>
<div class="container-fluid">
    <h4>Caught Pokemon</h4>
    <div class="container mx-auto">
        <div>
            <?php include(__DIR__ . "/../../partials/pokemon_search_form.php"); ?>
        </div>
        <?php $results = $mons;
        include(__DIR__ . "/../../partials/result_metrics.php"); ?>
        <div class="row justify-content-center">
            <?php foreach ($mons as $mon) : ?>
                <div class="col">
                    <?php render_pokemon_list_item($mon); ?>
                </div>
            <?php endforeach; ?>
            <?php if (count($mons) === 0) : ?>
                <div class="col-12">
                    You haven't caught any Pokemon!
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