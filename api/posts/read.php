<?php
//Headers

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../config/Database.php';
include_once '../../models/Post.php';

// Create DB & connect
$databae = new Database();
$db = $databae->connect();

// Create blog post obj
$post = new Post($db);

//blog post querry
$result = $post->read();
//get row count
$num = $result->rowCount();

// check if any posts
if($num>0){
    $posts_arr = array();
    $post_arr['data'] = array();

    while($row = $result->fetch(PDO::FETCH_ASSOC)){
        extract($row);

        $post_item = array(
            'id'=> $id,
            'title'=>$title,
            'body'=>$body,
            'author'=>$author,
            'category_id'=>$category_id,
            'category_name'=> $category_name
        );
        //push to data
        array_push($post_arr['data'], $post_item);
    }
//turn post arr into json
echo json_encode($post_arr);

}else{
    echo json_encode(
        array(
            'message' => 'No Posts Found'
        )
        );
}