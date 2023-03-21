<?php

    include_once '../../config/Database.php';
    include_once '../../models/Quote.php';

    $database = new Database();
    $db = $database->connect();

    $quote = new Quote($db);

    //Get ID
    $quote->id = isset($_GET['id']) ? $_GET['id'] : die();

    //Get quote
    $quote->read_single();

    //Create array
    $quote_arr = array(
        'id' => $quote->id,
        'quote' => $quote->quote,
        'category' =>$quote->category,
        'author' =>$quote->author
    );
    if($quote_arr['id'] == false || is_null($quote_arr['id'])){
        echo json_encode(
            array('message' => 'No Quotes Found')
          );
    } else if($quote_arr['category'] == false || is_null($quote_arr['category'])){
        echo json_encode(
            array('message' => 'category_id Not Found')
          );
    } else if($quote_arr['author'] == false || is_null($quote_arr['author'])){
        echo json_encode(
            array('message' => 'author_id Not Found')
          );
    } else{
        print_r(json_encode($quote_arr));
    }

?>