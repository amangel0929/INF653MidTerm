<?php
    class Author{
        private $conn;
        private $table = 'authors';

        //Author Properties
        public $id;
        public $author;

        public function __construct($db) {
            $this->conn = $db;
        }
        
        public function read(){
            $query = "SELECT
                id,
                author
                FROM
                " . $this->table;

            //Prepare statement
            $stmt = $this->conn->prepare($query);
            //Execute statement
            $stmt->execute();

            return $stmt;
        }
    

        //Get Single Post
        public function read_single() {
            $query = 'SELECT
                id,
                author
            FROM
                ' . $this->table . '
            WHERE
                id = ?
            LIMIT
                1';


            //Prepare statement
            $stmt = $this->conn->prepare($query);
            //Bind ID
            $stmt->bindParam(1, $this->id);
            //Execute statement
            $stmt->execute();

            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            if(!$row){
                echo json_encode('message' => "author_id Not Found");
                exit();
            }
            $this->author = $row['author'];

        }

        //Create Author
        public function create() {
            $query = 'INSERT INTO ' . $this->table . ' (author)
            VALUES (:author)';

            //Prepare statement
            $stmt = $this->conn->prepare($query);

            //Clean data
            $this->author = htmlspecialchars(strip_tags($this->author));

            //Bind data
            $stmt->bindParam(':author', $this->author);
            
            //Execute query
            $stmt->execute();
            if(!($this->author)){
                echo json_encode('message' => "Missing Required Parameters");
                exit();
            }

            return true;
        }

        //Update Author
        public function update() {
            $query = 'UPDATE ' . $this->table . '
            SET
                author = :author
            WHERE
                id = :id';

            //Prepare statement
            $stmt = $this->conn->prepare($query);

            //Clean data
            $this->id = htmlspecialchars(strip_tags($this->id));
            $this->author = htmlspecialchars(strip_tags($this->author));

            //Bind data
            $stmt->bindParam(':id', $this->id);
            $stmt->bindParam(':author', $this->author);
            
            //Execute query
            $stmt->execute();
            if(!($this->author) || !($this->id)){
                echo json_encode('message' => "Missing Required Parameters");
                exit();
            }

            return true;

        }

        //Delete Author
        public function delete() {
            $query = 'DELETE FROM ' . $this->table . ' WHERE id = :id';

             //Prepare statement
             $stmt = $this->conn->prepare($query);

            //Clean data
             $this->id = htmlspecialchars(strip_tags($this->id));

            //Bind data
            $stmt->bindParam(':id', $this->id);

            //Execute query
            $stmt->execute();
            if(!($this->id)){
                echo json_encode('message' => "author_id Not Found");
                exit();
            }

            return true;
        }
    }
?>