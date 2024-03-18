<?php

namespace App\Core\Database\Providers;

use App\Core\database\IDatabase;
use PDO;
use PDOException;

class MysqlProvider implements IDatabase {

    private $host = 'localhost';
    private $db_name = 'contacts_test';
    private $username = 'root';
    private $password = 'root';

    public PDO $connection;

    public function __construct() {
        $this->getConnection();
    }

    public function getConnection(): ?PDO  {
        try {
            $this->connection = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
            $this->connection->exec("set names utf8");
        } catch(PDOException $exception) {
            echo "Connection error: " . $exception->getMessage();
        }

        return $this->connection;
    }

    public function execute(string $query, array $params = []): array | false {
        $stmt = $this->connection->prepare($query);

        if(!empty($params)) {
            foreach($params as $key => $value) {
                $stmt->bindParam($key, $value);
            }
        }

        if(!$stmt->execute()) return false;

        return $stmt->fetchAll(PDO::FETCH_ASSOC);

    }

    public function lastInsertId(): bool|string {
        return $this->connection->lastInsertId();
    }
}