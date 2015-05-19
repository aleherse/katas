<?php

$app->register(new Silex\Provider\SessionServiceProvider());

$app['session']->start();

return $app;

