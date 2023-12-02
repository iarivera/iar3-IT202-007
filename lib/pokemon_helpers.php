<?php
$VALID_ORDER_COLUMNS = ["name", "type_1", "type_2", "caught", "created", "modified"];

function get_pokemon() {
    $db = getDB();
    $query = "SELECT id, name FROM CA_Pokemon";
    $stmt = $db->prepare($query);
    try {
        $stmt->execute();
        $result = $stmt->fetchAll();
        return $result;
    } catch (PDOException $e) {
        error_log("Error fetching Pokemon from db: " . var_export($e, true));
    }
    return [];
}

function get_pokemon_by_type() {
    $db = getDB();
    $query = "SELECT type_1 from CA_Pokemon";
    $stmt = $db->prepare($query);
    try {
        $stmt->execute();
        $result = $stmt->fetchAll();
        return $result;
    } catch (PDOException $e) {
        error_log("Error searching Pokemon by type: " . var_export($e, true));
    }
    return [];
}

function validate_mons($mons) {
    error_log("Pokemon: " . var_export($mons, true));
    $name = se($mons, "name", "", false);
    $has_error = false;
    // Name rules
    if(empty($name)) {
        flash("Pokemon name is missing", "warning");
        $has_error = true;
    }
    if(strlen($name) < 2) {
        flash("Pokemon's name must be at least 2 characters", "warning");
        $has_error = false;
    }
    // Pokemon typings (should be similar to cat breed)
    $type = (int)se($mons, "", 0, false);
    if($type === 0) {
        flash("Pokemon needs a typing", "warning");
        $has_error = false;
    }

    return !$has_error;
}

function get_pokemon_by_id($id)
{
    error_log("Checking for Pokemon: " . var_export($id, true));
    $db = getDB();
    // In this case I do want all the data
    $query = "SELECT * FROM CA_Pokemon WHERE id = :id";
    $stmt = $db->prepare($query);
    $stmt->bindValue(":id", $id);
    try {
        $stmt->execute();
        $result = $stmt->fetch();
        //error_log("Breed results: " . var_export($result, true));
        return $result;
    } catch (PDOException $e) {
        error_log("Error fetching Pokemon from db: " . var_export($e, true));
    }
    return [];
}

function search_mons()
{
    // Initialize variables
    global $search; //make search available outside of this function
    $search = $_GET;
    $mons = [];
    $params = [];

    // Build the SQL query
    $query = _build_search_query($params, $search);

    // Prepare the SQL statement
    $db = getDB();
    $stmt = $db->prepare($query);

    // Bind parameters to the SQL statement
    bind_params($stmt, $params);
    error_log("search query: " . var_export($query, true));
    error_log("params: " . var_export($params, true));
    // Execute the SQL statement and fetch results
    try {
        $stmt->execute();
        $result = $stmt->fetchAll();
        if ($result) {
            $mons = $result;
        }
    } catch (PDOException $e) {
        flash("An error occurred while searching for Pokemon: " . $e->getMessage(), "warning");
        error_log("Pokemon Search Error: " . var_export($e, true));
    }

    return $mons;
}

// Note: & tells php to pass by reference so any changes made to $params are reflected outside of the function
// Need to fix
function _build_search_query(&$params, $search)
{
    $query = "SELECT
            c.id,
            c.name,
            c.type_1,
            c.type_2,
            CASE
                WHEN c.caught = '0' THEN 'Not Caught'
                WHEN c.caught = '1' THEN 'Caught'
                ELSE 'N/A'
            END as caught
            WHEN 1=1";
    foreach ($search as $key => $value) {
        if ($value == 0 || !empty($value)) {
            switch ($key) {
                case 'name':
                    $params[":name"] = "%$value%";
                    $query .= " AND c.name like :name";
                    break;
                case 'type_1':
                    $i = 0;
                    $keys = [];
                    foreach ($value as $t) {
                        if (empty($t)) {
                            continue;
                        }
                        $params[":t$i"] = $t;
                        array_push($keys, ":t$i");
                        $i++;
                    }
                    if (count($keys) > 0) {
                        $keys = join(",", $keys);
                        $query .= " AND c.type";
                    }
                    break;
                case 'type_2':
                    $i = 0;
                    $keys = [];
                    foreach ($value as $t) {
                        if (empty($t)) {
                            continue;
                        }
                        $params[":t$i"] = $t;
                        array_push($keys, ":t$i");
                        $i++;
                    }
                    if (count($keys) > 0) {
                        $keys = join(",", $keys);
                        $query .= " AND c.type";
                    }
                    break;
                case 'caught':
                    $params[":caught"] = $value;
                    $query .= " AND caught = :caught";
                    break;
                case 'id':
                    $params[":id"] = $value;
                    $query .= " AND c.id = :id";
                    break;
            }
        }
    }

    if (!has_role("Admin")) {
        $query .= " AND status != 'unavailable'";
    }
    // order by
    if (isset($search["column"]) && !empty($search["column"]) && isset($search["order"]) && !empty($search["order"])) {
        global $VALID_ORDER_COLUMNS;
        $col = $search["column"];
        $order = $search["order"];
        // prevent SQL injection by checking it against a hard coded list
        if (!in_array($col, $VALID_ORDER_COLUMNS)) {
            $col = "name";
        }
        if (!in_array($order, ["asc", "desc"])) {
            $order = "asc";
        }
        // special mapping to use table name prefix to resolve ambiguity error
        if (in_array($col, ["created", "modified"])) {
            $col = "c.$col";
        }
        $query .= " ORDER BY $col $order"; //<-- be absolutely sure you trust these values; we can't bind certain parts of the query due to how the parameter mapping works
    }
    // limit last
    $query .= " LIMIT 10";


    return $query;
}
/**
 * Dynamically binds parameters based on value data type
 */
function bind_params($stmt, $params)
{
    // Bind parameters to the SQL statement
    foreach ($params as $k => $v) {
        $type = PDO::PARAM_STR;
        if (is_null($v)) {
            $type = PDO::PARAM_NULL;
        } else if (is_numeric($v)) {
            $type = PDO::PARAM_INT;
        }
        $stmt->bindValue($k, $v, $type);
    }
}