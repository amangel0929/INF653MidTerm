<?php
    class Quote{
        private $conn;
        private $table = 'quotes';

        //Quote Properties
        public $id;
        public $quote;
        public $author_id;
        public $category_id;


        public function __construct($db) {
            $this->conn = $db;
        }
        
        public function read(){
            //Create query
            $query = "SELECT * 
                FROM
                " . $this->table . "
                LEFT JOIN
                    categories ON category_id = category
                LEFT JOIN
                    authors ON author_id = author";

            //Prepare statement
            $stmt = $this->conn->prepare($query);
            //Execute statement
            $stmt->execute();

            return $stmt;
        }
    

        //Get Single Post
        public function read_single() {
            $query = "SELECT *
            FROM
                " . $this->table . " 
            LEFT JOIN
                categories ON category_id = category
            LEFT JOIN
                authors ON author_id = author
            WHERE
                id =" .$_GET['id']",
                category_id =" .$_GET['category_id']",
                author_id =" .$_GET['author_id'];

            //Prepare statement
            $stmt = $this->conn->prepare($query);

            //Bind ID
            $stmt->bindParam(1, $this->id);

            //Execute statement
            $stmt->execute();

            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            $this->quote = $row['quote'];
            $this->category_id = $row['category_id'];
            $this->author_id = $row['author_id'];

        }

        //Create Quote
        public function create() {
            $query = "INSERT INTO " . $this->table . "
            VALUES
                id = :id,
                quote = :quote,
                author_id = :author_id,
                category_id = :category_id";

            //Prepare statement
            $stmt = $this->conn->prepare($query);

            //Clean data
            $this->id = htmlspecialchars(strip_tags($this->id));
            $this->quote = htmlspecialchars(strip_tags($this->quote));
            $this->author_id = htmlspecialchars(strip_tags($this->author_id));
            $this->category_id = htmlspecialchars(strip_tags($this->category_id));

            //Bind data
            $stmt->bindParam(':id', $this->id);
            $stmt->bindParam(':quote', $this->quote);
            $stmt->bindParam(':author_id', $this->author_id);
            $stmt->bindParam(':category_id', $this->category_id);
            
            //Execute query
            if($stmt->execute()){
                return true;
            }

            printf("Missing Required Parameters", $stmt->error);

            return false;
        }

        //Update Quote
        public function update() {
            $query = "UPDATE " . $this->table . "
            SET
                quote = :quote,
                author_id = :author_id,
                category_id = :category_id
            WHERE
                id = :id";

            //Prepare statement
            $stmt = $this->conn->prepare($query);

            //Clean data
            $this->quote = htmlspecialchars(strip_tags($this->quote));
            $this->author_id = htmlspecialchars(strip_tags($this->author_id));
            $this->category_id = htmlspecialchars(strip_tags($this->category_id));

            //Bind data
            $stmt->bindParam(':quote', $this->quote);
            $stmt->bindParam(':author_id', $this->author_id);
            $stmt->bindParam(':category_id', $this->category_id);
            
            //Execute query
            if($stmt->execute()){
                return true;
            }

            printf("Missing Required Parameters", $stmt->error);

            return false;
        }

        //Delete Quote
        public function delete() {
            $query = "DELETE FROM " . $this->table . " WHERE id =".$_GET['id'];

             //Prepare statement
             $stmt = $this->conn->prepare($query);

            //Clean data
             $this->id = htmlspecialchars(strip_tags($this->id));

            //Bind data
            $stmt->bindParam(':id', $this->id);

            //Execute query
            if($stmt->execute()){
                return true;
            }

            //Print error if something goes wrong
            printf("Missing Required Parameters", $stmt->error);

            return false;
        }
    }
?>