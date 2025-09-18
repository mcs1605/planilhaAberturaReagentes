const reagentes = ['Na++', 'K+', 'CREA', 'URE', 'TBIL', 'Bu/Bc', 'TGO', 'ALTV', 'GLU', 'AMYL', 'CPK', 'CKMB', 'TROP'];

function adicionarLinha() {
  const hoje = new Date().toISOString().split('T')[0];
  const validade = new Date();
  validade.setFullYear(validade.getFullYear() + 1);
  const validadeFormatada = validade.toISOString().split('T')[0];

  const tbody = document.querySelector('#tabelaReagentes tbody');
  const tr = document.createElement('tr');

  tr.innerHTML = `
    <td><input type="date" value="${hoje}"></td>
    <td>
      <select>
        ${reagentes.map(r => `<option value="${r}">${r}</option>`).join('')}
      </select>
    </td>
    <td><input type="text" maxlength="11" oninput="formatarLote(this)"></td>
    <td><input type="date" value="${validadeFormatada}"></td>
    <td><input type="text" maxlength="20"></td>
  `;
  tbody.appendChild(tr);
}

function formatarLote(input) {
  let valor = input.value.replace(/-/g, '').slice(0, 9);
  input.value = valor.replace(/(.{4})(?=.)/g, '$1-');
}

function salvarTabela() {
  const linhas = document.querySelectorAll('#tabelaReagentes tbody tr');
  const mes = document.getElementById('mes').value;
  const ano = document.getElementById('ano').value;

  linhas.forEach(tr => {
    const dados = Array.from(tr.querySelectorAll('input, select')).map(el => el.value);
    fetch('salvar_linha.php', {
      method: 'POST',
      headers: {'Content-Type': 'application/json'},
      body: JSON.stringify({
        data: dados[0],
        reagente: dados[1],
        lote: dados[2],
        validade: dados[3],
        responsavel: dados[4],
        mes,
        ano
      })
    });
  });

  alert('Dados salvos com sucesso!');
}

function carregarTabela() {
  const mesAno = document.getElementById('menuMeses').value;
  const tbody = document.querySelector('#tabelaReagentes tbody');
  tbody.innerHTML = '';

  fetch(`carregar_tabela.php?mesAno=${mesAno}`)
    .then(res => res.json())
    .then(dados => {
      dados.forEach(linha => {
        const tr = document.createElement('tr');
        tr.innerHTML = `
          <td><input type="date" value="${linha.data}"></td>
          <td>
            <select>
              ${reagentes.map(r => `<option value="${r}" ${r === linha.reagente ? 'selected' : ''}>${r}</option>`).join('')}
            </select>
          </td>
          <td><input type="text" maxlength="11" value="${linha.lote}" oninput="formatarLote(this)"></td>
          <td><input type="date" value="${linha.validade}"></td>
          <td><input type="text" maxlength="20" value="${linha.responsavel}"></td>
        `;
        tbody.appendChild(tr);
      });
    });
}