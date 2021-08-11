<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/../config/main.php";
require_once CONFIG_DIR . "engine.php";
require_once ENGINE_DIR . "db.php";

$apiURL = 'https://jsonplaceholder.typicode.com/posts';
$response = file_get_contents_curl($apiURL);
$jsonResponse = json_decode($response, true);
$countOfPosts = 0;
foreach($jsonResponse as $item){
    $id = $item['id'];
    $userId = $item['userId'];
    $title = $item['title'];
    $body  = $item['body'];

$query = ("INSERT INTO posts (id, user_id, title, body) VALUES('$id', '$userId', '$title', '$body')");

$result = mysqli_query(getConnection(), $query);
$countOfPosts+= mysqli_affected_rows(getConnection());
}
 

$apiURL = 'https://jsonplaceholder.typicode.com/comments';
$response = file_get_contents_curl($apiURL);
$jsonResponse = json_decode($response, true);
$countOfComments = 0;
foreach($jsonResponse as $item){
    $id = $item['id'];
    $postId = $item['postId'];
    $name = $item['name'];
    $email  = $item['email'];
    $body  = $item['body'];

$query = ("INSERT INTO comments (id, post_id, name, email, body) VALUES('$id', '$postId', '$name', '$email', '$body')");

    $dataatodb = mysqli_query(getConnection(), $query);
$countOfComments+= mysqli_affected_rows(getConnection());   
}

if ($result  && $dataatodb) 
echo "<script>console.log('Загружено ". $countOfPosts ." записей и ". $countOfComments. " комментариев' );</script>";

include VIEWS_DIR . "index.php";
