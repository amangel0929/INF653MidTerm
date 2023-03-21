<?php
    header('Access-Control-Allow-Origin:*');
    header('Content-Type:application/json');
    $method = $_SERVER['REQUEST_METHOD'];

    if ($method === 'OPTIONS') {
        header('Access-Control-Allow-Methods:GET,POST,PUT,DELETE');
        header('Access-Control-Allow-Headers:Origin,Accept,Content-Type,X-Requested-With');
        exit();
    }
    if($method === 'GET'){
        if(isset($_GET['id'])){
            include_once '../../api/authors/read_single.php';
        }else{
            include_once '../../api/authors/read.php';
        }
    }else if($method === 'POST'){
        include_once '../../api/authors/create.php';
    }else if($method === 'PUT'){
        include_once '../../api/authors/update.php';
    }else if($method === 'DELETE'){
        include_once '../../api/authors/delete.php';
    }
?>