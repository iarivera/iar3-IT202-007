<?php
require(__DIR__ . "/../../partials/nav.php");
?>
<?php

if (is_logged_in(true)) {
    //comment this out if you don't want to see the session variables
    error_log("Session data: " . var_export($_SESSION, true));
}
?>
<div class="container-fluid">
    <div class="h-50 p-5 text-bg-dark rounded-3">
        <h1>Welcome to the Community Pokedex</h1>
        <p>Let's work together to catch them all!</p>
        <p class="text-center"><a class="btn btn-primary btn-lg" href="<?php get_url("browse.php", true); ?>" role="button">Check Pokemon</a></p>
        <p class="text-center"><a class="btn btn-primary btn-lg" href="<?php 
        $num = rand(1,1005);
        get_url("pokemon_profile.php?id=$num", true); ?>" role="button">Random Pokemon</a></p>
    </div>
</div>
<?php
require(__DIR__ . "/../../partials/footer.php");
?>