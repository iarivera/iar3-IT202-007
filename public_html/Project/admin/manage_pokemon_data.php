<?php
// Intro to API
// note we need to go up 1 more directory
require(__DIR__ . "/../../partials/nav.php");

if (!has_role("Admin")) {
    flash("You don't have permission to view this page", "warning");
    die(header("Location: " . get_url("home.php")));
}
//TODO need to update insert_breeds... to use the $mappings array and not go based on is_int for value
function insert_pokemon_into_db($db, $pokemon, $mappings)
{
    // Prepare SQL query
    $query = "INSERT INTO `CA_Pokemon` ";
    if (count($pokemon) > 0) {
        $cols = array_keys($pokemon[0]);
        $query .= "(" . implode(",", array_map(function ($col) {
            return "`$col`";
        }, $cols)) . ") VALUES ";

        // Generate the VALUES clause for each mon
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
                $param = PDO::PARAM_STR;
                if (str_contains($mappings[$col], "int")) {
                    $param = PDO::PARAM_INT;
                }
                $stmt->bindValue($placeholder, $val, $param);
            }
        }

        // Execute the statement
        try {
            $stmt->execute();
        } catch (PDOException $e) {
            error_log(var_export($e, true));
        }
    }
}

function process_single_mon($mon, $columns, $mappings)
{
    // Process mon data
}