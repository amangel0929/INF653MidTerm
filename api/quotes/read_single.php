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
        'category_id' =>$quote->category_id,
        'author_id' =>$quote->author_id
    );
        print_r(json_encode($quote_arr));

?>