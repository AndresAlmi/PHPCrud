<?php

require_once 'class/User.php';

$response = null;
function validate($key, $value){
    $retorno = null;
    if(trim($value) == ""){
        $retorno= "&$key=false";
    }
    return $retorno;
}

switch($_POST){
    case isset($_POST['username']):
        $response .= validate("username", $_POST['username']);
    case isset($_POST['password']):
        $response .= validate("password", $_POST['password']);
}

if(!$response){
    $username = $_POST['username'];
    $password = $_POST['password'];
    $password = hash('md5', $password);

    $user = User::login($username, $password);
    if($user->getUsername()){
        $sessionValue        = random_int(0,100);
        $sessionValue        = hash('md5', $sessionValue);     
        session_start();
        $_SESSION['usuario'] = $user->getUsername();
        $_SESSION['role']    = $user->getRole();
        $_SESSION['id']      = $user->getId();
        $_SESSION['csrf']    = $sessionValue;

        header("location:/");
        exit;
    }
    header("location:/?login=failed");
    exit;
}
header('location:/?success=false'.$response);
?>
