<?php declare(strict_types=1);


use App\Controllers\HomeController;
use Dotenv\Dotenv;
use Laminas\Diactoros\ServerRequestFactory;
use Laminas\HttpHandlerRunner\Emitter\SapiEmitter;
use League\Route\Router;
use League\Route\Strategy\ApplicationStrategy;

require_once dirname(__DIR__) . '/vendor/autoload.php';

$dotenv = Dotenv::createImmutable(dirname(__DIR__));
$dotenv->load();

$request = ServerRequestFactory::fromGlobals(
    $_SERVER, $_GET, $_POST, $_COOKIE, $_FILES
);

$router = new Router();
$router->get( '/', [HomeController::class, 'index'])->setStrategy(new ApplicationStrategy());

$response = $router->dispatch($request);
(new SapiEmitter)->emit($response);
