<?php

class Database
{
    const HOST = 'localhost';
    const USERNAME = 'root';
    const PASSWORD = '';
    const DB_NAME = 'phpdatabase';

    private $connect;

    public function connect()
    {
        $this->connect = mysqli_connect(self::HOST, self::USERNAME, self::PASSWORD, self::DB_NAME);

        if (mysqli_connect_errno()) {
            return false; // Trả về false nếu kết nối thất bại
        }

        // Thiết lập bộ ký tự
        mysqli_set_charset($this->connect, 'utf8');

        return $this->connect; // Trả về kết nối
    }
}