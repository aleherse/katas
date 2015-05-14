<?php

use Symfony\Component\HttpFoundation\Request;


$app->get('/', function(Request $request) use ($app) {
    return "Hello world!";
});

return $app;

