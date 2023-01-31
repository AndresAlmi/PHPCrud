<?php
    require_once 'config.php';
    $conn=new SQLite3('/PHPCRUD/db/db') or die('No se puede ejecutar');
    $q = "CREATE TABLE IF NOT EXISTS 'posts'(id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, title VARCHAR(25), resumen TEXT)";
    $conn->exec($q);
?>