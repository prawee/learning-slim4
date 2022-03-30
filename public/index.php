<?php
/**
 * @ Author: Prawee Wongsa (prawee@hotmail.com)
 * @ Create Time: 2022-03-31 02:31:51
 * @ Modified by: Prawee@hotmial.com
 * @ Modified time: 2022-03-31 04:17:01
 * @ Description: loading name and packages
 */
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;
use DI\Container;
/**
 * Loading all dependencies
 */
require __DIR__.'/../vendor/autoload.php';

/**
 * Dependencies injection
 */
$container = new Container();
$container->set('templating', function() {
    return new Mustache_Engine([
        'loader' => new Mustache_Loader_FilesystemLoader(
            __DIR__.'/../templates',
            ['extension' => '']
        )
    ]);
});
AppFactory::setContainer($container);

/**
 * Create application from slim factory
 */
$app = AppFactory::create();

/**
 * Simple route with hello world
 */
// $app->get('/', function(Request $request, Response $response) {
//     $response->getBody()->write("Hello, World!");
//     return $response;
// });
$app->get('/', '\App\Controller\FirstController:homepage');

$app->get('/hello/pod', function(Request $request, Response $response) {
    $response->getBody()->write("Hello, Pod!");
    return $response;
});

$app->get('/hello/{name}', function(Request $request, Response $response, array $args) {
    // $name = ucfirst($args['name']);
    // $response->getBody()->write(sprintf("Hello, %s!", $name));
    $html = $this->get('templating')->render('hello.html', [
        'name' => ucfirst($args['name']),
    ]);
    $response->getBody()->write($html);
    return $response;
});

/**
 * Start running the application
 */
$app->run();