<?php
//Headers

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: DELETE');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Access-Control-Allow-Methods,Content-Type,Authorization,X-Requested-With');


include_once '../../config/Database.php';
include_once '../../models/Post.php';

// Create DB & connect
$databae = new Database();
$db = $databae->connect();

// Create blog post obj
$post = new Post($db);

//Grab Id
$post->id = isset($_GET['id']) ? $_GET['id'] : die();


// Delete Post
$delid = $post->delete();

if($delid){
    echo json_encode(
        array('message'=> $delid )
    );
    }else{
    echo json_encode(
      array('message'=>'Post Not Deleted')
    );
    }