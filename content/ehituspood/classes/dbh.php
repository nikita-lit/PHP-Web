<?php
    /*
    CREATE TABLE users (
        id int PRIMARY KEY AUTO_INCREMENT,
        username varchar(30) UNIQUE NOT NULL,
        email varchar(50) UNIQUE,
        password varchar(255) NOT NULL,
        reg_date datetime,
        role varchar(100) DEFAULT 'client'
    );
    
    */

    // Handler for database connection
    class DBH
    {
        private $servername = "localhost";
        private $username = "nikitalitvinenko";
        private $password = "1234";
        private $dbname = "nikitalitvinenko";
        private $connect;

        public function __construct()
        {
            $this->connect = new mysqli($this->servername, $this->username, $this->password, $this->dbname);
            $this->connect->set_charset("utf8");
        }

        public function GetConnection()
        {
            return $this->connect;
        }
        
        public function CloseConnection()
        {
            $this->connect->close();
        }
    }