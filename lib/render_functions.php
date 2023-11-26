<?php

function render_input($data = array())
{
    include(__dir__ . "/../partials/input_field.php");
}

function render_button($data = array())
{
    include(__DIR__ . "/../partials/button.php");
}

function render_table($data = array())
{
    include(__DIR__ . "/../partials/table.php");
}

function render_pokemon_list_item($data)
{
    include(__DIR__ . "/../partials/pokemon_card.php");
}

function render_like($data = array())
{
    include(__DIR__ . "/../partials/like.php");
}