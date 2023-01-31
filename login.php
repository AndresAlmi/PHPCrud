<?php
require_once 'class/User.php';

if(isset($_GET['logout'])){
    session_start();
    $_SESSION['usuario'];
    if(!session_destroy())
    {
        echo "session not destroyed";
    }
    else {
        echo "session destroyed";
    }
    exit;
    header('location:/?');
}
if(isset($_POST['username'])){

    if(isset($_POST['password'])){
        
        ## variables POST ##
        $username = $_POST['username'];
        $password = $_POST['password'];
        ####################

        ## Validacion Vacios ##

        $GET = NULL;
        if(trim($username) == ""){
            $GET .= '&username=false';
        }
        if(trim($password) == ""){
            $GET .= '&password=false';
        }
        if($GET){
            header('location:/?success=false' . $GET);
            exit;
        }
        #######################
        
        ## Encriptacion ##
        $password = hash('md5', $password);
        #######################

        $user = User::login($username, $password);
        session_start();
        $_SESSION['usuario'] = $user->getUsername();
        header("location:/");

    }else{
        header('location:/?success=false&password=false');
    }
}else{
    header('location:/?success=false&username=false');
}


?>