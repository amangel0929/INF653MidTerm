<?php

    include_once '../../config/Database.php';
    include_once '../../models/Category.php';

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

        while($row = $result->fetch(PDO::FETCH_ASSOC)){
            extract($row);

            $category_item = array(
                'id' => $id,
                'category' => $category
            );

            //Push to "data"
            array_push($category_arr, $category_item);
        }
        //Turn to json and output
        echo json_encode($category_arr);
    } else {
        $message = array("message" => "category_id Not Found");
        echo json_encode($message);
    }
?>