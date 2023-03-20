<?php
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    $method = $_SERVER['REQUEST_METHOD'];

    if ($method === 'OPTIONS') {
        header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');
        header('Access-Control-Allow-Headers: Origin, Accept, Content-Type, X-Requested-With');
        exit();
    }else($method === 'GET'){
        include_once '../../api/authors/read.php';
        include_once '../../api/authors/read_single.php';
    }else($method === 'POST'){
        include_once '../../api/authors/create.php';
    }else($method === 'PUT'){
        include_once '../../api/authors/update.php';
    }else($method === 'DELETE'){
        include_once '../../api/authors/delete.php';
    }
?>