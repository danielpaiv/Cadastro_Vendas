<?php
include_once 'conexao.php';

// Recebe os filtros de data (se existirem)
$data_inicio = isset($_GET['data_inicio']) ? $_GET['data_inicio'] : '';
$data_fim = isset($_GET['data_fim']) ? $_GET['data_fim'] : '';

// Monta a consulta com filtro opcional
$sql = "SELECT data_venda, nome, SUM(valor) AS total_valor
        FROM vendas";

$condicoes = [];

if (!empty($data_inicio) && !empty($data_fim)) {
    $condicoes[] = "data_venda BETWEEN '$data_inicio' AND '$data_fim'";
} elseif (!empty($data_inicio)) {
    $condicoes[] = "data_venda >= '$data_inicio'";
} elseif (!empty($data_fim)) {
    $condicoes[] = "data_venda <= '$data_fim'";
}

if (count($condicoes) > 0) {
    $sql .= " WHERE " . implode(" AND ", $condicoes);
}

$sql .= " GROUP BY data_venda, nome ORDER BY data_venda ASC";

$result = $conn->query($sql);

// Organizar os dados
$dados = [];
$nomes = [];
$datas = [];

if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $data = date('d/m/Y', strtotime($row['data_venda']));
        $nome = $row['nome'];
        $valor = (float) $row['total_valor'];

        $dados[$nome][$data] = $valor;

        if (!in_array($nome, $nomes)) $nomes[] = $nome;
        if (!in_array($data, $datas)) $datas[] = $data;
    }
}

// Ordenar as datas
sort($datas);

// Montar datasets para o gráfico
$datasets = [];
$colors = ['#1E90FF', '#32CD32', '#FF6347', '#FFD700', '#8A2BE2', '#FF69B4'];

foreach ($nomes as $i => $nome) {
    $valores = [];
    foreach ($datas as $data) {
        $valores[] = isset($dados[$nome][$data]) ? $dados[$nome][$data] : 0;
    }
    $datasets[] = [
        "label" => $nome,
        "data" => $valores,
        "backgroundColor" => $colors[$i % count($colors)]
    ];
}

// Converter para JSON
$datas_json = json_encode($datas);
$datasets_json = json_encode($datasets);
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Gráfico por Nome e Data com Filtro</title>
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

    <h2>Total de Vendas por Data</h2>

    <button><a href="produtos.php">Voltar</a></button>
    <button><a href="graficos.php">grafico Geral</a></button>
    <button><a href="graficos_por_data.php">graficos por data</a></button>
    <button><a href="grafico_nome_data.php">graficos por nome e data</a></button>
    <br><br>

    <!-- 🔍 Filtro -->
    <form method="GET" action="">
        <label>Data Início 🔍:</label>
        <input type="date" name="data_inicio" value="<?php echo $data_inicio; ?>">
        <label>Data Fim 🔍:</label>
        <input type="date" name="data_fim" value="<?php echo $data_fim; ?>">
        <button type="submit">Filtrar</button>
        <a href="grafico_nome_data.php" style="color:#1E90FF; text-decoration:none;">Limpar</a>
    </form>

    <?php if (count($datas) == 0): ?>
        <p><strong>Nenhum resultado encontrado para o período selecionado.</strong></p>
    <?php else: ?>

    <!-- 📋 Tabela -->
    <table>
        <tr>
            <th>Data</th>
            <th>Nome</th>
            <th>Total (R$)</th>
        </tr>
        <?php
        foreach ($datas as $data) {
            foreach ($nomes as $nome) {
                if (isset($dados[$nome][$data])) {
                    echo "<tr>";
                    echo "<td>{$data}</td>";
                    echo "<td>{$nome}</td>";
                    echo "<td>R$ " . number_format($dados[$nome][$data], 2, ',', '.') . "</td>";
                    echo "</tr>";
                }
            }
        }
        ?>
    </table>

    <!-- 📊 Gráfico -->
    <canvas id="graficoNomeData"></canvas>

    <script>
        const ctx = document.getElementById('graficoNomeData').getContext('2d');
        const grafico = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: <?php echo $datas_json; ?>,
                datasets: <?php echo $datasets_json; ?>
            },
            options: {
                responsive: true,
                plugins: {
                    title: {
                        display: true,
                        text: 'Total de Vendas por Nome e Data'
                    },
                    legend: { position: 'top' }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        title: { display: true, text: 'Valor Total (R$)' }
                    },
                    x: {
                        title: { display: true, text: 'Datas' }
                    }
                }
            }
        });
    </script>
    <?php endif; ?>

</body>
</html>
