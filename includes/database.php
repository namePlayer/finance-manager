<?php
try {
    $dbConnection = new PDO('mysql:host=localhost;dbname=financeManager', 'root', '');
} catch(PDOException $exception) {
    // die('[ DBERROR | ' . $exception->getCode() . '] ' . $exception->getMessage());

    die('Database Connection failed!');
}