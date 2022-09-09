<?php
    include('Protect1.php');
    include('Conexao.php');
    include('function.php');
    
    $cargo = $_SESSION['perfil'];
    $cod_livro = $_POST['cod_livro'];

    
    $ab_busca1 = $mysqli->query("SELECT * FROM tblivro WHERE cod = $cod_livro") or die($mysqli->error);
    $arquivo = $ab_busca1->fetch_assoc();

    $genero = $arquivo['genero'];
    $cod_livro = $arquivo['cod'];
    $ac_busca1 = $mysqli->query("SELECT genero FROM tbgenero WHERE cod = $genero") or die($mysqli->error);
    $arquivo2 = $ac_busca1->fetch_assoc();
    $ad_busca1 = $mysqli->query("SELECT * FROM tbestoque WHERE cod_livro = $cod_livro") or die($mysqli->error);
    $arquivo3 = $ad_busca1->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/styleAluga2.css">
    <link rel="stylesheet" href="css/styleNav_Bar.css">
    <title>Document</title>
</head>
<body>
    <nav>
        <div class="mobile-menu">
        <div class="line1"></div>
        <div class="line2"></div>
        <div class="line3"></div>
        </div>
        <ul class="nav-list">
        <li><a href="meu_livro.php" class="buttons1">Alugado</a><br/><br/></li>
        <li><a href="aluga.php" class="buttons1">Início</a></li>
        <li><a href="cad_fun.php" class="buttons1">CRUD</a></li>
        <li><a href="Sair.php" class="buttons1">Sair</a></li>
        </ul>
    </nav>

    <form action="" autocomplete="off" method="POST">
        <div id="lista"> 
            <img src="<?php echo $arquivo['caminho']; ?>" width="300px" class="inputs">
            <h1><?php echo $arquivo['nome']; ?></h1><br>
            <div id="textos">
                <label>Autor: <?php echo $arquivo['autor']; ?></label><br>
                <label>Gênero: <?php echo $arquivo2['genero']; ?></label><br>
                <label>Editora: <?php echo $arquivo['editora']; ?></label><br>
                <label>ISBN: <?php echo $arquivo['isbn']; ?></label><br>
                <label>Quantidade de Páginas: <?php echo $arquivo['pagina']; ?></label><br>
                <label>Disponível: <?php echo $arquivo3['qtde_atual'] . "/" . $arquivo3['qtde']; ?></label><br>
                <input type="number" placeholder="Valor da multa" name="multa" id="email"><br>
                <input type="number" placeholder="Quantidade de dias para o fim do prazo" name="prazo" id="email"><br>
                <input type="text" placeholder="Email do Cliente" name="cod_aluno" id="email"><br>
                <input type="hidden" value="<?php echo $cod_livro; ?>" name="cod_livro" id="cod_livro"><br>
            </div>
            <input type="submit" value="Alugar" name="alugar" id="alugar"/>
            <?php
                if(isset($_POST['alugar'])){
                    if($_POST['cod_aluno'] == ""){
                        echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Preencha o email do cliente!!!";
                    }elseif($_POST['prazo'] == ""){
                        echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Preencha o prazo de devolução!!!";
                    }elseif($_POST['multa'] == ""){
                        echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Preencha o valor da multa!!!";
                    }else{
                        $email_clie = $_POST['cod_aluno'];
                        $res = $mysqli->query("SELECT * FROM tbcliente WHERE email = '$email_clie'") or die($mysqli->error);
                        $arquivo = $res->fetch_assoc();
                        $cod_clie = $arquivo['cod'];
                        if($arquivo['qtde_livro'] == 2){
                            echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;O cliente já possui um livro alugado, caso tenha terminado de ler ele terá que devolver para poder alugar outro.";
                        }else{
                            $codLivros = $_POST['cod_livro'];
                            $prazo = $_POST['prazo'];
                            $multa = $_POST['multa'];
                            cmd($cod_clie,$codLivros,$prazo,$multa);
        
                            echo "<script>
                                alert ('Livro alugado com sucesso');
                                window.location.href = 'aluga.php';
                            </script>";
                        }
                    }
                }
            ?>
        </div>
    </form>

            
</body>
</html>