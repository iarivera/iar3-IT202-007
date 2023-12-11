<?php if (isset($data)) : error_log("Pokemon data: " . var_export($data, true)); ?>
    <div class="card" style="width:15em">
            <?php if (se($data, "username", "", false)) : ?> by
                <a href="<?php get_url("profile.php?id=", true);
                            se($data, "owner_id"); ?>"><?php se($data, "username"); ?></a> - <?php se($data, "last_updated"); ?>
            <?php endif; ?>    
        <img class="p-3" style="width: 100%; aspect-ratio: 1; object-fit: scale-down; max-height: 256px;" src="images/missingNo.png"; ?>
        <div class="card-body">
            <h5 class="card-title"><?php se($data, "label", ""); ?></h5>
            <p class="card-text">
                <br>
            </p>
            <p class="card-text"><strong>About:</strong><br>Pokemon number <?php se($data, "value"); ?></p>
        </div>
        <div class="card-footer">
            <?php $id = se($data, "value", -1, false);
            $is_single_view = !isset($_GET["value"]);
            ?>
            <div class="row">
                <?php if ($is_single_view) : /* if used in single view don't add link*/ ?>
                    <a class="btn btn-primary col" href="<?php get_url("pokemon_profile.php?id=$id", true); ?>">View Pokemon</a>
                <?php endif; ?>
            </div>
            <?php if (has_role("Admin")) : ?>
                <div class="row mt-1 g-1">
                    <a class="btn btn-secondary col me-1" href="<?php get_url("admin/pokemon_profile.php?id=$id", true); ?>">Edit</a>
                    <?php

                    $search_filters = array_filter($_GET, function ($value) {
                        return ($value !== null && $value !== '');
                    });
                    if (!isset($_GET["id"])) {
                        $search_filters["id"] = $id;
                    }
                    $query_string = http_build_query($search_filters);
                    $url = get_url("admin/disable_pokemon_profile.php?$query_string");
                    ?>
                    <a class="btn btn-danger col" href="<?php se($url); ?>">Remove</a>
                </div>
            <?php endif; ?>
        </div>
    </div>
<?php endif; ?>