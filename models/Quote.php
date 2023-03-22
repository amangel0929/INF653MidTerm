<?php
    #[AllowDynamicProperties]
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
            $query = "SELECT 
                quotes.id,
                quotes.quote,
                categories.category,
                authors.author
                FROM
                " . $this->table . "
                INNER JOIN
                    categories ON quotes.category_id = categories.id
                INNER JOIN
                    authors ON quotes.author_id = authors.id";

            //Prepare statement
            $stmt = $this->conn->prepare($query);
            //Execute statement
            $stmt->execute();

            return $stmt;
        }
    

        //Get Single Post
        public function read_single() {
            $query = 'SELECT 
                quotes.id,
                quotes.quote,
                categories.category as category,
                authors.author as author
            FROM
                ' . $this->table . ' 
            INNER JOIN
                categories ON quotes.category_id = categories.id
            INNER JOIN
                authors ON quotes.author_id = authors.id
            WHERE
                quotes.id = ?
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
                $message = array("message" => "No Quotes Found");
                echo json_encode($message);
                exit();
            }

            $this->quote = $row['quote'];
            $this->category = $row['category'];
            $this->author = $row['author'];

        }

        //Create Quote
        public function create() {
            $query = 'INSERT INTO ' . $this->table . ' (quote, author_id, category_id)
            VALUES
                (:quote, :author_id, :category_id)';

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
            $stmt->execute();
            if(!($this->quote) || !($this->author_id) || !($this->category_id)){
                $message = array("message" => "Missing Required Parameters");
                echo json_encode($message);
                exit();
            }

            return true;
        }

        //Update Quote
        public function update() {
            $query = 'UPDATE ' . $this->table . '
            SET
                quote = :quote,
                author_id = :author_id,
                category_id = :category_id
            WHERE
                id = :id';

            //Prepare statement
            $stmt = $this->conn->prepare($query);
            //check if null before cleaning
            if(!($this->quote)){
                $message = array("message" => "No Quotes Found");
                echo json_encode($message);
                exit();
            } else if (!($this->author_id)){
                $message = array("message" => "author_id Not Found");
                echo json_encode($message);
                exit();
            } else if (!($this->category_id)){
                $message = array("message" => "category_id Not Found");
                echo json_encode($message);
                exit();
            }
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
            printf("Missing Required Parameters", stmt->error);
            return false;
            
        }

        //Delete Quote
        public function delete() {
            $query = 'DELETE FROM ' . $this->table . ' WHERE id = :id';

             //Prepare statement
             $stmt = $this->conn->prepare($query);

            //Clean data
             $this->id = htmlspecialchars(strip_tags($this->id));

            //Bind data
            $new = $stmt->bindParam(':id', $this->id);

            //Execute query
            if(!($new)){
                $message = array("message" => "No Quotes Found");
                echo json_encode($message);
                exit();
            }
            $stmt->execute();
            return true;
        }
    }
?>