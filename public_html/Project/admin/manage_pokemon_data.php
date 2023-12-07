<?php
// note we need to go up 1 more directory
require(__DIR__ . "/../../../partials/nav.php");

if (!has_role("Admin")) {
    flash("You don't have permission to view this page", "warning");
    die(header("Location: " . get_url("home.php")));
}
//TODO need to update insert_pokemon... to use the $mappings array and not go based on is_int for value
function insert_pokemon_into_db($db, $pokemon, $mappings)
{
    // Prepare SQL query
    $query = "INSERT INTO `CA_Pokemon` ";
    if (count($pokemon) > 0) {
        $cols = array_keys($pokemon[0]);
        $query .= "(" . implode(",", array_map(function ($col) {
            return "`$col`";
        }, $cols)) . ") VALUES ";

        // Generate the VALUES clause for each pokemon
        $values = [];
        foreach ($pokemon as $i => $mon) { // I am using mon as the singular for pokemon
            $monPlaceholders = array_map(function ($v) use ($i) {
                return ":" . $v . $i; // Append the index to make each placeholdler unique
            }, $cols);
            $values[] = "(" . implode(",", $monPlaceholders) . ")";
        }
        
        $query .= implode(",", $values);

        // iar3 12/02/2001 this code checks if any duplicate items will be pulled
        // and only leaves old data alone
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
                $val = isset($mon[$col]) ? $mon[$col] : "";
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
    // Process Pokemon Type
    $type = $mon["type"];    
    // Prepare record
    // iar3 12/02/2023 this code shows how data is mapped, with
    // the names being mapped to columns from the API 
    $record = [];
    $record["api_id"] = se($mon, "pokemon_id", "", false);
    $record["name"] = se($mon, "pokemon_name", "", false);
    $record["type_1"] = $type[0];
    $record["type_2"] = $type[1];
    

    // Map mon data to columns
    foreach ($columns as $column) {
        if(in_array($column, ["id", "api_id"])){
            continue;
        }
        error_log("$mon type: " . gettype($mon) . ", Content: " . var_export($mon, true));
        error_log("$column type: " . gettype($column) . ", Content: " . var_export($column, true));
        if(array_key_exists($column, $mon)){
            $record[$column] = $mon[$column];
            if(empty($record[$column])){
                if(str_contains($mappings[$column], "int")){
                    $record[$column] = "0";
                }
            }
        }
    }
    error_log("Record: " . var_export($record, true));
    return $record;
}

function process_pokemon($result)
{
    $status = se($result, "status", 400, false);
    if ($status != 200) {
        return;
    }

    // Extract data from result
    $data_string = html_entity_decode(se($result, "response", "{}", false));
    $wrapper = "{\"data\":$data_string}";
    $data = json_decode($wrapper, true);
    if (!isset($data["data"])) {
        return;
    }
    $data = $data["data"];
    error_log("data: " . var_export($data, true));
    //Get columns from CA_Pokemon table
    $db = getDB();
    $stmt = $db->prepare("SHOW COLUMNS FROM CA_Pokemon");
    $stmt->execute();
    $columnsData = $stmt->fetchALL(PDO::FETCH_ASSOC);

    // Prepare columns and mappings
    $columns = array_column($columnsData, 'Field');
    $mappings = [];
    foreach ($columnsData as $column) {
        $mappings[$column['Field']] = $column['Type'];
    }
    $ignored = ["id", "created", "modified"];
    $columns = array_diff($columns, $ignored);

    // Process each mon
    $pokemon = [];
    foreach ($data as $mon) {
        $record = process_single_mon($mon, $columns, $mappings);
        array_push($pokemon, $record);
    }

    // Insert pokemon into database
    insert_pokemon_into_db($db, $pokemon, $mappings);
}

//iar3 12/02/2023, this is the API call that fetches all the data needed
$action = se($_POST, "action", "", false);
if ($action) {
    switch ($action) {
        case "pokemon":
            $result = get("https://pokemon-go1.p.rapidapi.com/pokemon_types.json", "POKEMON_API_KEY", ["limit" => 75, "page" => 0], true, "pokemon-go1.p.rapidapi.com");
            process_pokemon($result);
            break;
    }
}
?>

<div class="container-fluid">
    <h1>Pokemon Data Management</h1>
    <div class="row">
        <div class="col">
            <!-- Pokemon refresh button -->
            <form method="POST">
                <input type="hidden" name="action" value="pokemon" />
                <input type="submit" class="btn btn-primary" value="Refresh Pokemon" />
            </form>
        </div>
        <div class="col">
            <a class="btn btn-secondary" href="<?php get_url("admin/pokemon_profile.php", true); ?>">Create Pokemon</a>
        </div>
        <div class="col">
            <a class="btn btn-secondary" href="<?php get_url("admin/list_pokemon.php", true); ?>">List Pokemon</a>
        </div>
    </div>
</div>