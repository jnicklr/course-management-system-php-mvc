<?php

namespace App\Infrastructure\Persistence;

use PDO;
use PDOException;

class Database
{
    private string $host;
    private string $port;
    private string $dbname;
    private string $user;
    private string $password;

    public function __construct($host, $port, $dbname, $user, $password)
    {
        $this->host = $host;
        $this->port = $port;
        $this->dbname = $dbname;
        $this->user = $user;
        $this->password = $password;
    }

    public function getConnection(): PDO
    {
        try {
            $connection = new PDO("pgsql:host={$this->host};port={$this->port};dbname={$this->dbname}",  $this->user, $this->password);
            $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $connection->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo 'Connection failed: ' . $e->getMessage();
        }
        return $connection;
    }

    public function buildTables(): void
    {
        try {
            $connection = $this->getConnection();

            $connection->beginTransaction();
            
            $connection->exec('
                CREATE TABLE IF NOT EXISTS videos (
                    id SERIAL PRIMARY KEY,
                    url VARCHAR(255) NOT NULL,
                    title VARCHAR(255) NOT NULL,
                    image_path VARCHAR(255) NOT NULL
                );

                CREATE TABLE IF NOT EXISTS users (
                    id SERIAL PRIMARY KEY,
                    name VARCHAR(255) NOT NULL,
                    email VARCHAR(255) NOT NULL,
                    password VARCHAR(255) NOT NULL
                );
            ');

            $connection->commit();
        } catch (PDOException $e) {
            $connection->rollBack();
            echo 'Table creation failed: ' . $e->getMessage();
        }
    }
}
