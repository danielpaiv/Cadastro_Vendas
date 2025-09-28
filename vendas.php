<?php

include_once 'conexao.php';

date_default_timezone_set('America/Sao_Paulo');

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
    #dataFiltro {
        padding: 5px;
        border: 1px solid #ccc;
        border-radius: 4px;
    }
    label {
        color: white;
        font-weight: bold;
    }
</style>
<body>
    <button><a href="produtos.php">Voltar</a></button>
    <button><a href="graficos.php">graficos</a></button>
    <button><a href="graficos_por_data.php">graficos por data</a></button>
    <button><a href="grafico_nome_data.php">graficos por nome e data</a></button>
    <br><br>

        <label for="dataFiltro">Filtrar por Data:</label><?php date_default_timezone_set('America/Sao_Paulo'); ?>
        <input type="date" id="dataFiltro" value="<?php echo date('Y-m-d'); ?>" oninput="filtrarData()">
        <br><br>
    <table id="vendas">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
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
                // Inicializa variáveis para armazenar os totais por nome
                    $totalDaniel = 0;
                    $totalAlexsandra = 0;
                    $totalTatiane = 0;
                    $totalThiago = 0;
                    $totalMaikon = 0;
                    $totalAirton = 0;
                    $totalVinicios = 0;
                    $totalAbraao = 0;
                    $totalKalaff = 0;
                    $totalErika = 0;
                    $totalHenagio = 0;
                // Loop para exibir os dados na tabela
                while ($userdata = mysqli_fetch_assoc($result)) {// Percorre os resultados da consulta
                    // Exibe cada venda em uma linha da tabela
                    echo "<tr>";
                    echo "<td>" . $userdata['id'] . "</td>";
                    echo "<td>" . $userdata['nome'] . "</td>";
                    echo "<td>" . $userdata['produto'] . "</td>";
                    echo "<td>" . $userdata['valor'] . "</td>";
                    echo "<td>" . $userdata['quantidade'] . "</td>";
                    echo "<td>" . $userdata['data_venda'] . "</td>";
                    echo "</tr>";

                    // Soma se o nome for Daniel
                        if ($userdata['nome'] == 'Daniel') {
                            $totalDaniel += $userdata['valor'];
                        }
                        // Soma se o nome for Alexsandra
                        if ($userdata['nome'] == 'Alexsandra') {
                            $totalAlexsandra += $userdata['valor'];
                        }
                        // Soma se o nome for Tatiane
                        if ($userdata['nome'] == 'Tatiane') {
                            $totalTatiane += $userdata['valor'];
                        }
                        // Soma se o nome for Thiago
                        if ($userdata['nome'] == 'Thiago') {
                            $totalThiago += $userdata['valor'];
                        }
                        // Soma se o nome for Maikon
                        if ($userdata['nome'] == 'Maikon') {
                            $totalMaikon += $userdata['valor'];
                        }
                        // Soma se o nome for Airton
                        if ($userdata['nome'] == 'Airton') {
                            $totalAirton += $userdata['valor'];
                        }
                        // Soma se o nome for Vinicios
                        if ($userdata['nome'] == 'Vinicios') {
                            $totalVinicios += $userdata['valor'];
                        }
                        // Soma se o nome for Abraao
                        if ($userdata['nome'] == 'Abraao') {    
                            $totalAbraao += $userdata['valor'];
                        }
                        // Soma se o nome for Kalaff
                        if ($userdata['nome'] == 'Kalaff') {    
                            $totalKalaff += $userdata['valor'];
                        }
                        // Soma se o nome for Erika
                        if ($userdata['nome'] == 'Erika') {    
                            $totalErika += $userdata['valor'];
                        }
                        // Soma se o nome for Hnagio
                        if ($userdata['nome'] == 'Henagio') {    
                            $totalHenagio += $userdata['valor'];
                        }
                        }
                    // Exibe nova tabela com o total
                        echo "<table border='1' style='margin-top:20px; width:50px;'>";// Tabela para Daniel
                        echo "<tr><th>Nome</th><th>Total Valor</th></tr>";
                        echo "<tr><td>Alexsandra</td><td>" . number_format($totalAlexsandra, 2, ',', '.') . "</td></tr>";
                        echo "<tr><td>Daniel</td><td>" . number_format($totalDaniel, 2, ',', '.') . "</td></tr>";
                        echo "<tr><td>Tatiane</td><td>" . number_format($totalTatiane, 2, ',', '.') . "</td></tr>";
                        echo "<tr><td>Thiago</td><td>" . number_format($totalThiago, 2, ',', '.') . "</td></tr>";
                        echo "<tr><td>Maikon</td><td>" . number_format($totalMaikon, 2, ',', '.') . "</td></tr>";
                        echo "<tr><td>Airton</td><td>" . number_format($totalAirton, 2, ',', '.') . "</td></tr>";
                        echo "<tr><td>Vinicios</td><td>" . number_format($totalVinicios, 2, ',', '.') . "</td></tr>";
                        echo "<tr><td>Abraao</td><td>" . number_format($totalAbraao, 2, ',', '.') . "</td></tr>";
                        echo "<tr><td>Kalaff</td><td>" . number_format($totalKalaff, 2, ',', '.') . "</td></tr>";
                        echo "<tr><td>Erika</td><td>" . number_format($totalErika, 2, ',', '.') . "</td></tr>";
                        echo "<tr><td>Henagio</td><td>" . number_format($totalHenagio, 2, ',', '.') . "</td></tr>";
                        echo "</table>";

                

               

            ?>
        </tbody>
    </table>

    
    <br><br>
    <h2 style="color: white;">Total de Litros Vendidos por Produto</h2>
    <table>
        <thead>
            <tr>
                <th style="background-color: #d32f2f; color: white;">GASOLINA COMUM</th>
                <th style="background-color: #1565c0; color: white;">GASOLINA DURA MAIS</th>
                <th style="background-color: #2e7d32; color: white;">ETANOL</th>
                <th style="background-color: #424242; color: white;">DIESEL S10</th>
            </tr>
        </thead>
         <tbody>
            <tr>
                <td>
                    <?php
                    // Reabrir a conexão para a nova consulta
                    include('conexao.php');

                    $sql_gasolina_comum = "SELECT SUM(quantidade) AS total_gasolina_comum FROM vendas WHERE produto = 'GASOLINA COMUM'";
                    $result_gasolina_comum = $conn->query($sql_gasolina_comum);
                    $row_gasolina_comum = $result_gasolina_comum->fetch_assoc();
                    echo $row_gasolina_comum['total_gasolina_comum'] ? $row_gasolina_comum['total_gasolina_comum'] . ' L' : '0 L';

                    // Fechar a conexão
                    $conn->close();
                    ?>
                </td>
                <td>
                    <?php
                    // Reabrir a conexão para a nova consulta
                    include('conexao.php');

                    $sql_gasolina_dura_mais = "SELECT SUM(quantidade) AS total_gasolina_dura_mais FROM vendas WHERE produto = 'GASOLINA DURA MAIS'";
                    $result_gasolina_dura_mais = $conn->query($sql_gasolina_dura_mais);
                    $row_gasolina_dura_mais = $result_gasolina_dura_mais->fetch_assoc();
                    echo $row_gasolina_dura_mais['total_gasolina_dura_mais'] ? $row_gasolina_dura_mais['total_gasolina_dura_mais'] . ' L' : '0 L';

                    // Fechar a conexão
                    $conn->close();
                    ?>
                </td>
                <td>
                    <?php
                    // Reabrir a conexão para a nova consulta
                    include('conexao.php');

                    $sql_gasolina_comum = "SELECT SUM(quantidade) AS total_etanol FROM vendas WHERE produto = 'ETANOL'";
                    $result_gasolina_comum = $conn->query($sql_gasolina_comum);
                    $row_gasolina_comum = $result_gasolina_comum->fetch_assoc();
                    echo $row_gasolina_comum['total_etanol'] ? $row_gasolina_comum['total_etanol'] . ' L' : '0 L';

                    // Fechar a conexão
                    $conn->close();
                    ?>
                </td>
                <td>
                    <?php
                    // Reabrir a conexão para a nova consulta
                    include('conexao.php');

                    $sql_gasolina_comum = "SELECT SUM(quantidade) AS total_diesel_s10 FROM vendas WHERE produto = 'DIESEL S10'";
                    $result_gasolina_comum = $conn->query($sql_gasolina_comum);
                    $row_gasolina_comum = $result_gasolina_comum->fetch_assoc();
                    echo $row_gasolina_comum['total_diesel_s10'] ? $row_gasolina_comum['total_diesel_s10'] . ' L' : '0 L';

                    // Fechar a conexão
                    $conn->close();
                    ?>
                </td>
    </table>
        <script>
             function filtrarData() {
            const input = document.getElementById('dataFiltro');
            const filter = input.value.toLowerCase();
            const table = document.getElementById('vendas');
            const tr = table.getElementsByTagName('tr');
            for (let i = 1; i < tr.length; i++) {
                const td = tr[i].getElementsByTagName('td')[5]; // coluna "Data"
                if (td) {
                    const txtValue = td.textContent || td.innerText;
                    if (txtValue.toLowerCase().indexOf(filter) > -1) {
                        tr[i].style.display = '';
                    } else {
                        tr[i].style.display = 'none';
                    }
                }
            }
        }
        </script>
</body>
</html>
