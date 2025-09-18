<?php
$mesAtual = date('m');
$anoAtual = date('Y');
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <title>Abertura de Reagentes</title>
  <script src="script.js" defer></script>
</head>
<body>
  <h2>ABERTURA DE REAGENTES DE BIOQUÍMICA (Caixa de reagentes)</h2>
  <h3 id="mesAnoHeader"><?= date('F Y') ?></h3>

  <table id="tabelaReagentes">
    <thead>
      <tr>
        <th>Data</th>
        <th>Reagente</th>
        <th>Lote</th>
        <th>Validade</th>
        <th>Responsável</th>
      </tr>
    </thead>
    <tbody></tbody>
  </table>
  <button onclick="adicionarLinha()">➕ Adicionar Linha</button>
  <button onclick="salvarTabela()">💾 Salvar</button>

  <input type="hidden" id="mes" value="<?= $mesAtual ?>">
  <input type="hidden" id="ano" value="<?= $anoAtual ?>">
</body>
</html>