<?php
require_once '../../config.php';
require_once '../../class/Post.php';

## Recir datos solo desde la sesion
session_start();
$csrfPOST = $_POST['csrf'];
$csrf     = $_SESSION['csrf'];

function validateCsrf($csrf, $csrfPOST){
    if($csrf != $csrfPOST){
        return false;
    }
    return true;
}
if(validateCsrf($csrf, $csrfPOST) == false){
    header('location:/?');
    exit;
};

$response = null;

function validate($key, $value){
    $retorno = null;
    if(trim($value) == ""){
        $retorno= "&$key=false";
    }
    return $retorno;
}

switch($_POST){
    case isset($_POST['title']):
        $response .= validate("title", $_POST['title']);
    case isset($_POST['resume']):
        $response .= validate("resume", $_POST['resume']);
    case isset($_POST['id']):
        $id = $_POST['id'];
        
}

if(!$response){
    $title  = $_POST['title'];
    $resume = $_POST['resume'];
    $user   = $_POST['id'];
    
    $post = Post::getPostById($id);
    $post->setTitle($title);
    $post->setResume($resume);
    $post->setUser($user);
    $post->update();
    header("location:/module/posts/edit.php?success=true&id=$id");
    exit;
}

header('location:/module/posts/edit.php?id='.$id.'&success=false' .$response);
?>