<?php

class Product
{
    private $conn;
    private $table = 'reviews';

    // product properties

    public $user_id;
    public $product_id;
    public $review_text;

    // constructor with db connection
    public function __construct($db)
    {
        $this->conn = $db;
    }

    // getting product
    public function read()
    {
        $query = "SELECT * FROM reviews";

        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt;
    }

    // create function

    public function create()
    {
        // query
        $query = 'INSERT INTO ' . $this->table . ' (user_id, product_id, review_text) VALUES (:user_id, :product_id, :review_text)';

        // preparing statement
        $stmt = $this->conn->prepare($query);

        // sanitize data
        $this->user_id = htmlspecialchars(strip_tags($this->user_id));
        $this->product_id = htmlspecialchars(strip_tags($this->product_id));
        $this->review_text = htmlspecialchars(strip_tags($this->review_text));

        // binding of parameters
        $stmt->bindParam(':user_id', $this->user_id);
        $stmt->bindParam(':product_id', $this->product_id);
        $stmt->bindParam(':review_text', $this->review_text);

        // execute the query
        if ($stmt->execute()) {
            return true;
        }

        // error statement
        printf("Error %s. \n", $stmt->error);
        return false;
    }
}
