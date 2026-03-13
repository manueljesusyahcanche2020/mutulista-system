<?php
use Slim\App;
use Slim\Views\Twig;
use Slim\Views\TwigMiddleware;

return function (App $app) {

    $twig = Twig::create(__DIR__ . '/../templates', [
        'cache' => false
    ]);

    $app->add(TwigMiddleware::create($app, $twig));
};