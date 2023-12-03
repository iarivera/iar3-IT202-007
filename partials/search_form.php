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

// get typings
$types = get_types();
$types = array_map(function ($v) {
    return ["label" => $v["name"], "value" => $v["id"]];
}, $types);
array_unshift($types, ["label" => "Any", "value" => ""]);

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
            <?php render_input(["type" => "select", "id" => "status", "name" => "status", "label" => "Status", "options" => $statuses, "value" => se($search, "status", "", false)]); ?>
        </div>
        <div class="col-2">
            <?php render_input(["type" => "select", "id" => "column", "name" => "column", "label" => "Columns", "options" => $cols, "value" => se($search, "column", "", false)]); ?>
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