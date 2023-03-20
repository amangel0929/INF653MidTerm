<?php
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    $method = $_SERVER['REQUEST_METHOD'];

    if ($method === 'OPTIONS') {
        header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');
        header('Access-Control-Allow-Headers: Origin, Accept, Content-Type, X-Requested-With');
        exit();
    }else if($method === 'GET'){
        include_once '../../api/quotes/read.php';
        include_once '../../api/quotes/read_single.php';
    }else if($method === 'POST'){
        include_once '../../api/quotes/create.php';
    }else if($method === 'PUT'){
        include_once '../../api/quotes/update.php';
    }else if($method === 'DELETE'){
        include_once '../../api/quotes/delete.php';
    }
?>