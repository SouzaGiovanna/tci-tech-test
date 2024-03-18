<?php

namespace App\Services;

use App\Models\Contact;
use App\Repositories\ContactsRepository;

class ContactsService {

    public function __construct(
        protected ContactsRepository $repository
    ) { }

    public function listContacts($date, $order): bool|array {
        $contacts = $this->repository->findAll($date, $order);

        if(!$contacts) {
            return [];
        }

        $contacts = array_map(function($contact) {
            return $this->formatFields($contact);
        }, $contacts);

        return $contacts;

    }

    public function findContactById($id): bool|array
    {
        $contacts = $this->repository->findById($id);
        return $contacts[0];
    }

    public function findContact($search, $date, $order): bool|array
    {
        return $this->repository->find($search, $date, $order);
    }

    public function deleteContact($id): array
    {
        try{
            if(!$this->repository->findById($id)){
                return [
                    "message" => "Contact not found",
                    "status" => 404
                ];
            }

            $this->repository->delete($id);
            return [
                "message" => "Contact deleted",
                "status" => 200
            ];
        }
        catch(\Exception $e){
            return [
                "message" => $e->getMessage(),
                "status" => 503
            ];
        }
    }

    public function createContact($contact): array
    {
        try{
            if($error = $this->contactAlreadyExists($contact))
            {
                return [
                    "message" => $error,
                    "status" => 400
                ];
            }

            $this->repository->create($contact);
            return [
                "message" => "Contact created",
                "status" => 201
            ];
        }
        catch(\Exception $e){
            return [
                "message" => $e->getMessage(),
                "status" => 503
            ];
        }
    }

    public function updateContact($id, $contact): array
    {
        try{
            if(!$this->repository->findById($id)) {
                return [
                    "message" => "Contact not found",
                    "status" => 400
                ];
            }

            $this->repository->update($id, $contact);
            return [
                "message" => "Contact updated",
                "status" => 201
            ];
        }
        catch(\Exception $e){
            return [
                "message" => $e->getMessage(),
                "status" => 503
            ];
        }
    }

    private function contactAlreadyExists($contact = null, $id = 0): bool|string
    {
        if ($id != 0 && !$this->repository->findById($id)) return "Contact not found";
        if ($this->repository->findByDocument($contact['document'])) return "Document already exists";
        if ($this->repository->findByPhone($contact['phone'])) return "Phone already exists";
        if ($this->repository->findByEmail($contact['email'])) return "Email already exists";

        return false;
    }

    private function formatFields($contact) {
        return [
           ...$contact,
            "document" => preg_replace("/(\d{3})(\d{3})(\d{3})(\d{2})/", "$1.$2.$3-$4", $contact['document']),
            "phone" => preg_replace("/(\d{2})(\d{5})(\d{4})/", "($1) $2-$3", $contact["phone"]),
            "created_at" => date("d/m/Y", strtotime($contact["created_at"])),
            "updated_at" => date("d/m/Y", strtotime($contact["updated_at"]))
        ];
    }
}
