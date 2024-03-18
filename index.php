<?php

require __DIR__."/vendor/autoload.php";
require('./app/config/methods.php');

use App\Core\AppContainer;
use Slim\Factory\AppFactory;
use DI\Container;

use App\Routes\Api\ContactsRoutes;

$container = new Container();

AppFactory::setContainer($container);

$app = AppFactory::create();

$app = (new AppContainer())($app);

$app->addBodyParsingMiddleware();

$app = (new ContactsRoutes($app))->get();

try {
    $app->run();
} catch (Exception $e) {
    echo $e->getMessage();
}
