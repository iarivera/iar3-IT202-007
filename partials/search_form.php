<?php
$caught = ["Not Caught", "Caught"];
if (!has_role("Admin")) {
    $caught = array_filter($caught, function ($v) {
        return $v !== "Unavailable";
    });
}
$caught = array_map(function ($v) {
    return ["label" => $v, "value" => strtolower($v)];
}, $caught);
array_unshift($caught, ["label" => "Any", "value" => ""]);

// get the pokemon
$result = get_pokemon();
// convert data
$pokemon = array_map(function ($v) {
    return ["label" => $v["name"], "value" => $v["id"]];
}, $result);
array_unshift($pokemon, ["label" => "Any", "value" => ""]);

// filter by Pokemon types
$pokemonTypes = ["Normal", "Fire", "Water", "Electric", "Grass", "Ice", "Fighting", "Poison", "Ground", "Flying", "Psychic", "Bug", "Rock", "Ghost", "Dark", "Steel", "Dragon", "Fairy"];
$pokemonTypes = array_map(function ($v) {
    return ["label" => $v, "value" => strtolower($v)];
}, $pokemonTypes); //$VALID_ORDER_COLUMNS is defined in pokemon_helpers.php
array_unshift($pokemonTypes, ["label" => "Any", "value" => ""]);

// make columns options for order by map order columns
$cols = array_map(function ($v) {
    return ["label" => $v, "value" => strtolower($v)];
}, $VALID_ORDER_COLUMNS); //$VALID_ORDER_COLUMNS is defined in pokemon_helpers.php
array_unshift($cols, ["label" => "Any", "value" => ""]);

$orders = ["asc", "desc"];
$orders = array_map(function ($v) {
    return ["label" => $v, "value" => strtolower($v)];
}, $orders);
array_unshift($orders, ["label" => "Any", "value" => ""]);
?>

<form method="GET">
    <div class="row">
        <div class="col-auto">
            <?php render_input(["type" => "text", "id" => "name", "name" => "name", "label" => "Name", "value" => se($search, "name", "", false)]); ?>
        </div>
        <div class="col-auto">
            <?php render_input(["type" => "select", "id" => "type_1", "name" => "type_1", "label" => "Type", "options" => $pokemonTypes, "value" => se($search, "type_1", "", false)]); ?>
        </div>
        <div class="col-2">
            <?php render_input(["type" => "select", "id" => "caught", "name" => "caught", "label" => "Caught", "options" => $caught, "value" => se($search, "caught", "", false)]); ?>
        </div>
        <div class="col-2">
            <?php render_input(["type" => "select", "id" => "order", "name" => "order", "label" => "Order", "options" => $orders, "value" => se($search, "order", "", false)]); ?>
        </div>
    </div>
    <div class="row">
        <div class="col-1">
            <?php render_button(["type" => "submit", "text" => "Search"]); ?>
        </div>
        <div class="col-1">
            <a class="btn btn-secondary" href="?">Reset</a>
        </div>
    </div>
</form>