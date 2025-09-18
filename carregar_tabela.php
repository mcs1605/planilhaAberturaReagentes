<?php
include 'conexao.php';

$mesAno = explode('-', $_GET['mesAno']);
$mes = intval($mesAno[0]);
$ano = intval($mesAno[1]);

$sql = "SELECT * FROM reagentes WHERE mes = ? AND ano = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ii", $mes, $ano);
$stmt->execute();
$result = $stmt->get_result();

$dados = [];
while ($row = $result->fetch_assoc()) {
  $dados[] = $row;
}

echo json_encode($dados);
?>