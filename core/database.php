<?php

class Database
{
    const HOST = 'localhost';
    const PORT = 3307; // Remove quotes to make it an integer
    const USERNAME = 'root';
    const PASSWORD = '';
    const DB_NAME = 'phpdatabase';
    private $connect;

    // Configure database connection
    public function connect()
    {
        $this->connect = mysqli_connect(self::HOST, self::USERNAME, self::PASSWORD, self::DB_NAME, self::PORT);
        if (mysqli_connect_errno()) {
            return false; 
        }
        mysqli_set_charset($this->connect, 'utf8');
        return $this->connect;
    }
}