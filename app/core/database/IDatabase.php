<?php

namespace App\Core\Database;

interface IDatabase {
    public function getConnection();
    public function execute(string $query, array $params = []): array | false;

    public function lastInsertId();

}
