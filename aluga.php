<?php
    include('Protect1.php');
    include('Conexao.php');
    include('function.php');
    
    $cargo = $_SESSION['perfil'];
    $cod_clie = $_SESSION['id'];

    if(isset($_POST['alugar'])){
        $res = $mysqli->query("SELECT * FROM tbcliente WHERE cod = $cod_clie") or die($mysqli->error);
        $arquivo = $res->fetch_assoc();

        if($arquivo['qtde_livro'] == 1){
            echo "Já possui um livro alugado, caso tenha terminado de ler devolva para poder alugar outro.";
        }else{
            $codLivros = $_POST['cod_livro'];
            cmd($cod_clie,$codLivros);
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/styleAluga.css">
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
        <li><a href="meu_livro.php" class="buttons1">Alugado</a></li>
        <li><a href="cad_fun.php" class="buttons1">CRUD</a></li>
        <li><a href="Sair.php" class="buttons1">Sair</a></li>
        </ul>
    </nav>

    <?php
        $ab_busca1 = $mysqli->query("SELECT * FROM tblivro") or die($mysqli->error);
    ?>
    <div class="alt1 meio">
        <form action="" autocomplete="off" method="post">
            <label for="livro">Livro: </label>
            <input type="text" name="livro" required>
            <br/><br/>
            <input type="submit" value="Buscar" name="Buscar1" class="buttons2"><br/><br/>
        </form>
    </div>

    <?php
        if(isset($_POST['Buscar1'])){
    ?>   
            <div id="lista2">
                <?php
                    $livro = $_POST['livro'];
                    $ab_busca2 = $mysqli->query("SELECT * FROM tblivro WHERE nome = '$livro'") or die($mysqli->error);

                    $arquivo = $ab_busca2->fetch_assoc();
                    $genero = $arquivo['genero'];
                    $cod_livro = $arquivo['cod'];
                    $ac_busca1 = $mysqli->query("SELECT genero FROM tbgenero WHERE cod = $genero") or die($mysqli->error);
                    $arquivo2 = $ac_busca1->fetch_assoc();
                    $ad_busca1 = $mysqli->query("SELECT * FROM tbestoque WHERE cod_livro = $cod_livro") or die($mysqli->error);
                    $arquivo3 = $ad_busca1->fetch_assoc();

                ?>
                    <form action="aluga2.php" method="post"  class="banner">
                        <img src="<?php echo $arquivo['caminho']; ?>" width="220px" height="300px"><br>
                        <label><?php echo $arquivo['nome']; ?></label><br>
                        <label><?php echo $arquivo2['genero']; ?></label>&nbsp;&nbsp;&nbsp;&nbsp;
                        <label><?php echo $arquivo3['qtde_atual'] . "/" . $arquivo3['qtde']; ?></label>
                        <input type="hidden" value="<?php echo $cod_livro; ?>" name="cod_livro"><br>
                        <input type="submit" id="enviar" value="Pegar" />
                    </form>
            </div>
    <?php
        }else{
    ?>  
            <div id="lista">
                <?php
                    while($arquivo = $ab_busca1->fetch_assoc()){ 
                        $genero = $arquivo['genero'];
                        $cod_livro = $arquivo['cod'];
                        $ac_busca1 = $mysqli->query("SELECT genero FROM tbgenero WHERE cod = $genero") or die($mysqli->error);
                        $arquivo2 = $ac_busca1->fetch_assoc();
                        $ad_busca1 = $mysqli->query("SELECT * FROM tbestoque WHERE cod_livro = $cod_livro") or die($mysqli->error);
                        $arquivo3 = $ad_busca1->fetch_assoc();

                ?>
                        <form action="aluga2.php" method="post"  class="banner">
                            <img src="<?php echo $arquivo['caminho']; ?>" width="220px" height="300px"><br>
                            <label><?php echo $arquivo['nome']; ?></label><br>
                            <label><?php echo $arquivo2['genero']; ?></label>&nbsp;&nbsp;&nbsp;&nbsp;
                            <label><?php echo $arquivo3['qtde_atual'] . "/" . $arquivo3['qtde']; ?></label>
                            <input type="hidden" value="<?php echo $cod_livro; ?>" name="cod_livro"><br>
                            <input type="submit" id="enviar" value="Pegar" />
                        </form>
                <?php
                    } 
                ?>
            </div>
    <?php
        } 
    ?>   
    <script src="js/script2.js"></script>

            
</body>
</html>