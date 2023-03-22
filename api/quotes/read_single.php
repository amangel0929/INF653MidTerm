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
    if($quote->id != null){
        //Get quote
        $quote->read_single();

        //Create array
        $quote_arr = array(
            'id' => $quote->id,
            'quote' => $quote->quote,
            'category_' =>$quote->category_id,
            'author' =>$quote->author_id
        );
        print_r(json_encode($quote_arr));
    }else{
        echo json_encode(
            array('message' => 'No Quotes Found')
        );
    }

?>