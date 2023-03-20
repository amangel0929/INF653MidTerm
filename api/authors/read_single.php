<?php
    //Headers
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');

    include_once '../../config/';
    include_once '../../models/';

    $database = new Database();
    $db = $database->connect();

    $author = new Author($db);

    //Get ID
    $author->id = isset($_GET['id']) ? $_GET['id'] : die();

    //Get author
    $author->read_single();

    //Create array
    $author_arr = array(
        'author' => $author->author,
        'id' => $author->id
    );

    //Make json
    print_r(json_encode($author_arr));

?>

