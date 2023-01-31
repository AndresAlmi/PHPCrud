<?php

require_once '../../conect.php';

if(isset($_POST['title'])){
    if(isset($_POST['resume'])){
        $title = $_POST['title'];
        $resume = $_POST['resume'];
        $q = "INSERT INTO 'posts'(title, resumen) VALUES('$title', '$resume')";
        $conn->exec($q);
        header('location:/?success=true');
    }
}



?>