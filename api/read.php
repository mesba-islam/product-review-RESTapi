<?php 

// headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

//load initialize file 

include_once('../core/initialize.php');


// instantiate Product
$product = new Product($db);

// Query
$result = $product->read();

// count and push data inside array
$num = $result->rowCount();

if($num>0){
    $product_arr = array();
    $product_arr['data'] = array();

    while($row = $result->fetch(PDO::FETCH_ASSOC)){
        extract($row);
        $product_item = array(
            'review_id' => $id,
            'user_id' => $user_id,
            'product_id' => $product_id,
            'review_text' => html_entity_decode($review_text)
        );

        array_push($product_arr['data'], $product_item);
    }
// convert data in json
    echo json_encode($product_arr);
}else{
    echo json_encode(array('message' => 'No products Found'));
}


?>