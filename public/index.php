<?php
/**
 * @ Author: Prawee Wongsa (prawee@hotmail.com)
 * @ Create Time: 2022-03-31 02:31:51
 * @ Modified by: Prawee@hotmial.com
 * @ Modified time: 2022-03-31 02:54:51
 * @ Description: loading name and packages
 */
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;

/**
 * Loading all dependencies
 */
require __DIR__.'/../vendor/autoload.php';

/**
 * Create application from slim factory
 */
$app = AppFactory::create();

/**
 * Simple route with hello world
 */
$app->get('/', function(Request $request, Response $response) {
    $response->getBody()->write("Hello, World!");
    return $response;
});

$app->get('/hello/pod', function(Request $request, Response $response) {
    $response->getBody()->write("Hello, Pod!");
    return $response;
});

$app->get('/hello/{name}', function(Request $request, Response $response, array $args) {
    $name = ucfirst($args['name']);
    $response->getBody()->write(sprintf("Hello, %s!", $name));
    return $response;
});

/**
 * Start running the application
 */
$app->run();