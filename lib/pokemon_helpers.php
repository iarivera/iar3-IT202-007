<?php

function get_pokemon() {
    $db = getDB();
    $query = "SELECT id, api_id, name FROM CA_Pokemon_Stats";
    $stmt = $db->prepare($query);
    try {
        $stmt->execute();
        $result = $stmt->fetchAll();
        //error_log("Breed results: " . var_export($result, true));
        return $result;
    } catch (PDOException $e) {
        error_log("Error fetching breeds from db: " . var_export($e, true));
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
    // Stats: Attack, Defense, Stamina
    $attack = (int)se($mons, "attack", -1, false);
    if($attack == -1){
        flash("Attack must be entered", "warning");
        $has_error = true;
    }
    else if($attack < 0){
        flash("Attack must be a positive value", "warning");
        $has_error = true;
    }
    $defense = (int)se($mons, "defense", -1, false);
    if($defense == -1){
        flash("Defense must be entered", "warning");
        $has_error = true;
    }
    else if($defense < 0){
        flash("Defense must be a positive value", "warning");
        $has_error = true;
    }
    $stamina = (int)se($mons, "stamina", -1, false);
    if($stamina == -1){
        flash("Stamina must be entered", "warning");
        $has_error = true;
    }
    else if($stamina < 0){
        flash("Weight must be a positive value", "warning");
        $has_error = true;
    }

    return !$has_error;
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
            $cats = $result;
        }
    } catch (PDOException $e) {
        flash("An error occurred while searching for Pokemon: " . $e->getMessage(), "warning");
        error_log("Pokemon Search Error: " . var_export($e, true));
    }

    return $mons;
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