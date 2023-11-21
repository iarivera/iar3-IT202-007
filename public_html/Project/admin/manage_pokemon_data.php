//Intro to API
<?php
require(__DIR__ . "/../../partials/nav.php");

if (!has_role("Admin")) {
    flash("You don't have permission to view this page", "warning");
    die(header("Location: " . get_url("home.php")));
}

function insert_pokemon_into_db($db, $pokemon, $mappings)
{
    $query = "INSERT INTO `CA_Pokemon` ";
    if (count($pokemon) > 0) {
        $cols = array_keys($pokemon[0]);
        $query .= "(" . implode(",", array_map(function ($col) {
            return "`$col`";
        }, $cols)) . ") VALUES ";

        $values = [];
        foreach ($pokemon as $i => $mon) { //I am using mon as the singular for pokemon
            $pokemonPlaceholders = array_map(function ($v) use ($i) {
                return ":" . $v . $i;
            }, $cols);
            $values[] = "(" . implode(",", $pokemonPlaceholders) . ")";
        }
        
        $query .= implode(",", $values);

        // Generate the ON DUPLICATE KEY UPDATE clause
        $updates = array_reduce($cols, function ($carry, $col) {
            $carry[] = "`$col` = VALUES(`$col`)";
            return $carry;
        }, []);

        $query .= " ON DUPLICATE KEY UPDATE " . implode(",", $updates);

        // Prepare the statement
        $stmt = $db->prepare($query);

        // Bind the parameters for each mon
        foreach ($pokemon as $i => $mon) {
            foreach ($cols as $col) {
                $placeholder = ":$col$i";
                $val = isset($pokemon[$col]) ? $pokemon[$col] : "";
            }
        }

    }
}