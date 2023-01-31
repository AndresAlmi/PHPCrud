<?php

require_once '../../class/Post.php';

if(isset($_GET['id'])){
    $id = $_GET['id'];
    $post=Post::getPostById($id);
    $post->delete();
    header('location:/?success=true');
}

?>
