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
    $author_arr = array(
        'author' => $author->author,
        'id' => $author->id
    );

    //Make json
    print_r(json_encode($author_arr));

?>

