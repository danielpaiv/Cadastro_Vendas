

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de usuario</title>
</head>
<style>
    body {
        background-color: #191970; /* Cor de fundo da página */
        font-family: Arial, sans-serif;
    }
    h2 {
        color: #ffffff;
        text-align: center;
    }
    head {
        color: #333;
        text-align: center;
    }
    button {
        background-color: #7f62c4;
        border: none;
        padding: 10px 20px;
        cursor: pointer;
        border-radius: 5px;
    }
    button:hover {
        background-color: #080be4;
    }
    header {
        display: flex;
        justify-content: space-around;
        background-color: #4CAF50;
        padding: 10px;
    }header a {
        color: white;
        text-decoration: none;
        font-weight: bold;
    }

    .box {
        background-color: #f9f9f9;
        padding: 20px;
        border-radius: 5px;
        box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        margin: 20px auto;
        max-width: 400px;
    }
</style>
<body>
    <h2>Formulario de cadastro</h2>
<header>
    <button><a href="produtos.php">Dados do Produto</a></button>

</header>
    

    <div class="box">
       <form id="myForm" action="processar_funcionario.php" method="POST">
            <label for="input">Nome:</label>
            <input type="text" id="input" name="nome" autofocus required>
            <br><br>

            <label for="numberInput">Cpf:</label>
            <input type="text" id="numberInput" name="cpf" maxlength="14" required>
            <br><br>

            <label for="telefone">Telefone:</label>
            <input type="tel" id="telefone" name="telefone" required>
            <br><br>

            <label for="data_vendas">Data da Venda:</label>
            <input type="date" id="data_vendas" name="data_vendas" required>
            <br><br>

            <button type="submit">Enviar</button>
            <button type="button" id="clearButton">Limpar</button>
        </form>
    </div>
            <script>
                const form = document.getElementById('myForm');// Obtém o formulário pelo ID
                const clearButton = document.getElementById('clearButton');// Obtém o botão de limpar pelo ID
                window.addEventListener("DOMContentLoaded",() => {// Adiciona um evento para quando o DOM estiver completamente carregado
                    form.addEventListener('submit', (event) => {
                        //event.preventDefault(); // Previne o envio do formulário
                        const nome = document.getElementById('input').value; // Obtém o valor do campo nome
                        const cpf = document.getElementById('numberInput').value; // Obtém o valor do campo CPF
                        const telefone = document.getElementById('telefone').value; // Obtém o valor do campo telefone

                        localStorage.setItem('nome', nome); // Armazena o nome no localStorage
                        localStorage.setItem('cpf', cpf); // Armazena o CPF no localStorage
                        localStorage.setItem('telefone', telefone); // Armazena o telefone no localStorage

                        alert('Dados salvos com sucesso!'); // Exibe uma mensagem de sucesso
                        window.location.href = 'produtos.php'; // Redireciona para a página produtos.php
                        //form.reset(); // Reseta o formulário
                    });
                    clearButton.addEventListener('click', (event) => {// Adiciona um evento para o botão de limpar
                        localStorage.removeItem('nome'); // Remove o nome do localStorage
                        localStorage.removeItem('cpf'); // Remove o CPF do localStorage 
                        localStorage.removeItem('telefone'); // Remove o telefone do localStorage
                        //alert('Dados removidos do localStorage.');
                        form.reset(); // Reseta o formulário
                    });

                    // Verifica se os dados já estão armazenados no localStorage
                    if (localStorage.getItem('nome')) {
                        document.getElementById('input').value = localStorage.getItem('nome');// Armazena o nome no localStorage
                    }
                    if (localStorage.getItem('cpf')) {
                        document.getElementById('numberInput').value = localStorage.getItem('cpf');// Armazena o CPF no localStorage    

                    }
                    if (localStorage.getItem('telefone')) {
                        document.getElementById('telefone').value = localStorage.getItem('telefone');// Armazena o telefone no localStorage
                    }
                    
                });
                /*form.addEventListener('submit', (event) => {// Adiciona um evento para o envio do formulário
                    
                    localStorage.removeItem('nome'); // Remove o nome do localStorage
                    localStorage.removeItem('cpf'); // Remove o CPF do localStorage 
                    localStorage.removeItem('telefone'); // Remove o telefone do localStorage
                    //alert('Dados removidos do localStorage.');
                    //form.reset(); // Reseta o formulário
                    window.location.href = 'produtos.php'; // Redireciona para a página produtos.php
                });*/
                
                
                 
                


            </script>
</body>
</html>