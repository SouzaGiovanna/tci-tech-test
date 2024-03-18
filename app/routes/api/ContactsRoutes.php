<?php

namespace App\Routes\Api;

use Slim\App;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

class ContactsRoutes {
    public function __construct(protected App $app) {
        $this->registerRoutes();
    }

    public function get(): App {
        return $this->app;
    }

    private function registerRoutes(): void {
        $this->app->group('/contacts', function($app){

            $app->get('/', ["ContactsController", 'index']);

            $app->get('/search', ["ContactsController", 'find']);

            $app->get('/{id}', ["ContactsController", 'findById']);

            $app->post('/', ["ContactsController", 'create']);

            $app->put('/{id}', ["ContactsController", 'update']);

            $app->delete('/{id}', ["ContactsController", 'delete']);

        });
    }
}


