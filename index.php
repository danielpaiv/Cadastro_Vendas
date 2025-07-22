
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login||Cadastro</title>
</head>
<style>
    body {
        background-color: #191970;
        font-family: Arial, sans-serif;
        margin: 20px;
        
    }

    h2 {
        color: #333;
    }

   .box {
       margin-top: 10%;
       text-align: center;
       display: flex;
       background-color: #fff;
       width: 300px;
       padding: 20px;
       border-radius: 5px;
       box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
   }

    label {
        display: block;
        margin-bottom: 5px;
        
    }

    input[type="text"],
    input[type="password"] {
        width: 80%;
        text-align: center;
        padding: 10px;
        margin-bottom: 10px;
        border: 1px solid #ccc;
        border-radius: 4px;
        margin-left: 50px;
    }

    input[type="submit"] {
        background-color: #4CAF50;
        color: white;
        padding: 10px 15px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
    }

    input[type="submit"]:hover {
        background-color: #45a049;
    }
    h2 {
        color: #ffffff; /* Cor do texto do título */
        text-align: center; /* Centraliza o título */
    }
    p {
        color: #ffffff; /* Cor do texto do parágrafo */
        text-align: center; /* Centraliza o parágrafo */
    }
</style>
<body>
    <H2>Login</H2>
    <p>Por favor, insira suas credenciais para acessar o sistema.</p>
    <center>
        <div class="box">
            <form action="teste_login.php" method="post">
                <label for="nome">Usuário:</label>
                <input type="text" id="nome" name="nome" required autofocus>

                <label for="senha">Senha:</label>
                <input type="password" id="senha" name="senha" required>
                <br>
                
                <input type="submit"  name="submit" value="Enviar">
            </form>
        </div>
    </center>
    
</body>
</html>