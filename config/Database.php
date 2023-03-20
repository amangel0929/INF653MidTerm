<?php
    class Database{
        private $conn;
        private $host;
        private $port;
        private $dbname;
        private $username;
        private $password;

        public function __construct(){
            $this->username = getEnv('USERNAME');
            $this->password = getEnv('PASSWORD');
            $this-> dbname = getEnv('DBNAME');
            $this->host = getEnv('HOST');
            $this->port = getEnv('PORT');
        }


        public function connect() {
            if ($this->conn) {
                return this->conn;
            } else {

            $dsn = "pgsql:host={$this->host};port={$this->port};dbname={$this->db_name}";

                try{
                    $this->conn = new PDO($dsn, $this->username, $this->password);
                    $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                    return $this->conn;
                } catch(PDOException $e){
                    echo 'Connection Error: ' . $e->getMessage();
                }
        }
    }
}
?>