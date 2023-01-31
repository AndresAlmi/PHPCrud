<?php

require_once '../../conect.php';

if(isset($_GET['id'])){
    $id = $_GET['id'];
    $q = "DELETE FROM 'posts' WHERE id = $id";
    $conn->exec($q);
    header('location:/?success=true');
}

?>
