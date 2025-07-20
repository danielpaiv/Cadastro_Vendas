

<!DOCTYPE html> <!-- Declara o tipo do documento como HTML5 -->
<html lang="en"> <!-- Início do documento HTML, idioma definido como inglês -->
<head> <!-- Cabeçalho do documento -->
    <meta charset="UTF-8"> <!-- Define a codificação de caracteres como UTF-8 -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> <!-- Responsividade para dispositivos móveis -->
    <title>Cadastro de Vendas</title> <!-- Título da página exibido na aba do navegador -->
</head>
<style> /* Início do bloco de estilos CSS */
    body {
        background-color: #191970; /* Cor de fundo da página */
        font-family: Arial, sans-serif; /* Fonte padrão da página */
    }
    h2 {
        color: #ffffff; /* Cor do texto do título */
        text-align: center; /* Centraliza o título */
    }
    header {
        display: flex; /* Usa flexbox para o layout do header */
        justify-content: space-around; /* Espaçamento igual entre os itens */
        background-color: #4CAF50; /* Cor de fundo do header */
        padding: 10px; /* Espaçamento interno do header */
    }
    header a {
        color: white; /* Cor do texto dos links */
        text-decoration: none; /* Remove sublinhado dos links */
        font-weight: bold; /* Deixa o texto em negrito */
    }
    header p {
        margin: 0; /* Remove a margem dos parágrafos no header */
    }
    button {
        background-color: #7f62c4; /* Cor de fundo do botão */
        border: none; /* Remove a borda do botão */
        padding: 10px 20px; /* Espaçamento interno do botão */
        cursor: pointer; /* Cursor de mão ao passar por cima */
        border-radius: 5px; /* Bordas arredondadas */
    }
    button:hover {
        background-color: #080be4; /* Cor de fundo ao passar o mouse */
    }
    .box {
        background-color: #f9f9f9;
        padding: 20px;
        border-radius: 5px;
        box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        margin: 20px auto;
        max-width: 400px;
    }
</style> <!-- Fim do bloco de estilos CSS -->
<body> <!-- Início do corpo da página -->
    <h2>Dados da Venda</h2> <!-- Título principal da página -->
    <header> <!-- Início do cabeçalho -->
        <button><a href="funcionario.php">Dados Pessoais</a></button> <!-- Botão com link para outra página -->
    </header> <!-- Fim do cabeçalho -->
    <div class="box">
        <form id="myForm" method="POST" action="processar_produtos.php"> <!-- Formulário para cadastro de produtos -->
            <label for="produto">Produto:</label>
            <input type="text" id="produto" name="produto" autofocus required>
            <br><br>

            <label for="valor">Valor:</label>
            <input type="number" id="valor" name="valor" step="0.01" required>
            <br><br>

            <label for="quantidade">Quantidade:</label>
            <input type="number" id="quantidade" name="quantidade" required>
            <br><br>

            <label for="data_venda">Data da Venda:</label>
            <input type="date" id="data_venda" name="data_venda" required>
            <br><br>

            <button type="submit">Enviar</button>
            <button type="button" id="clearButton">Limpar</button> <!-- Botão para limpar os dados -->
        </form>
    </div>

            <script>
                const form = document.getElementById('myForm');// Obtém o formulário pelo ID
                const clearButton = document.getElementById('clearButton');// Obtém o botão de limpar pelo ID
                // Adiciona um evento para quando o DOM estiver completamente carregado
                window.addEventListener("DOMContentLoaded",() => {// Adiciona um evento para quando o DOM estiver completamente carregado
                    form.addEventListener('submit', (event) => {
                        //event.preventDefault(); // Previne o envio do formulário
                        const produto = document.getElementById('produto').value; // Obtém o valor do campo produto
                        const valor = document.getElementById('valor').value; // Obtém o valor do campo valor
                        const quantidade = document.getElementById('quantidade').value; // Obtém o valor do campo quantidade

                        localStorage.setItem('produto', produto); // Armazena o produto no localStorage
                        localStorage.setItem('valor', valor); // Armazena o valor no localStorage
                        localStorage.setItem('quantidade', quantidade); // Armazena a quantidade no localStorage
                        localStorage.setItem('data_venda', data_venda); // Armazena a data da venda no localStorage
                        alert('Dados salvos com sucesso!'); // Exibe uma mensagem de sucesso
                        //form.reset(); // Reseta o formulário
                    });
                    clearButton.addEventListener('click', (event) => {// Adiciona um evento para o botão de limpar
                        localStorage.removeItem('produto'); // Remove o produto do localStorage
                        localStorage.removeItem('valor'); // Remove o valor do localStorage 
                        localStorage.removeItem('quantidade'); // Remove a quantidade do localStorage
                        localStorage.removeItem('data_venda'); // Remove a data da venda do localStorage
                        // Exibe uma mensagem de sucesso
                        alert('Dados removidos do localStorage.'); // Exibe uma mensagem de sucesso
                        form.reset(); // Reseta o formulário
                    });

                    // Verifica se os dados já estão armazenados no localStorage
                    if (localStorage.getItem('produto')) {
                        document.getElementById('produto').value = localStorage.getItem('produto');// Armazena o produto no localStorage
                    }
                    if (localStorage.getItem('valor')) {
                        document.getElementById('valor').value = localStorage.getItem('valor');// Armazena o valor no localStorage

                    }
                    if (localStorage.getItem('quantidade')) {
                        document.getElementById('quantidade').value = localStorage.getItem('quantidade');// Armazena a quantidade no localStorage
                    }
                    if (localStorage.getItem('data_venda')) {
                        document.getElementById('data_venda').value = localStorage.getItem('data_venda');// Armazena a data da venda no localStorage
                    }
                });
                /*form.addEventListener('submit', (event) => {// Adiciona um evento para o envio do formulário

                    localStorage.removeItem('produto'); // Remove o produto do localStorage
                    localStorage.removeItem('valor'); // Remove o valor do localStorage
                    localStorage.removeItem('quantidade'); // Remove a quantidade do localStorage
                    localStorage.removeItem('data_venda'); // Remove a data da venda do localStorage
                    // Exibe uma mensagem de sucesso
                    //alert('Dados removidos do localStorage.');
                    form.reset(); // Reseta o formulário
                    window.location.href = 'funcionario.php'; // Redireciona para a página teste2.php
                });*/
                
            </script>
</body> <!-- Fim do corpo da página -->
</html> <!-- Fim do documento HTML -->