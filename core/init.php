<?php 
session_start();
include 'db/db.php';
include 'classes/messages.php';
include 'classes/post.php';
include 'classes/user-1.php';
include 'classes/curd.php';

$user = new User($pdo);
$message = new Message($pdo);
$post = new Post($pdo);


?>
