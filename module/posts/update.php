<?php

require_once '../../conect.php';

if(isset($_POST['title'])){
    if(isset($_POST['resume'])){
        $id = $_POST['id']; 
        $title = $_POST['title'];
        $resume = $_POST['resume'];
        $q = "UPDATE 'posts' SET title = '$title', resumen = '$resume' WHERE id = $id";
        $conn->exec($q);
        header('location:/?success=true');
    }
}



?>