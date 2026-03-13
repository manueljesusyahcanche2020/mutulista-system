<?php

namespace App\Controllers;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Views\Twig;

class AuthController
{
    public function loginForm(Request $request, Response $response)
    {
        $view = Twig::fromRequest($request);

        return $view->render($response, 'auth/login.html');
    }

    public function login(Request $request, Response $response)
    {
        $data = $request->getParsedBody();

        $usuario = $data['usuario'] ?? '';
        $password = $data['password'] ?? '';

        $response->getBody()->write("Intentando login: " . $usuario);

        return $response;
    }
    public function registerForm(Request $request, Response $response)
    {
        $view = Twig::fromRequest($request);

        return $view->render($response, 'auth/register.twig');
    }

    public function register(Request $request, Response $response)
    {
        $data = $request->getParsedBody();

        $usuario = $data['usuario'] ?? '';
        $password = $data['password'] ?? '';

        // aquí guardarías en la base de datos

        $response->getBody()->write("Usuario registrado: " . $usuario);

        return $response;
    }
}