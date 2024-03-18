<?php

namespace App\Controllers;

use App\Services\ContactsService;
use Psr\Container\ContainerInterface;

class ContactsController {

    public function __construct(
        protected ContainerInterface $container,
        protected ContactsService $service
    ) {}

    public function index($request, $response, $args) {
        $date = $request->getQueryParams()['date'] ?? 'created_at';
        $order = $request->getQueryParams()['order'] ?? 'desc';

        $contacts = $this->service->listContacts($date, $order);

        view("contacts", ["contacts" => $contacts]);

        return $response;
    }

    public function findById($request, $response, $args) {

        $contactId = (int)$request->getAttribute('id');

        $contact = $this->service->findContactById($contactId);
        
        $response->getBody()->write(json_encode($contact));

        $response->withHeader("Content-Type", "application/json")->withStatus(200);

        return $response;

    }

    public function find($request, $response, $args) {
        $search = $request->getQueryParams()['search'];
        $date = $request->getQueryParams()['date'] ?? 'created_at';
        $order = $request->getQueryParams()['order'] ?? 'desc';

        $contacts = $this->service->findContact($search, $date, $order);

        $response->getBody()->write(json_encode($contacts));

        $response->withHeader("Content-Type", "application/json")->withStatus(200);

        return $response;
    }

    public function create($request, $response, $args) {
        $contact = json_decode($request->getBody(), true);

        $resp = $this->service->createContact($contact);

        $response->getBody()->write(json_encode(["message" => $resp['message']]));
        $response->withHeader("Content-Type", "application/json");

        return $response->withStatus($resp['status']);
    }

    public function update($request, $response, $args) {
        $contact = json_decode($request->getBody(), true);
        $contactId = (int)$request->getAttribute('id');

        $resp = $this->service->updateContact($contactId, $contact);
        

        $response->getBody()->write(json_encode(["message" => $resp['message']]));
        $response->withHeader("Content-Type", "application/json")->withStatus($resp['status']);

        return $response;
    }

    public function delete($request, $response, $args) {
        $contactId = (int)$request->getAttribute('id');

        $resp = $this->service->deleteContact($contactId);

        $response->getBody()->write(json_encode(["message" => $resp['message']]));
        $response->withHeader("Content-Type", "application/json")->withStatus($resp['status']);

        return $response;
    }

}
