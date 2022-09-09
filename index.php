<?php
include('Conexao.php');

if(isset($_POST['email']) || isset($_POST['senha'])) {

    if(strlen($_POST['email']) == 0) {
        echo "Preencha seu e-mail";
    } else if(strlen($_POST['senha']) == 0) {
        echo "Preencha sua senha";
    } else {

        $email = $mysqli->real_escape_string($_POST['email']);
        $senha = $mysqli->real_escape_string($_POST['senha']);

        $sql_code2 = "SELECT * FROM Funcao";
        $sql_code = "SELECT * FROM tbfuncionario WHERE email = '$email' AND senha = '$senha'";
        $sql_query = $mysqli->query($sql_code) or die("Falha na execução do código SQL: " . $mysqli->error);

        $quantidade = $sql_query->num_rows;

        

        if($quantidade == 1) {
            
            $usuario = $sql_query->fetch_assoc();

            if(!isset($_SESSION)) {
                session_start();
            }

            $_SESSION['id'] = $usuario['cod'];
            $_SESSION['nome'] = $usuario['nome'];
            $_SESSION['perfil'] = $usuario['perfil'];


            header("Location: cad_fun.php");

        }else {
            echo "Falha ao logar! E-mail ou senha incorretos";
        }

    }

}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/styleIndex.css">
    <title>Document</title>
</head>
<body>
    <div id="login">
        <form action="" autocomplete="off" method="POST">
            <label for="email">Email: </label>
            <input type="input" placeholder="Email" required name='email' class="email inputs"><br><br>
            <label for="senha">Senha: </label>
            <input type="password" placeholder="Senha" required name='senha' class="senha inputs"><br><br><br>
            <input type="submit" value="Login" id="logar">
        </form>
    </div>
</body>
</html>