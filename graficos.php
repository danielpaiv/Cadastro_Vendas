<?php
include_once 'conexao.php'; // Inclua seu arquivo de conexão

// 1️⃣ Consulta agrupada por nome
$sql = "SELECT nome, SUM(valor) AS total_valor FROM vendas GROUP BY nome";
$result = $conn->query($sql);

// 2️⃣ Cria arrays para armazenar os dados
$nomes = [];
$valores = [];

// 3️⃣ Preenche os arrays com os dados da consulta
if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $nomes[] = $row['nome'];
        $valores[] = (float) $row['total_valor'];
    }
}

// 4️⃣ Converte para JSON (para o JavaScript)
$nomes_json = json_encode($nomes);
$valores_json = json_encode($valores);
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Gráfico de Vendas por Nome</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        body {
            background-color: #0b1a5fff;
             font-family: Arial, sans-serif;
              width: 80%; 
              margin: 30px auto; }
        table { 
            background-color: dodgerblue;
            border-collapse: collapse; 
            margin-bottom: 30px; 
            width: 100%; }
        th, td { 
            border: 1px solid #0c0b0bff; 
            padding: 8px 12px; 
            text-align: left; }
        th { background: #f5f5f5;
             color: #333; 
             font-weight: bold;
             text-transform: uppercase;
             font-size: 14px; 
            }
        h2 { color: white; text-align: center; margin-bottom: 20px; }
        canvas { background: white; border: 1px solid #ccc; padding: 10px; }
        button {color: white; cursor: pointer; background: #1E90FF; border: none; border-radius: 4px; text-decoration: none;}
         a { text-decoration: none; color: white; }
        button:hover { background: #1C86EE; }   
                input, button { padding: 8px; font-size: 14px; }

    </style>
</head>
<body>

    <h2>Total de Vendas Geral</h2>
            
    <button><a href="produtos.php">Voltar</a></button>
    <button><a href="graficos.php">grafico Geral</a></button>
    <button><a href="graficos_por_data.php">graficos por data</a></button>
    <button><a href="grafico_nome_data.php">graficos por nome e data</a></button>
    <br><br>

    <!-- 5️⃣ Tabela Resumida -->
    <!--<table>
        <tr>
            <th>Nome</th>
            <th>Total (R$)</th>
        </tr>
        <?php
        for ($i = 0; $i < count($nomes); $i++) {
            echo "<tr>";
            echo "<td>" . htmlspecialchars($nomes[$i]) . "</td>";
            echo "<td>R$ " . number_format($valores[$i], 2, ',', '.') . "</td>";
            echo "</tr>";
        }
        ?>
    </table>
    -->
    <!-- 6️⃣ Gráfico -->
    <canvas id="graficoVendas"></canvas>

    <script>
        const ctx = document.getElementById('graficoVendas').getContext('2d');
        const grafico = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: <?php echo $nomes_json; ?>,
                datasets: [{
                    label: 'Total de Vendas (R$)',
                    data: <?php echo $valores_json; ?>,
                    backgroundColor: 'rgba(30, 144, 255, 0.6)',
                    borderColor: 'dodgerblue',
                    borderWidth: 1
                }]
            },
            options: {
                plugins: {
                    legend: { display: false },
                    title: {
                        display: true,
                        text: 'Gráfico de Vendas por Nome'
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        title: { display: true, text: 'Valor Total (R$)' }
                    },
                    x: {
                        title: { display: true, text: 'Nomes' }
                    }
                }
            }
        });
    </script>

</body>
</html>
