<?php

declare(strict_types=1);

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\App;
use Slim\Views\Twig;
use Slim\Interfaces\RouteCollectorProxyInterface as Group;
use App\Controllers\AuthController;

return function (App $app) {

    // CORS OPTIONS
    $app->options('/{routes:.*}', function (Request $request, Response $response): Response {
        return $response;
    });

    // Página principal
    $app->get('/', function (Request $request, Response $response): Response {

        $view = Twig::fromRequest($request);

        return $view->render($response, 'index.twig', [
            'titulo' => 'Bienvenido',
            'mensaje' => 'Hola desde Slim Framework'
        ]);
    });

    // Auth
    $app->get('/login', [AuthController::class, 'loginForm']);
    $app->post('/login', [AuthController::class, 'login']);

    $app->get('/register', [AuthController::class, 'registerForm']);
    $app->post('/register', [AuthController::class, 'register']);

    $app->get('/logout', [AuthController::class, 'logout']);

    // Ruta simple
    $app->get('/hola', function (Request $request, Response $response): Response {

        $response->getBody()->write('Hola mundo');

        return $response;
    });

    // Grupo de usuarios
    $app->group('/users', function (Group $group) {

        $group->get('', function (Request $request, Response $response): Response {

            $response->getBody()->write("Lista de usuarios");

            return $response;
        });

        $group->get('/{id}', function (Request $request, Response $response, array $args): Response {

            $response->getBody()->write("Usuario ID: " . $args['id']);

            return $response;
        });

    });

};