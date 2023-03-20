<?php
    //Headers
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');

    include_once '../../config/';
    include_once '../../models/';

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
        $authors_arr[] = array();

        while($row = $result->fetch(PDO::FETCH_ASSOC)){
            extract($row);

            $author_item = array(
                'id' => $id,
                'author' => $author;
            );

            //Push to "data"
            array_push($authors_arr[], $author_item);
        }
        //Turn to json and output
        echo json_encode($authors_arr);
    } else {
        $message = ["message" => 'author-id Not found']
        echo json_encode($message);
    }
?>