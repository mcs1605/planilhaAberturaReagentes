<?php
include 'conexao.php';

$dados = json_decode(file_get_contents("php://input"), true);

$stmt = $conn->prepare("INSERT INTO reagentes (data, reagente, lote, validade, responsavel, mes, ano) VALUES (?, ?, ?, ?, ?, ?, ?)");
$stmt->bind_param("ssssssi", $dados['data'], $dados['reagente'], $dados['lote'], $dados['validade'], $dados['responsavel'], $dados['mes'], $dados['ano']);
$stmt->execute();
$stmt->close();
$conn->close();
?>