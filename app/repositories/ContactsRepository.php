<?php

namespace App\Repositories;

use App\Models\Contact;

class ContactsRepository {

    protected Contact $model;

    public function __construct(
        protected Contact $contactModel
    ) { }

    public function findAll($date, $order): bool|array
    {
        return $this->contactModel->all($date, $order);

    }

    public function findById($id): bool|array
    {
        return $this->contactModel->findById($id);
    }

    public function find($search, $date, $order): bool|array
    {
        return $this->contactModel->find($search, $date, $order);
    }

    public function findByEmail($email): bool|array
    {
        return $this->contactModel->findByEmail($email)[0]["count"];
    }

    public function findByDocument($document): bool|array
    {
        return $this->contactModel->findByDocument($document)[0]["count"];
    }

    public function findByPhone($phone): bool|array
    {
        return $this->contactModel->findByPhone($phone)[0]["count"];
    }

    public function delete($id): bool
    {
        return $this->contactModel->delete($id);
    }

    public function create($data): bool
    {
        return $this->contactModel->create($data);
    }

    public function update($id, $data): bool
    {
        return $this->contactModel->update($id, $data);
    }
}