<?php
include_once 'conexao.php';
echo "<pre>";
print_r($_POST);
echo "</pre>";
// Verifica se o formulário foi enviado via POST
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $produto    = $_POST['produto']     ?? '';
    $valor      = $_POST['valor']       ?? '';
    $quantidade = $_POST['quantidade']  ?? '';
    $data_venda = $_POST['data_venda']  ?? '';

    // Verifica se os campos estão preenchidos corretamente
    if (empty($produto) || empty($valor) || empty($quantidade) || empty($data_venda)) {
        echo "Por favor, preencha todos os campos.";
        exit;
    }

    // Prepara a query
    $stmt = $conn->prepare("INSERT INTO vendas (produto, valor, quantidade, data_venda) VALUES (?, ?, ?, ?)");

    if (!$stmt) {
        echo "Erro na preparação da query: " . $conn->error;
        exit;
    }

    // Usa "sdis": string, double, int, string
    $stmt->bind_param("sdis", $produto, $valor, $quantidade, $data_venda);

    if ($stmt->execute()) {
        echo "Produto cadastrado com sucesso!";
    } else {
        echo "Erro ao cadastrar: " . $stmt->error;
    }
    header("Location: funcionario.php"); // Redireciona para a página de funcionários após o cadastro
    exit;

    $stmt->close();
} else {
    echo "Acesso inválido.";
}
?>
