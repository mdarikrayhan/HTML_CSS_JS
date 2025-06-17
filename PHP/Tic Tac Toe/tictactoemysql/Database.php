<?php

class Database
{
    public $connection;

    public function __construct($config)
    {
        $dsn = 'mysql:' . http_build_query($config['database'], '', ';');
        $username = $config['db_user'];
        $password = $config['db_pass'];

        $this->connection = new PDO($dsn, $username, $password, [
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        ]);
    }

    public function query($query, $params = [])
    {
        $statement = $this->connection->prepare($query);
        $statement->execute($params);
        return $statement;
    }
}