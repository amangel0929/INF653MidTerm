<?php
    class Category{
        private $conn;
        private $table = 'categories';

        //Author Properties
        public $id;
        public $category;

        public function __construct($db) {
            $this->conn = $db;
        }
        
        public function read(){
            $query = "SELECT
                id,
                category
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
            $query = "SELECT
                id,
                category
            FROM
                " . $this->table . "
            WHERE
                id = ?
            LIMIT
                1";
            try{
            //Prepare statement
            $stmt = $this->conn->prepare($query);
            //Bind ID
            $stmt->bindParam(1, $this->id);
            //Execute statement
            $stmt->execute();

            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            }catch(PDOException $e){
                echo json_encode(
                    array('message' => 'category_id Not Found')
                  );
            }
            $this->category = $row['category'];

        }

        //Create Category
        public function create() {
            $query = "INSERT INTO " . $this->table . "
            VALUES
                category";

            //Prepare statement
            $stmt = $this->conn->prepare($query);

            //Clean data
            $this->category = htmlspecialchars(strip_tags($this->category));

            //Bind data
            $stmt->bindParam(':category', $this->category);
            
            //Execute query
            if($stmt->execute()){
                return true;
            }

            printf("Missing Required Parameters", $stmt->error);

            return false;
        }

        //Update Category
        public function update() {
            $query = "UPDATE " . $this->table . "
            SET
                category = :category
            WHERE
                id = :id";

            //Prepare statement
            $stmt = $this->conn->prepare($query);

            //Clean data
            $this->id = htmlspecialchars(strip_tags($this->id));
            $this->category = htmlspecialchars(strip_tags($this->category));

            //Bind data
            $stmt->bindParam(':id', $this->id);
            $stmt->bindParam(':category', $this->category);
            
            //Execute query
            if($stmt->execute()){
                return true;
            }

            printf("Missing Required Parameters", $stmt->error);

            return false;
        }

        //Delete Category
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