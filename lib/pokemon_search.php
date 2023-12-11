<?php
function search_mons() //put in new pokemon_search.php file 
{
    // Initialize variables
    global $search; //make search available outside of this function
    if (isset($search) && !empty($search)) {
        $search = array_merge($search, $_GET);
    } else {
        $search = $_GET;
    }
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

function get_potential_total_records($query, $params)
{
    if (!str_contains($query, "total")) {
        throw new Exception(("This query expects a 'total' column to be fetched"));
    }
    $db = getDB();
    $stmt = $db->prepare($query);
    //temporarily remove mappings that don't exist for the total query
    // note this is ok as $params is passed by value in this case, not by reference
    $params = array_filter($params, function ($key) use ($query) {
        return str_contains($query, $key);
    }, ARRAY_FILTER_USE_KEY);
    bind_params($stmt, $params);
    $total = 0;
    try {
        $stmt->execute();
        $result = $stmt->fetch();
        if ($result && isset($result["total"])) {
            $total = (int)$result["total"];
            error_log("Total potential records: $total");
        }
    } catch (PDOException $e) {
        error_log("Error fetching total count for query: " . var_export($e, true));
    }
    return $total;
}

function _build_where_clause(&$query, &$params, $search)
{
    foreach ($search as $key => $value) {
        if ($value == 0 || !empty($value)) {
            switch ($key) {
                case 'name':
                    $params[":name"] = "%$value%";
                    $query .= " AND c.name like :name";
                    break;
                case 'type_1':
                    $params[":type_1"] = $value;
                    $query .= " AND type_1 = :type_1";
                    break;
                case 'caught':
                    $params[":caught"] = $value;
                    $query .= " AND caught = :caught";
                    break;
                case 'id':
                    $params[":id"] = $value;
                    $query .= " AND c.id = :id";
                    break;
                case "owner_id":
                    $params[":owner_id"] = $value;
                    $query .= " AND c.id IN (SELECT pokemon_id FROM CA_Pokemon_Trainer WHERE owner_id = :owner_id)";
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
}

function _build_search_query(&$params, $search)
{
    $search_query = "SELECT
        c.id,
        c.name,
        c.type_1,
        c.type_2,
        CASE
            WHEN c.caught = 'Not Caught' THEN 'Not Caught'
            WHEN c.caught = 'Caught' THEN 'Caught'
            ELSE 'N/A'
        END as caught,
        co.owner_id as owner_id,
        u.username as username,
        c.modified as last_updated
        FROM CA_Pokemon c
        LEFT JOIN CA_Pokemon_Trainer co on co.pokemon_id = c.id
        LEFT JOIN Users u on co.owner_id = u.id
        WHERE 1=1";
    $total_query = "SELECT count(1) as total FROM CA_Pokemon as c WHERE 1=1";
    _build_where_clause($filter_query, $params, $search);
    // added pagination (need limit and page to be in $search)
    // produces a $total value for use in UI

    global $total;
    $total = (int)get_potential_total_records($total_query . $filter_query, $params);
    $limit = (int)se($search, "limit", 100, false);
    error_log("total record: $total");
    $page = (int)se($search, "page", "1", false);
    if ($limit > 0 && $limit <= 100 && $page > 0) {
        $offset = ($page - 1) * $limit;
        if (is_numeric($offset) && is_numeric($limit)) {
            $filter_query .= " LIMIT $offset, $limit"; //offset is records to skip, limit is max records to display on a page
        }
    }
    return $search_query . $filter_query;
}
/**
 * Dynamically binds parameters based on value data type
 * Also put into pokemon_search.php
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
?>