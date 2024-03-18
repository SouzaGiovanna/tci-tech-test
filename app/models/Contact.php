<?php

namespace App\Models;

use App\Core\Database\IDatabase;

class Contact {

    private string $table = 'contacts';

    public array $fields = [
        'name',
        'alias',
        'document',
        'phone',
        'email',
        'created_at',
        'updated_at'
    ];

    public function __construct(
        protected IDatabase $db
    ) { }

    public function all($date, $order): bool|array
    {
        $query = "SELECT * FROM $this->table
                        group by name
                        order by $date $order";

        return $this->db->execute($query);
    }

    public function findById($id): bool|array
    {
        $query = "SELECT * FROM $this->table WHERE id = :id";

        return $this->db->execute($query, [':id' => $id]);
    }

    public function find($search, $date = 'created_at', $order = 'desc'): bool|array
    {
        $query = "SELECT * FROM $this->table WHERE 
                        name like '%$search%' or 
                        alias like '%$search%' or 
                        document like '%$search%' or 
                        phone like '%$search%' or 
                        email like '%$search%'
                        group by name
                        order by $date $order";

        return $this->db->execute($query);
    }

    public function findByEmail($email): bool|array
    {
        $query = "SELECT count(id) as count FROM $this->table WHERE email = '$email'";

        return $this->db->execute($query);
    }

    public function findByDocument($document): bool|array
    {
        $query = "SELECT count(id) as count FROM $this->table WHERE document = '$document'";

        return $this->db->execute($query);
    }

    public function findByPhone($phone): bool|array
    {
        $query = "SELECT count(id) as count FROM $this->table WHERE phone = '$phone'";

        return $this->db->execute($query);
    }

    public function delete($id): bool
    {
        $query = "DELETE FROM $this->table WHERE id = :id";

        return !!$this->db->execute($query, [':id' => $id]);
    }

    public function create($contact): bool
    {
        try{
            date_default_timezone_set('America/Sao_Paulo');

            $contact['created_at'] = date('Y-m-d H:i:s');
            $contact['updated_at'] = date('Y-m-d H:i:s');

            $fields = implode(', ', $this->fields);

            $query = "INSERT INTO $this->table ($fields) VALUES (
                '$contact[name]',
                '$contact[alias]',
                '$contact[document]',
                '$contact[phone]',
                '$contact[email]',
                '$contact[created_at]',
                '$contact[updated_at]'
            )";

            $this->db->execute($query);

            return true;
        } catch (\Exception $e) {
            return false;
        }
    }

    public function update($id, $contact): bool
    {
        try{
            date_default_timezone_set('America/Sao_Paulo');

            $updated = date('Y-m-d H:i:s');

            $query = "UPDATE $this->table SET 
                name = '$contact[name]',
                alias = '$contact[alias]',
                document = '$contact[document]',
                phone = '$contact[phone]',
                email = '$contact[email]',
                updated_at = '$updated'
                WHERE id = $id";

            $this->db->execute($query);

            return true;
        } catch (\Exception $e) {
            return false;
        }
    }
}
