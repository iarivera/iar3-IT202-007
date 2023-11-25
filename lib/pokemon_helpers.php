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