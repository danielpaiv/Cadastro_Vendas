<?php
// Inclui o arquivo de conexão com o banco de dados
include_once 'conexao.php';

// Verifica se o formulário foi enviado via POST
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    // Captura os dados do formulário
    $nome     = $_POST['nome']     ?? '';
    $cpf      = $_POST['cpf']      ?? '';
    $telefone = $_POST['telefone'] ?? '';
    $data_vendas = $_POST['data_vendas'] ?? '';
    // Verifica se os campos estão preenchidos
    if (empty($nome) || empty($cpf) || empty($telefone)) {
        echo "Por favor, preencha todos os campos.";
        exit;
    }

    // Prepara a query de inserção
    $stmt = $conn->prepare("INSERT INTO funcionarios (nome, cpf, telefone, data_vendas) VALUES (?, ?, ?, ?)");

    if (!$stmt) {
        echo "Erro na preparação da query: " . $conn->error;
        exit;
    }

    // Usa "ssss" porque todos os campos são string
    $stmt->bind_param("ssss", $nome, $cpf, $telefone, $data_vendas);

    if ($stmt->execute()) {
        echo "Funcionário cadastrado com sucesso!";
    } else {
        // header("Location: produtos.php"); // Descomente esta linha para redirecionar
        echo "Erro ao cadastrar: " . $stmt->error;
    }
    header("Location: produtos.php"); // Redireciona para a página de produtos após o cadastro
    exit;

    $stmt->close();

} else {
    echo "Acesso inválido.";
}
?>
