<?php

use Illuminate\Support\Facades\Route;

function isActiveRoute($route, $output = "active")
{
    if (Route::currentRouteName() == $route) return $output;
}
