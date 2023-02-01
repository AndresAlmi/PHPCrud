<?php

require_once '../../class/User.php';

if(isset($_GET['id'])){
    $id = $_GET['id'];
    $user = User::getUserById($id);
    $user->delete();
    header('location:/module/users/?success=true');
}

?>
