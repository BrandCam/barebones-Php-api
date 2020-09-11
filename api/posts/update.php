<?php
//Headers

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: PUT');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Access-Control-Allow-Methods,Content-Type,Authorization,X-Requested-With');


include_once '../../config/Database.php';
include_once '../../models/Post.php';

// Create DB & connect
$databae = new Database();
$db = $databae->connect();

// Create blog post obj
$post = new Post($db);

//Grab id
$post->id = isset($_GET['id']) ? $_GET['id'] : die();
//Get JSON data
$data = json_decode(file_get_contents("php://input"));

$post->title = $data->title;
$post->body = $data->body;
$post->author = $data->author;
$post->category_id = $data->category_id;

//Create post
if($post->update()){
echo json_encode(
    array('message'=>'Post Updated')
);
}else{
echo json_encode(
  array('message'=>'Post Not Updated')
);
}