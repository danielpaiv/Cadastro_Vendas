<?php

include_once 'conexao.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vendas</title>
</head>
<style>
    body {
        background-color: #191970; /* Cor de fundo da página */
        font-family: Arial, sans-serif;
        margin: 20px;
    }

    table {
        background-color: #c4bdbdff;
        border-collapse: collapse;
        width: 100%;
    }

    th, td {
        border: 1px solid #234432;
        padding: 8px;
    }

    th {
        background-color: #000000ff; /* Cor de fundo do cabeçalho da tabela */
        color: #ffffffff; /* Cor do texto do cabeçalho */
        text-align: left;
    }

    tr:hover {
        background-color: #f5f5f5;
    }
</style>
<body>
    <table id="vendas">
        <thead>
            <tr>
                <th>ID</th>
                <th>Produto</th>
                <th id="valor">Valor</th>
                <th id="quantidade">Quantidade</th>
                <th>Data da Venda</th>
            </tr>
        </thead>
        <tbody>
            <?php
                // Consulta para obter os dados das vendas
                $query = "SELECT * FROM vendas" . " ORDER BY id DESC";// Ordena os resultados por ID em ordem decrescente
                // Executa a consulta
                $result = mysqli_query($conn, $query);// Verifica se a consulta foi bem-sucedida
                if (!$result) {
                    die("Erro na consulta: " . mysqli_error($conn));// Exibe mensagem de erro se a consulta falhar
                }
                while ($userdata = mysqli_fetch_assoc($result)) {// Percorre os resultados da consulta
                    // Exibe cada venda em uma linha da tabela
                    echo "<tr>";
                    echo "<td>" . $userdata['id'] . "</td>";
                    echo "<td>" . $userdata['produto'] . "</td>";
                    echo "<td>" . $userdata['valor'] . "</td>";
                    echo "<td>" . $userdata['quantidade'] . "</td>";
                    echo "<td>" . $userdata['data_venda'] . "</td>";
                    echo "</tr>";
                }
            ?>
        </tbody>

    </table>
        <script>
           document.addEventListener("DOMContentLoaded", function() {
               const vendasTable = document.getElementById('valor');
                const quantidadeTable = document.getElementById('quantidade');
                // Verifica se as tabelas de vendas e quantidade existem
                let totalValor = 0;// Inicializa a variável totalValor
                let totalQuantidade = 0;// Inicializa a variável totalQuantidade

                const table = document.getElementById('vendas').getElementsByTagName('tbody')[0];// Obtém o corpo da tabela de vendas

                for (let i = 0; i < table.rows.length; i++) {// Percorre cada linha da tabela

                    totalValor += parseFloat(table.rows[i].cells[2].textContent) || 0; // Soma os valores da coluna "Valor"
                    totalQuantidade += parseInt(table.rows[i].cells[3].textContent, 10) || 0; // Soma os valores da coluna "Quantidade"
                }
                const totalRow = document.createElement('tr');// Cria uma nova linha para os totais
                // Adiciona células para os totais
                totalRow.innerHTML = `  
                    <td colspan="2" style="font-weight:bold; background-color: #f5f5f5;">Totais</td> <!-- Define o estilo da célula de totais -->
                    <td style="font-weight:bold;background-color: #f5f5f5;">${totalValor.toFixed(2)}</td> <!-- Formata o total de valor com duas casas decimais -->
                    <td style="font-weight:bold;background-color: #f5f5f5;">${totalQuantidade}</td> <!-- Exibe o total de quantidade -->
                    <td></td>
                `;
                table.appendChild(totalRow);// Adiciona a linha de totais ao corpo da tabela
            });
            
        </script>
</body>
</html>
