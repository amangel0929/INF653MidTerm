<?php

    include_once '../../config/Database.php';
    include_once '../../models/Author.php';

    $database = new Database();
    $db = $database->connect();

    $author = new Author($db);

    //Get raw posted data
    $data = json_decode(file_get_contents('php://input'));

    //Set ID to update
    try{
        $author->id = $data->id;
        $author->author = $data->author;  
    }catch(Exception $e){
        $e = array("message" => "author_id Not Found");
        echo json_encode($e);
    }
    
    if($author->update()){
        $result = $author_arr = array(
            'id' => $author->id,
            'author' => $author->author
        );
        echo json_encode($result);
    }
?>