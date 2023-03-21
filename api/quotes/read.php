<?php
include_once '../../config/Database.php';
include_once '../../models/Quote.php';

$database = new Database();
$db = $database->connect();

$quote = new Quote($db);

//Author read query

$result = $quote->read();
//Get row count
$num = $result->rowCount();

//Check if any quotes
if($num >0) {
    //Quote array
    $quotes_arr = array();
    $quotes_arr['data'] = array();

    while($row = $result->fetch(PDO::FETCH_ASSOC)){
        extract($row);

        $quote_item = array(
            'id' => $id,
            'quote' => $author,
            'category_id' => $category_id,
            'author_id' => $author_id
        );

        //Push to array
        array_push($quotes_arr['data'], $quote_item);
    }
    
    //Turn to json and output
    echo json_encode($quotes_arr);
} else {
    $message = array("message" => "No Quotes Found");
        echo json_encode($message);
}
?>