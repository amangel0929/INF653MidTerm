<?php

    include_once '../../config/Database.php';
    include_once '../../models/Quote.php';
    include_once '../../models/Author.php';
    include_once '../../models/Category.php';

    $database = new Database();
    $db = $database->connect();

    $quote = new Quote($db);
    $category = new Category($db);
    $author = new Author($db);

    //Get ID
    $quote->id = isset($_GET['id']) ? $_GET['id'] : die();

    //Get quote
    $quote->read_single();

    //Create array
    if(read_single() === false){
        echo json_encode(
            array('message' => 'No Quotes Found')
          );
    }else{
    $quote_arr = array(
        'id' => $quote->id,
        'quote' => $quote->quote,
        'category' =>$category->category,
        'author' =>$author->author
    );
        print_r(json_encode($quote_arr));
    }

?>