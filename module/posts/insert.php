<?php

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
}

if(!$response){
    $title = $_POST['title'];
    $resume = $_POST['resume'];
    $user = $_POST['idUser'];
    
    $post = new Post();
    $post->setTitle($title);
    $post->setResume($resume);
    $post->setUser($user);
    $post->insert();
    header('location:/?success=true');
    exit;
}
header('location:/?success=false'.$response);
?>