<?php

    include_once '../../config/Database.php';
    include_once '../../models/Author.php';

    $database = new Database();
    $db = $database->connect();

    $author = new Author($db);

    //Get ID
    $author->id = isset($_GET['id']) ? $_GET['id'] : die();

    //Get author
    $author->read_single();

   //Create array
   if($author->read_single()->isValid('id')){
        $author_arr = array(
            'id' => $author->id,
            'author' => $author->category
        );
    }else{
        echo json_encode(
            array('message' => 'author_id Not Found')
        );
    }
?>
