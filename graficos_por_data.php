<?php
include_once 'conexao.php'; // ajuste o caminho conforme o seu projeto

// 1️⃣ Consulta agrupando por data_venda
$sql = "SELECT data_venda, SUM(valor) AS total_valor FROM vendas GROUP BY data_venda ORDER BY data_venda ASC";
$result = $conn->query($sql);

// 2️⃣ Arrays para armazenar as datas e totais
$datas = [];
$valores = [];

// 3️⃣ Preenche os arrays
if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        // Formata a data para exibir (opcional)
        $dataFormatada = date('d/m/Y', strtotime($row['data_venda']));
        $datas[] = $dataFormatada;
        $valores[] = (float) $row['total_valor'];
    }
}

// 4️⃣ Converte para JSON
$datas_json = json_encode($datas);
$valores_json = json_encode($valores);
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Gráfico de Vendas por Data</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        body { font-family: Arial, sans-serif;
             width: 90%; 
             margin: 30px auto; 
                background-color: #0b1a5fff; 
                }
            
        form { margin-bottom: 20px; 
            display: flex; 
            gap: 10px; 
            align-items: center; }
        input, button { 
            padding: 8px; 
            font-size: 14px; }
        button {color: white; 
            cursor: pointer; 
            background: #1E90FF; 
            border: none; 
            border-radius: 4px; 
            text-decoration: none;}
        table { 
            background-color: dodgerblue;
            border-collapse: collapse; 
            margin-top: 20px; 
            width: 100%; }
        th, td { 
            border: 1px solid #ccc; 
            padding: 8px 12px; 
            text-align: left; }
        th { background: #f5f5f5; }
        a { text-decoration: none; 
            color: white; }
        button:hover { 
            background: #1C86EE; }

        h2 { color: white; 
            text-align: center;
        } 
        label { color: white; 
            font-weight: bold; }

        canvas { background: white; border: 1px solid #ccc; padding: 10px; }
    </style>
</head>
<body>

    <h2>Total de Vendas por Dia</h2>

    <button><a href="produtos.php">Voltar</a></button>
    <button><a href="graficos.php">graficos</a></button>
    <button><a href="graficos_por_data.php">graficos por data</a></button>
    <button><a href="grafico_nome_data.php">graficos por nome e data</a></button>
    <br><br>

    <!-- 5️⃣ Tabela Resumida -->
    <table>
        <tr>
            <th>Data</th>
            <th>Total (R$)</th>
        </tr>
        <?php
        for ($i = 0; $i < count($datas); $i++) {
            echo "<tr>";
            echo "<td>" . htmlspecialchars($datas[$i]) . "</td>";
            echo "<td>R$ " . number_format($valores[$i], 2, ',', '.') . "</td>";
            echo "</tr>";
        }
        ?>
    </table>

    <!-- 6️⃣ Gráfico -->
    <canvas id="graficoData"></canvas>

    <script>
        const ctx = document.getElementById('graficoData').getContext('2d');
        const grafico = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: <?php echo $datas_json; ?>,
                datasets: [{
                    label: 'Total de Vendas (R$)',
                    data: <?php echo $valores_json; ?>,
                    backgroundColor: 'rgba(75, 192, 192, 0.6)',
                    borderColor: 'teal',
                    borderWidth: 1
                }]
            },
            options: {
                plugins: {
                    legend: { display: false },
                    title: {
                        display: true,
                        text: 'Gráfico de Vendas por Data'
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        title: { display: true, text: 'Valor Total (R$)' }
                    },
                    x: {
                        title: { display: true, text: 'Data da Venda' }
                    }
                }
            }
        });
    </script>

</body>
</html>
