<?php
    //Headers
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');

    include_once '../../config/';
    include_once '../../models/';

    $database = new Database();
    $db = $database->connect();

    $category = new CAtegory($db);

    //Category read query

    $result = $category->read();
    //Get row count
    $num = $result->rowCount();

    //Check if any categories
    if($num >0) {
        //Category array
        $category_arr = array();
        $category_arr[] = array();

        while($row = $result->fetch(PDO::FETCH_ASSOC)){
            extract($row);

            $category_item = array(
                'id' => $id,
                'category' => $category;
            );

            //Push to "data"
            array_push($category_arr[], $category_item);
        }
        //Turn to json and output
        echo json_encode($category_arr);
    } else {
        $message = ["message" => "category-id Not found"]
        echo json_encode($message);
    }
?>