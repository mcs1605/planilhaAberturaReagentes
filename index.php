<?php
$mesAtual = date('m');
$anoAtual = date('Y');
?>

<?php
include 'conexao.php';
$result = $conn->query("SELECT DISTINCT mes, ano FROM reagentes ORDER BY ano DESC, mes DESC");
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

    <label for="menuMeses">Selecionar mês:</label>
    <select id="menuMeses" onchange="carregarTabela()">
        <?php while ($row = $result->fetch_assoc()): 
            $mesNome = date('F', mktime(0, 0, 0, $row['mes'], 10));
            echo "<option value='{$row['mes']}-{$row['ano']}'>{$mesNome} {$row['ano']}</option>";
        endwhile; ?>
    </select>

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