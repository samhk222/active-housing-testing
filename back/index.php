<?php

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use \Samhk222\ActiveHousingReqres\Models\V1\User;

require 'vendor/autoload.php';

$app = new \Slim\App;

$app->get('/user/{id}', function (Request $request, Response $response, array $args) {
    $id = $args['id'];
    $user = (new User)->getById($id);
    return $response->withJson($user, 200);
});

$app->get('/users[/{page}]', function (Request $request, Response $response, array $args) {
    $page = $args['page'] ?? 0;
    $users = (new User)->getUsers($page);
    return $response->withJson($users, 200);
});
$app->run();
