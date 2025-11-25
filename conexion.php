
 <?php

    class Database
    {
        public $host = 'localhost';
        public $baseDeDatos = 'navidad';
        public $username = 'admin';
        public $password = 'Studium2025#';

        public $connection;

        public function getConnection()
        {
            $this->connection=null;

            $this->connection = mysqli_connect($this->host, $this->username, $this->password, $this->baseDeDatos);
            if (!$this->connection) {
                exit('No se puede conectar:' . mysqli_connect_error());
            }

            return $this->connection;
        }
    }

    ?>

    
