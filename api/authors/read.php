<?php

    include_once '../../config/Database.php';
    include_once '../../models/Author.php';

    $database = new Database();
    $db = $database->connect();

    $author = new Author($db);

    //Author read query

    $result = $author->read();
    //Get row count
    $num = $result->rowCount();

    //Check if any authors
    if($num >0) {
        //Author array
        $authors_arr = array();

        while($row = $result->fetch(PDO::FETCH_ASSOC)){
            extract($row);

            $author_item = array(
                'id' => $id,
                'author' => $author
            );

            //Push to "data"
            array_push($authors_arr, $author_item);
        }
        //Turn to json and output
        echo json_encode($authors_arr);
    } else {
        $message = array("message" => "author_id Not Found");
        echo json_encode($message);
    }
?>