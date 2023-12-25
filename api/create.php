<?php

// headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods:POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods,Authorization,X-Requested-With');

// initializing api

include_once('../core/initialize.php');


// instantiate review
$review = new Product($db);

// get raw data in JSON
$data = json_decode(file_get_contents("php://input"));

$review->user_id = $data->user_id;
$review->product_id = $data->product_id;
$review->review_text = $data->review_text;


// Validate input data
if (empty($review->user_id) || empty($review->product_id) || empty($review->review_text)) {

    // Return an error response if any of the required fields is empty
    echo json_encode(array('error' => 'All fields are required.'));

} elseif (!is_numeric($review->user_id) || !is_numeric($review->product_id)) {
    // Return an error response if user_id or product_id is not a valid numerical ID
    echo json_encode(array('error' => 'Invalid user_id or product_id.'));
    
} else {
    // Create review
    if ($review->create()) {
        // Return a success response
        echo json_encode(array('message' => 'Review added successfully.'));
    } else {
        // Return an error response if unable to add review
        echo json_encode(array('error' => 'Unable to add review.'));
    }
}
?>