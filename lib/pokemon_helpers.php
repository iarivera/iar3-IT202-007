<?php
$VALID_ORDER_COLUMNS = ["created", "modified"];

function get_pokemon() {
    $db = getDB();
    $query = "SELECT id, api_id, name FROM CA_Pokemon";
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
    $type1 = (int)se($mons, "type_1", 0, false);
    if($type1 === 0) {
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
        //error_log("Pokemon results: " . var_export($result, true));
        return $result;
    } catch (PDOException $e) {
        error_log("Error fetching Pokemon from db: " . var_export($e, true));
    }
    return [];
}