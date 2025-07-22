    <?php
        session_start();
        include_once('conexao.php');
        
         if (!isset($_SESSION['nome']) || !isset($_SESSION['senha'])) {
        unset($_SESSION['nome']);
        unset($_SESSION['senha']);
        header('Location: index.php');
        exit();  // Importante adicionar o exit() após o redirecionamento
    }
         // Consultar os produtos no estoque
        $sql_usuario = "SELECT id, nome, cpf, telefone FROM usuarios";
        $result_usuarios = $conn->query($sql_usuario);

         
    ?>
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
        text-decoration: none; /* Remove sublinhado dos links */
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
        text-align: center; /* Centraliza o conteúdo dentro da caixa */
        
    }
    #input, #numberInput, #telefone, #data_vendas {
        width: 50%;/* Define a largura do campo de entrada*/
        padding: 5px;/* Campo de entrada para o nome*/
        margin: 5px 0;/* Margem entre os campos*/
        border: 1px solid #ccc;/* Borda do campo de entrada*/
        border-radius: 4px;/* Estilo do campo arredondada */
        text-align: center;/* Alinha o texto ao centro*/    
    }
    button[type="submit"], button[type="button"] {
        margin-top: 10px; /* Espaçamento acima dos botões */
    }
    a {
        color: #000000ff; /* Cor do link */
        text-decoration: none; /* Remove o sublinhado do link */
    }
</style>
<body>
    <h2>Formulario de cadastro</h2>
<header>
    
    <button><a href="vendas.php">Dados da Venda</a></button>
    <button><a href="index.php">login</a></button>
    <button><a href="sair.php">Sair</a></button>

</header>
    

    <div class="box">
       <form id="myForm" action="processar_funcionario.php" method="POST">
            <select name="nome" id="input">
                <option value="">Selecione o nome</option>
                <?php
                
                // Verifica se a consulta retornou resultados
                 if ($result_usuarios->num_rows > 0) {
                        while($row = $result_usuarios->fetch_assoc()) {// Itera sobre os resultados
                            
                            echo "<option value='" . $row['nome'] . "' data-cpf='" . $row['cpf'] . "' data-telefone='" . $row['telefone'] . "'>" . $row['nome'] . "</option>";

                        }
                        }
                     else {
                        echo "<option value=''>Nenhum funcionário encontrado</option>";
                    }
                ?>

            </select>
            
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
            <button><a href="produtos.php">Dados do Produto</a></button autofocus>
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
                        const data_vendas = document.getElementById('data_vendas').value; // Obtém o valor do campo data_vendas

                        // Armazena os valores no localStorage
                        localStorage.setItem('nome', nome); // Armazena o nome no localStorage
                        localStorage.setItem('cpf', cpf); // Armazena o CPF no localStorage
                        localStorage.setItem('telefone', telefone); // Armazena o telefone no localStorage
                        localStorage.setItem('data_vendas', data_vendas); // Armazena a data_vendas no localStorage

                        alert('Dados salvos com sucesso!'); // Exibe uma mensagem de sucesso
                        window.location.href = 'produtos.php'; // Redireciona para a página produtos.php
                        //form.reset(); // Reseta o formulário
                    });
                    clearButton.addEventListener('click', (event) => {// Adiciona um evento para o botão de limpar
                        localStorage.removeItem('nome'); // Remove o nome do localStorage
                        localStorage.removeItem('cpf'); // Remove o CPF do localStorage 
                        localStorage.removeItem('telefone'); // Remove o telefone do localStorage
                        //localStorage.removeItem('data_vendas'); // Remove a data_vendas do localStorage
                        //alert('Dados removidos do localStorage.');
                        form.reset(); // Reseta o formulário
                        document.getElementById('input').focus(); // Foca no campo de nome
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
                    if (localStorage.getItem('data_vendas')) {
                        document.getElementById('data_vendas').value = localStorage.getItem('data_vendas');// Armazena a data_vendas no localStorage
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
            <script>
                document.getElementById("input").addEventListener("change", function() {// Adiciona um evento de mudança ao campo de seleção
                    var selectedOption = this.options[this.selectedIndex];// Obtém a opção selecionada

                    var cpf = selectedOption.getAttribute("data-cpf");// Obtém o atributo data-cpf da opção selecionada
                    var telefone = selectedOption.getAttribute("data-telefone");// Obtém o atributo data-telefone da opção selecionada

                    document.getElementById("numberInput").value = cpf || "";// Define o valor do campo CPF com o valor do atributo data-cpf ou vazio se não houver
                    document.getElementById("telefone").value = telefone || "";// Define o valor do campo telefone com o valor do atributo data-telefone ou vazio se não houver
            });
            </script>

</body>
</html>