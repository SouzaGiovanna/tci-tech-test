<?php

namespace App\Core;

class AppContainer {

    public function __invoke($app) {

        global $container;

        $appContainer = $app->getContainer();

        $appContainer->set('Database', function() use ($container) {
            return new \App\Core\Database\Providers\MysqlProvider($container);
        });

        $appContainer->set('Contact', function() use ($container) {
            $db = $container->get('Database');
            return new \App\Models\Contact($db);
        });

        $appContainer->set('ContactsRepository', function() use ($container) {
            $contact = $container->get('Contact');
            return new \App\Repositories\ContactsRepository($contact);
        });

        $appContainer->set('ContactsService', function() use ($container) {
            $repository = $container->get('ContactsRepository');
            return new \App\Services\ContactsService($repository);
        });

        $appContainer->set('ContactsController', function() use ($container) {
            $service = $container->get('ContactsService');
            return new \App\Controllers\ContactsController($container, $service);
        });

        return $app;
    }

}