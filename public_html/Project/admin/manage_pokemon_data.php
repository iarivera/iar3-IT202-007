<?php
// Intro to API
// note we need to go up 1 more directory
require(__DIR__ . "/../../../partials/nav.php");

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
    $type = isset($mon["type"]) ? se($mon["type"], "", " ", false) : " ";
    $type = array_map('trim', explode(' ', $type));

    // Prepare record
    $record = [];
    $record["api_id"] = se($mon, "id", "", false);
    $record["type_1"] = $type[0];
    $record["type_2"] = $type[1];

    foreach ($columns as $column) {
        if(in_array($columns, ["id", "api_id"])){
            continue;
        }
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

    // Prepare clumns and mappings
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
        array_push($pokemon, $mon);
    }

    // Insert pokemon into database
    insert_pokemon_into_db($db, $pokemon, $mappings);
}

$action = se($_POST, "action", "", false);
if ($action) {
    switch ($action) {
        case "pokemon":
            $result = get("https://pokemon-go1.p.rapidapi.com/pokemon_names.json", "API_KEY", ["limit" => 100, "page" => 0], false);
            process_pokemon($result);
            break;
    }
}
?>

<div class="container-fluid">
    <h1>Pokemon Data Management</h1>
    <div class="row">
        <div class="col">
            <!-- Breed refresh button -->
            <form method="POST">
                <input type="hidden" name="action" value="pokemon" />
                <input type="submit" class="btn btn-primary" value="Refresh Pokemon" />
            </form>
        </div>
    </div>
</div>