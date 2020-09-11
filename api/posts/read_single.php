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

//GET ID FROM URL

$post->id = isset($_GET['id']) ? $_GET['id'] : die();

// GET single post

$post->read_single();

//create array
$post_arr = array(
    'id' => $post->id,
    'title' => $post->title,
    'body' => $post->body,
    'author' => $post->author,
    'category_id' => $post->category_id,
    'category_name' => $post->category_name
);

//convert to JSON

print_r(json_encode($post_arr));