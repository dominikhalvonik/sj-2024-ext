<?php

namespace Admin;

class Admin
{
    private $host = "localhost";
    private $dbname = "sj-2024";
    private $username = "root";
    private $password = "";
    private $port = 3307;

    private $connection;

    public function __construct()
    {
        try {
            // Vytvorenie PDO objektu a pripojenie k databáze
            $this->connection = new \PDO(
                "mysql:host=$this->host;dbname=$this->dbname;port=$this->port;charset=utf8",
                $this->username,
                $this->password
            );
            // Nastavenie PDO pre zobrazenie chýb a vynucenie vyvolávania výnimiek
            $this->connection->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        } catch (\PDOException $e) {
            // Spracovanie chyby pripojenia
            echo "Chyba pri pripojení k databáze: " . $e->getMessage();
        }
    }

    public function getMenu(): array
    {
        $sql = "SELECT id, content FROM menu";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute();
        $menuData = $stmt->fetchAll(\PDO::FETCH_ASSOC);

        return $menuData;
    }
}