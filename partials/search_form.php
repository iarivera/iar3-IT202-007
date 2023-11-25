<?php
$statuses = ["Caught", "Not Caught"];
if (!has_role("Admin")) {
    $statuses = array_filter($statuses, function ($v) {
        return $v !== "Unavailable";
    });
}
$statuses = array_map(function ($v) {
    return ["label" => $v, "value" => strtolower($v)];
}, $statuses);
array_unshift($statuses, ["label" => "Any", "value" => ""]);

// get the pokemon
$result = get_pokemon();
// convert data
$pokemon = array_map(function ($v) {
    return ["label" => $v["name"], "value" => $v["id"]];
}, $result);
array_unshift($pokemon, ["label" => "Any", "value" => ""]);

// make types
$types = get_pokemonTypes(); // make this function
$types = array_map(function ($v) {
    return ["label" => $v["name"], "value" => $v["id"]];
}, $temps);
array_unshift($temps, ["label" => "Any", "value" => ""]);

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