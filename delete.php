<?php
    header('Content-Type: application/json');

    $id = $_POST['id'];

    $pdo = new PDO('mysql:host=localhost; dbname=crud;', 'root', '');

$smtp = $pdo->prepare("DELETE FROM atendimentos WHERE id ='$id'");
$smtp->execute();

?>