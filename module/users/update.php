<?php

require_once '../../class/User.php';
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
function validatePassword($password, $repeat){
    if($password === $repeat){
        return true;
    }
    return false;
}

switch($_POST){
    case isset($_POST['username']):
        $response .= validate("username", $_POST['username']);
    case isset($_POST['password']):
        $response .= validate("password", $_POST['password']);
    case isset($_POST['id']):
        $id = $_POST['id'];
        
}

if(!$response){
    $username = $_POST['username'];
    $password = $_POST['password'];
    $repeat   = $_POST['rPassword'];
    if(validatePassword($password, $repeat) == true){
        $user = User::getUserById($id);
        $password = hash('md5', $password);
        $_SESSION['usuario'] = $username;
        $user->setUsername($username);
        $user->setPassword($password);
        $user->update();
        header("location:/module/users/edit.php?success=true&id=$id");
        exit;
    }else{
        header("location:/module/users/edit.php?success=false&id=$id&pfailed=passwordNotEqual");
    }
    

}

header('location:/module/users/edit.php?id='.$id.'&success=false' .$response);
?>