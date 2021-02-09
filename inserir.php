<?php
    header('Content-Type: application/json');

    $nome = $_POST['nome'];
    $telefone = $_POST['telefone'];

    $pdo = new PDO('mysql:host=localhost; dbname=crud;', 'root', '');

    $stmt = $pdo->prepare('INSERT INTO atendimento (nome, telefone) VALUES (:na, :co)');
    $stmt->bindValue(':na', $nome);
    $stmt->bindValue(':co', $telefone);
    $stmt->execute();

    if ($stmt->rowCount() >= 1) {
        echo json_encode('Atendimento Salvo com Sucesso');
    } else {
        echo json_encode('Falha ao salvar Atendimento');
    }

    ?>