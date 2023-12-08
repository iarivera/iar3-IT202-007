<?php
require(__DIR__ . "/../../partials/nav.php");
?>
<h1>Home</h1>
<?php

if (is_logged_in(true)) {
    //comment this out if you don't want to see the session variables
    error_log("Session data: " . var_export($_SESSION, true));
}
?>
<div class="container-fluid">
    <div class="h-50 p-5 text-bg-dark rounded-3">
        <h1>Welcome to the Pokemon Go Tracker!</h1>
        <p>Yes it is basically a Pokedex. Let's work together to catch them all!</p>
        <p class="text-center"><a class="btn btn-primary btn-lg" href="<?php get_url("browse.php", true); ?>" role="button">Check Pokemon</a></p>
    </div>
</div>
<?php
require(__DIR__ . "/../../partials/flash.php");
?>