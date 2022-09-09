<?php
    include('Protect1.php');
    include('Conexao.php');
    include('function.php');
    
    $cargo = $_SESSION['perfil'];

    $select = $mysqli->query("SELECT * FROM tbcomanda") or die($mysqli->error);

    $quantidade = $select->num_rows;


    if(isset($_POST['devolver'])){
        $codClientes = $_POST['clientes'];
        $codLivros = $_POST['livros'];
        cmd_dev($codClientes,$codLivros);
        
        echo "<script>
            alert ('Devolução efetuada com sucesso');
            window.location.href = 'meu_livro.php';
        </script>";
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/styleLivro.css">
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
        <li><a href="aluga.php" class="buttons1">Início</a></li>
        <li><a href="cad_fun.php" class="buttons1">CRUD</a></li>
        <li><a href="Sair.php" class="buttons1">Sair</a></li>
        </ul>
    </nav>
    
    <?php
        if($quantidade == 0){
    ?>
            <div id="lista">
                <h2>Não há livro alugado!!!!</h2>
            </div>
    <?php
        }else if(isset($_POST["Buscar1"])){

            $email2 = $_POST['email_b'];

            $select3 = $mysqli->query("SELECT * FROM tbcliente WHERE  email = '$email2'") or die($mysqli->error);
            $arquivo6 = $select3->fetch_assoc();
            $cod_cli = $arquivo6['cod'];

            $select2 = $mysqli->query("SELECT * FROM tbcomanda WHERE cod_clie = $cod_cli") or die($mysqli->error);
        ?>
            <div id="conteudo2">
                <?php
                    while($arquivo2 = $select2->fetch_assoc()){

                        $cod_clie = $arquivo2['cod_clie'];
                        $cod_livro = $arquivo2['cod_livro'];

                        $res = $mysqli->query("SELECT * FROM tblivro WHERE cod = $cod_livro") or die($mysqli->error);
                        $ab_busca1 = $mysqli->query("SELECT * FROM tblivro WHERE cod = $cod_livro") or die($mysqli->error);
                        $arquivo3 = $ab_busca1->fetch_assoc();
                        $genero = $arquivo3['genero'];
                        $cod_livro = $arquivo3['cod'];
                        $ac_busca1 = $mysqli->query("SELECT genero FROM tbgenero WHERE cod = $genero") or die($mysqli->error);
                        $arquivo2 = $ac_busca1->fetch_assoc();
                        $ad_busca1 = $mysqli->query("SELECT * FROM tbcomanda WHERE cod_clie = $cod_clie && cod_livro = $cod_livro") or die($mysqli->error);
                        $arquivo4 = $ad_busca1->fetch_assoc();
                        $ad_busca2 = $mysqli->query("SELECT * FROM tbcliente WHERE cod = $cod_clie") or die($mysqli->error);
                        $arquivo5 = $ad_busca2->fetch_assoc();

                        $dataDev = date("d/m/Y", strtotime($arquivo4['dt_dev']));
                        $DateAndTime = date('d/m/Y', time());
                ?>
                        
                            <div id="lista3"> 
                                <form action="" method="POST">
                                    <img src="<?php echo $arquivo3['caminho']; ?>" width="160px" class="inputs">
                                    <h3><?php echo $arquivo3['nome']; ?></h3><br>
                                    <div id="textos">
                                        <label>Autor: <?php echo $arquivo3['autor']; ?></label><br>
                                        <label>Gênero: <?php echo $arquivo2['genero']; ?></label><br>
                                        <label>Editora: <?php echo $arquivo3['editora']; ?></label><br>
                                        <label>ISBN: <?php echo $arquivo3['isbn']; ?></label><br>
                                        <label>Quantidade de Páginas: <?php echo $arquivo3['pagina']; ?></label><br>
                                        <label>Prazo de Devolução: <?php echo date("d/m/Y", strtotime($arquivo4['dt_dev'])); ?></label><br>
                                        <?php if(strtotime($DateAndTime) > strtotime($dataDev)){ ?>
                                            <label>Multa: <?php echo "R$ " . $arquivo4['multa']; ?></label><br>
                                        <?php } ?>
                                        <input type="text" placeholder="Email do Cliente" value="<?php echo $arquivo5['email']; ?>" name="cod_aluno" id="email"><br>
                                        <input type="hidden" value="<?php echo $cod_clie; ?>" name="clientes" id="cod_livro"><br>
                                        <input type="hidden" value="<?php echo $cod_livro; ?>" name="livros" id="cod_livro"><br>
                                        </div>
                                    <input type="submit" value="Devolver" name="devolver" id="devolver"/>
                                </form>
                            </div>
            <?php
                    }
            ?>
        </div>

    <?php
        }else{
    ?>
            <div class="alt1 meio">
                <form action="" autocomplete="off" method="post">
                    <label for="email_b">Email: </label>
                    <input type="text" name="email_b" required>
                    <br/><br/>
                    <input type="submit" value="Buscar" name="Buscar1" class="buttons2"><br/><br/>
                </form>
            </div>
            <div id="conteudo">
                <?php  
                while($arquivo = $select->fetch_assoc()){ 
                    $cod_clie = $arquivo['cod_clie'];
                    $cod_livro = $arquivo['cod_livro'];

                    $res = $mysqli->query("SELECT * FROM tblivro WHERE cod = $cod_livro") or die($mysqli->error);
                    $ab_busca1 = $mysqli->query("SELECT * FROM tblivro WHERE cod = $cod_livro") or die($mysqli->error);
                    $arquivo3 = $ab_busca1->fetch_assoc();
                    $genero = $arquivo3['genero'];
                    $cod_livro = $arquivo3['cod'];
                    $ac_busca1 = $mysqli->query("SELECT genero FROM tbgenero WHERE cod = $genero") or die($mysqli->error);
                    $arquivo2 = $ac_busca1->fetch_assoc();
                    $ad_busca1 = $mysqli->query("SELECT * FROM tbcomanda WHERE cod_clie = $cod_clie && cod_livro = $cod_livro") or die($mysqli->error);
                    $arquivo4 = $ad_busca1->fetch_assoc();
                    $ad_busca2 = $mysqli->query("SELECT * FROM tbcliente WHERE cod = $cod_clie") or die($mysqli->error);
                    $arquivo5 = $ad_busca2->fetch_assoc();

                    $dataDev = date("d/m/Y", strtotime($arquivo4['dt_dev']));
                    $DateAndTime = date('d/m/Y', time());
                ?>
                    <div id="lista2"> 
                        <form action="" method="POST">
                            <img src="<?php echo $arquivo3['caminho']; ?>" width="160px" class="inputs">
                            <h3><?php echo $arquivo3['nome']; ?></h3><br>
                            <div id="textos">
                                <label>Autor: <?php echo $arquivo3['autor']; ?></label><br>
                                <label>Gênero: <?php echo $arquivo2['genero']; ?></label><br>
                                <label>Editora: <?php echo $arquivo3['editora']; ?></label><br>
                                <label>ISBN: <?php echo $arquivo3['isbn']; ?></label><br>
                                <label>Quantidade de Páginas: <?php echo $arquivo3['pagina']; ?></label><br>
                                <label>Prazo de Devolução: <?php echo date("d/m/Y", strtotime($arquivo4['dt_dev'])); ?></label><br>
                                <?php if(strtotime($DateAndTime) > strtotime($dataDev)){ ?>
                                    <label>Multa: <?php echo "R$ " . $arquivo4['multa']; ?></label><br>
                                <?php } ?>
                                <input type="text" placeholder="Email do Cliente" value="<?php echo $arquivo5['email']; ?>" name="cod_aluno" id="email" readonly><br>
                                <input type="hidden" value="<?php echo $cod_clie; ?>" name="clientes" id="cod_livro"><br>
                                <input type="hidden" value="<?php echo $cod_livro; ?>" name="livros" id="cod_livro"><br>
                                </div>
                            <input type="submit" value="Devolver" name="devolver" id="devolver"/>
                        </form>
                    </div>
                <?php
                }
                ?>
            </div>
    <?php
        }
    ?>
</body>
</html>