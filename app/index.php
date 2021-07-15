<?php
error_reporting(-1);
ini_set('display_errors', 1);

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\RequestHandlerInterface;
use Slim\Factory\AppFactory;
use Slim\Routing\RouteCollectorProxy;
use Slim\Routing\RouteContext;
require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/acessoDatos/AcessoDatos.php';
require __DIR__ . '/entidades/usuario.php';
require __DIR__ . '/controllers/usuarioController.php';
require __DIR__ . '/entidades/producto.php';
require __DIR__ . '/controllers/productoController.php';

$app = AppFactory::create();
$app->addErrorMiddleware(true, true, true);

// Enable CORS
$app->add(function (
    Request $request,
    RequestHandlerInterface $handler
): Response {
    // $routeContext = RouteContext::fromRequest($request);
    // $routingResults = $routeContext->getRoutingResults();
    // $methods = $routingResults->getAllowedMethods();

    $response = $handler->handle($request);

    $requestHeaders = $request->getHeaderLine('Access-Control-Request-Headers');

    $response = $response->withHeader('Access-Control-Allow-Origin', '*');
    $response = $response->withHeader('Access-Control-Allow-Methods','get,post');
    $response = $response->withHeader('Access-Control-Allow-Headers',$requestHeaders);

    // Optional: Allow Ajax CORS requests with Authorization header
    // $response = $response->withHeader('Access-Control-Allow-Credentials', 'true');

    return $response;
});

$app->get('/hello/{name}', function (
    Request $request,
    Response $response,
    array $args
) {
    $name = $args['name'];
    $response->getBody()->write("Hello, $name");
    return $response;
});
//ruteo frontend,grupo adentro los get con post

/*$app->post('/login[/]', function (Request $request, Response $response, array $args) {
    $response->getBody()->write($response);
    return $response;
});


$app->post('[/]', function (Request $request, Response $response, array $args) {
    $response->getBody()->write('Llegue con Post');
    return $response;
});asas/
*/
$app->post('[/]', \usuarioController::class . ':CrearUsuario');
$app->post('/login[/]', \usuarioController::class . ':retornarUsuario');
$app->get('/productos[/]', \productoController::class . ':RetornarProductos');
$app->post('/altaproducto[/]', \productoController::class . ':Alta');
$app->post('/eliminarproducto[/]', \productoController::class . ':DeleteProductos');
$app->post('/FormModProducto[/]', \productoController::class . ':obtenerFormMod');
$app->post('/modificarproducto[/]', \productoController::class . ':ModProductos');





$app->run();