<?php
include "Protect1.php";
include "Conexao.php";
include "function.php";

$cargo = $_SESSION["perfil"];
// ------------------------------!!!!!CADASTRANDO AS INFORMAÇÕES NO BANCO!!!!!-------------------------- //

// ------------------------------!!!!!CADASTRANDO FUNCIONÁRIO!!!!!--------------------------//
if (isset($_POST["cadastrar1"])) {
    $nome = $_POST["nome"];
    $tel = $_POST["tel"];
    $email = $_POST["email"];
    $periodo = $_POST["periodo"];
    $senha = $_POST["senha"];
    $funcao = $_POST["funcao"];

    cad_Fun($nome, $tel, $email, $periodo, $senha, $funcao);
    
    echo "<script>
        alert ('Cadastro efetuado com sucesso');
        window.location.href = 'cad_fun.php';
    </script>";
} elseif (isset($_POST["cadastrar2"])) {
    // ------------------------------!!!!!CADASTRANDO CLIENTE/ALUNO!!!!!--------------------------//
    $nome = $_POST["nome"];
    $tel = $_POST["number"];
    $email = $_POST["email"];
    $senha = $_POST["senha"];
    $end = $_POST["end"];

    cad_Clie($nome, $tel, $email, $senha, $end);

    echo "<script>
        alert ('Cadastro efetuado com sucesso');
        window.location.href = 'cad_fun.php';
    </script>";

} elseif (isset($_POST["cadastrar3"])) {
    // ------------------------------!!!!!CADASTRANDO LIVRO!!!!!--------------------------//
    if (isset($_FILES["arquivo"])) {
        $arquivo = $_FILES["arquivo"];

        if ($arquivo["error"]) {
            die("Falha ao enviar arquirvo");
        }

        if ($arquivo["size"] > 2097152) {
            die("Arquivo muito grande!!! Max: 2MB");
        }

        $pasta = "Fotos_Livros/";
        $nomeDoArquivo = $arquivo["name"];
        $novoNomeDoArquivo = uniqid();
        $extensao = strtolower(pathinfo($nomeDoArquivo, PATHINFO_EXTENSION));

        if ($extensao != "jpg" && $extensao != "png") {
            die("Tipo de arquivo não aceito");
        }

        $path = $pasta . $novoNomeDoArquivo . "." . $extensao;

        $deu_certo = move_uploaded_file($arquivo["tmp_name"], $path);
        if ($deu_certo) {
            $nome = $_POST["nome"];
            $autor = $_POST["autor"];
            $genero = $_POST["genero"];
            $editora = $_POST["editora"];
            $isbn = $_POST["isbn"];
            $pag = $_POST["pag"];

            cadLivro($nome, $autor, $genero, $editora, $isbn, $pag, $path);
    
            echo "<script>
                alert ('Cadastro efetuado com sucesso');
                window.location.href = 'cad_fun.php';
            </script>";
        } else {
            echo "<p>Falha ao enviar arquivo</p>";
        }
    }
} elseif (isset($_POST["cadastrar4"])) {
    // ------------------------------!!!!!CADASTRANDO ESTOQUE!!!!!--------------------------//
    $cod = $_POST["cod"];
    $qtde = $_POST["qtde"];

    cad_QTDE($qtde, $qtde, $cod);
    
    echo "<script>
        alert ('Cadastro efetuado com sucesso');
        window.location.href = 'cad_fun.php';
    </script>";
} else {
}
// ------------------------------!!!!!O CADASTRO DAS INFORMAÇÕES NO BANCO ACABAM AQUI!!!!!-------------------------- //

// ------------------------------!!!!!ALTERANDO AS INFORMAÇÕES NO BANCO!!!!!-------------------------- //

// ------------------------------!!!!!ALTERANDO FUNCIONÁRIO!!!!!--------------------------//
if (isset($_POST["alterar1"])) {
    $cod = $_POST["cod"];
    $nome = $_POST["nome"];
    $tel = $_POST["tel"];
    $email = $_POST["email"];
    $periodo = $_POST["periodo"];
    $senha = $_POST["senha"];
    $funcao = $_POST["funcao"];

    alter_Fun($cod, $nome, $tel, $email, $periodo, $senha, $funcao);
    
    echo "<script>
        alert ('Alteração efetuada com sucesso');
        window.location.href = 'cad_fun.php';
    </script>";
} elseif (isset($_POST["alterar2"])) {
    // ------------------------------!!!!!ALTERANDO CLIENTE/ALUNO!!!!!----------------------------//
    $cod = $_POST["cod"];
    $nome = $_POST["nome"];
    $tel = $_POST["number"];
    $email = $_POST["email"];
    $senha = $_POST["senha"];
    $end = $_POST["end"];

    alter_Clie($cod, $nome, $tel, $email, $senha, $end);
    
    echo "<script>
        alert ('Alteração efetuada com sucesso');
        window.location.href = 'cad_fun.php';
    </script>";
} elseif (isset($_POST["alterarft3"])) {
    // ------------------------------!!!!!ALTERANDO A FOTO DO LIVRO!!!!!----------------------------//
    if (isset($_FILES["arquivo"])) {
        $arquivo = $_FILES["arquivo"];

        if ($arquivo["error"]) {
            die("Falha ao enviar arquirvo");
        }

        if ($arquivo["size"] > 2097152) {
            die("Arquivo muito grande!!! Max: 2MB");
        }

        $pasta = "Fotos_Livros/";
        $nomeDoArquivo = $arquivo["name"];
        $novoNomeDoArquivo = uniqid();
        $extensao = strtolower(pathinfo($nomeDoArquivo, PATHINFO_EXTENSION));

        if ($extensao != "jpg" && $extensao != "png") {
            die("Tipo de arquivo não aceito");
        }

        $path = $pasta . $novoNomeDoArquivo . "." . $extensao;

        $deu_certo = move_uploaded_file($arquivo["tmp_name"], $path);
        if ($deu_certo) {
            $cod = $_POST["cod"];

            alter_Livroft($cod, $path);
    
            echo "<script>
                alert ('Alteração efetuada com sucesso');
                window.location.href = 'cad_fun.php';
            </script>";
        } else {
            echo "<p>Falha ao enviar arquivo</p>";
        }
    }
} elseif (isset($_POST["alterarcp3"])) {
    // ------------------------------!!!!!ALTERANDO OS CAMPOS DE TEXTO DO LIVRO!!!!!----------------------------//
    $cod = $_POST["cod"];
    $nome = $_POST["nome"];
    $autor = $_POST["autor"];
    $genero = $_POST["genero"];
    $editora = $_POST["editora"];
    $isbn = $_POST["isbn"];
    $pag = $_POST["pag"];

    alter_Livrocp($cod, $nome, $autor, $genero, $editora, $isbn, $pag);
    
    echo "<script>
        alert ('Alteração efetuada com sucesso');
        window.location.href = 'cad_fun.php';
    </script>";
} elseif (isset($_POST["alterar4"])) {
    // ------------------------------!!!!!ALTERANDO ESTOQUE!!!!!----------------------------//
    $cod = $_POST["cod"];
    $cod_livro = $_POST["cod_livro"];
    $qtde = $_POST["qtde"];
    $qtde_atual = $_POST["qtde_atual"];

    alter_QTDE($cod, $cod_livro, $qtde, $qtde_atual);
    
    echo "<script>
        alert ('Alteração efetuada com sucesso');
        window.location.href = 'cad_fun.php';
    </script>";
} else {
}
// ------------------------------!!!!!A ALTERAÇÃO DAS INFORMAÇÕES NO BANCO ACABAM AQUI!!!!!-------------------------- //

// ------------------------------!!!!!EXCLUIR AS INFORMAÇÕES NO BANCO!!!!!-------------------------- //

// ------------------------------!!!!!EXCLUIR FUNCIONÁRIO!!!!!--------------------------//
if (isset($_POST["excluir1"])) {
    $cod = $_POST["cod"];

    exc_Fun($cod);
    
    echo "<script>
        alert ('Exclusão efetuada com sucesso');
        window.location.href = 'cad_fun.php';
    </script>";
} elseif (isset($_POST["excluir2"])) {
    // ------------------------------!!!!!EXCLUIR CLIENTE/ALUNO!!!!!----------------------------//
    $cod = $_POST["cod"];

    exc_Clie($cod);
    
    echo "<script>
        alert ('Exclusão efetuada com sucesso');
        window.location.href = 'cad_fun.php';
    </script>";
} elseif (isset($_POST["excluir3"])) {
    // ------------------------------!!!!!EXCLUIR LIVRO!!!!!----------------------------//
    $cod = $_POST["cod"];

    exc_Livro($cod);
    
    echo "<script>
        alert ('Exclusão efetuada com sucesso');
        window.location.href = 'cad_fun.php';
    </script>";
} elseif (isset($_POST["excluir4"])) {
    // ------------------------------!!!!!EXCLUIR ESTOQUE!!!!!----------------------------//
    $cod = $_POST["cod"];

    exc_QTDE($cod);
    
    echo "<script>
        alert ('Exclusão efetuada com sucesso');
        window.location.href = 'cad_fun.php';
    </script>";
} else {
}
// ------------------------------!!!!!EXCLUIR AS INFORMAÇÕES NO BANCO ACABAM AQUI!!!!!-------------------------- //

($sql_query = $mysqli->query("SELECT * FROM tblivro")) or die($mysqli->error);
($sql_query2 = $mysqli->query("SELECT * FROM tbestoque")) or
    die($mysqli->error);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/styleImageCad_Fun.css">
    <link rel="stylesheet" href="css/styleCad_fun.css">
    <link rel="stylesheet" href="css/styleNav_Bar.css">
    <title>Document</title>
</head>
<body>
    <?php if ($cargo == 1) { ?>      
        <!-- -------------------------------------------!!!!O QUE O MASTER PODE CADASTRAR!!!!----------------------------------- -->
            <form action="" method="POST">
                <nav>
                    <div class="mobile-menu">
                    <div class="line1"></div>
                    <div class="line2"></div>
                    <div class="line3"></div>
                    </div>
                    <ul class="nav-list">
                    <li><input type="submit" value="Funcionário" name="fun" class="buttons1"></li>
                    <li><input type="submit" value="Cliente" name="clie" class="buttons1"></li>
                    <li><input type="submit" value="Livro" name="livro" class="buttons1"></li>
                    <li><input type="submit" value="Estoque" name="estoque" class="buttons1"></li>
                    <li><a href="aluga.php" class="buttons1">Alugar</a></li>
                    <li><a href="Sair.php" class="buttons1">Sair</a></li>
                    </ul>
                </nav>
                <script src="js/script3.js"></script>
            </form>
    <?php } else { ?>
        <!-- -------------------------------------------!!!!O QUE O FUNCIONÁRIO COMUM PODE CADASTRAR!!!!----------------------------------- -->
            <form action="" method="POST">
                <nav>
                    <div class="mobile-menu">
                    <div class="line1"></div>
                    <div class="line2"></div>
                    <div class="line3"></div>
                    </div>
                    <ul class="nav-list">
                    <li><input type="submit" value="Cliente" name="clie" class="buttons1"></li>
                    <li><input type="submit" value="Livro" name="livro" class="buttons1"></li>
                    <li><input type="submit" value="Estoque" name="estoque" class="buttons1"></li>
                    <li><a href="aluga.php" class="buttons1">Alugar</a></li>
                    <li><a href="Sair.php" class="buttons1">Sair</a></li>
                    </ul>
                </nav>
                <script src="js/script3.js"></script>
            </form>
    <?php } ?>

    <div id="conteudo">
        <?php if (isset($_POST["fun"])) { ?>
            <!-- -------------------------------------------!!!!FUNÇÕES QUE O MASTER PODE REALIZAR!!!!----------------------------------- -->
                <br/>
                <h1 class="crudF meio">CRUD FUNCIONÁRIO</h1>
                <br/>
                <div class="funcoes1 funcoes">
                    <form action="" method="POST">
                        <input type="submit" value="Cadastrar" name="cdt1" class="buttons2">
                        <input type="submit" value="Alterar" name="alter1" class="buttons2">
                        <input type="submit" value="Excluir" name="exc1" class="buttons2">
                        <input type="submit" value="Visualizar" name="vis1" class="buttons2">
                    </form>
                </div>
                <br/><br/>
        <?php } elseif (isset($_POST["clie"])) { ?>
                <br/>
                <h1 class="crudC meio">CRUD CLIENTE</h1>
                <br/>
                <?php if ($cargo == 1) { ?>      
                        <div class="funcoes1 funcoes">
                    <!-- -------------------------------------------!!!!FUNÇÕES QUE O MASTER PODE REALIZAR!!!!----------------------------------- -->
                            <form action="" method="POST">
                                <input type="submit" value="Cadastrar" name="cdt2" class="buttons2">
                                <input type="submit" value="Alterar" name="alter2" class="buttons2">
                                <input type="submit" value="Excluir" name="exc2" class="buttons2">
                                <input type="submit" value="Visualizar" name="vis2" class="buttons2">
                            </form>
                        </div>
                <?php } else { ?>
                        <div class="funcoes2 funcoes">
                    <!-- -------------------------------------------!!!!FUNÇÕES QUE O FUNCIONÁRIO COMUM PODE REALIZAR!!!!----------------------------------- -->
                            <form action="" method="POST">
                                <input type="submit" value="Cadastrar" name="cdt2" class="buttons2">
                                <input type="submit" value="Alterar" name="alter2" class="buttons2">
                                <input type="submit" value="Visualizar" name="vis2" class="buttons2">
                            </form>
                        </div>
                <?php } ?>
                <br/><br/>
        <?php } elseif (isset($_POST["livro"])) { ?>
                <br/>
                <h1 class="crudL meio">CRUD LIVRO</h1>
                <br/>
                <?php if ($cargo == 1) { ?>
                        <div class="funcoes1 funcoes">
                    <!-- -------------------------------------------!!!!FUNÇÕES QUE O MASTER PODE REALIZAR!!!!----------------------------------- -->
                            <form action="" method="POST">
                                <input type="submit" value="Cadastrar" name="cdt3" class="buttons2">
                                <input type="submit" value="Alterar" name="alter3" class="buttons2">
                                <input type="submit" value="Excluir" name="exc3" class="buttons2">
                                <input type="submit" value="Visualizar" name="vis3" class="buttons2">
                            </form>
                        </div>
                <?php } else { ?>
                        <div class="funcoes2 funcoes">
                    <!-- -------------------------------------------!!!!FUNÇÕES QUE O FUNCIONÁRIO COMUM PODE REALIZAR!!!!----------------------------------- -->
                            <form action="" method="POST">
                                <input type="submit" value="Cadastrar" name="cdt3" class="buttons2">
                                <input type="submit" value="Alterar" name="alter3" class="buttons2">
                                <input type="submit" value="Visualizar" name="vis3" class="buttons2">
                            </form>
                        </div>
                <?php } ?>
                <br/><br/>
        <?php } elseif (isset($_POST["estoque"])) { ?>      
                <br/>
                <h1 class="crudE meio">CRUD ESTOQUE</h1>
                <br/>
                <?php if ($cargo == 1) { ?>      
                        <div class="funcoes1 funcoes">
                    <!-- -------------------------------------------!!!!FUNÇÕES QUE O MASTER PODE REALIZAR!!!!----------------------------------- -->
                            <form action="" method="POST">
                                <input type="submit" value="Cadastrar" name="cdt4" class="buttons2">
                                <input type="submit" value="Alterar" name="alter4" class="buttons2">
                                <input type="submit" value="Excluir" name="exc4" class="buttons2">
                                <input type="submit" value="Visualizar" name="vis4" class="buttons2">
                            </form>
                        </div>
                <?php } else { ?>
                        <div class="funcoes2 funcoes">
                    <!-- -------------------------------------------!!!!FUNÇÕES QUE O FUNCIONÁRIO COMUM PODE REALIZAR!!!!----------------------------------- -->
                            <form action="" method="POST">
                                <input type="submit" value="Cadastrar" name="cdt4" class="buttons2">
                                <input type="submit" value="Alterar" name="alter4" class="buttons2">
                                <input type="submit" value="Visualizar" name="vis4" class="buttons2">
                            </form>
                        </div>
                <?php } ?>
                <br/><br/>
        <?php } else {} ?>
        <!-- -------------------------------------------!!!!^~TODOS OS CADASTROS!!!!----------------------------------- -->
        <?php if (isset($_POST["cdt1"])) { ?>
                <div class="cdt1 meio">
            <!-- -------------------------------------------!!!!CADASTRO DO FUNCIONÁRIO!!!!----------------------------------- -->
                    <br/><br/>
                    <form action="" autocomplete="off" method="post">
                        <label for="nome">Nome: </label>
                        <input type="text" name="nome" required> &nbsp;&nbsp;&nbsp;
                        <label for="tel">Telefone: </label>
                        <input type="tel" name="tel" maxlength="11" required><br/><br/>
                        <label for="email">Email: </label>
                        <input type="text" name="email" required>&nbsp;&nbsp;&nbsp;&nbsp;
                        <label for="periodo">Período: </label>
                        <select name="periodo" required>
                            <option value=""></option>
                            <option value="M">Manhã</option>
                            <option value="T">Tarde</option>
                            <option value="N">Noite</option>
                        </select><br/><br/>
                        <label for="senha">Senha: </label>
                        <input type="text" name='senha' required>&nbsp;&nbsp;&nbsp;&nbsp;
                        <label for="funcao">Função: </label>
                        <select name="funcao" required>
                            <option value=""></option>
                            <option value="1">Master</option>
                            <option value="2">Funcionário</option>
                        </select><br/>
                        <br/><br/>
                        <input type="submit" value="Cadastrar" name="cadastrar1" class="buttons2"><br/><br/>
                    </form>
                </div>
        <?php } elseif (isset($_POST["cdt2"])) { ?>
                <div class="cdt1 meio">
            <!-- -------------------------------------------!!!!CADASTRO DO CLIENTE/ALUNO!!!!----------------------------------- -->
                    <br/><br/>
                    <form action="" autocomplete="off" method="post">
                        <label for="nome">Nome: </label>
                        <input type="text" name="nome" required> &nbsp;&nbsp;&nbsp;&nbsp;
                        <label for="number">Telefone: </label>
                        <input type="tel" name="number" maxlength="11" required><br/><br/>
                        <label for="email">Email: </label>
                        <input type="text" name="email" required>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <label for="end">Endereço: </label>
                        <input type="text" name='end' required><br/><br/>
                        <label for="senha">Senha: </label>
                        <input type="text" name='senha' required>
                        <br/><br/>
                        <input type="submit" value="Cadastrar" name="cadastrar2" class="buttons2"><br/><br/>
                    </form>
                </div>
        <?php } elseif (isset($_POST["cdt3"])) { ?>
                <div class="cdt1 meio">
            <!-- -------------------------------------------!!!!CADASTRO DO LIVRO!!!!----------------------------------- -->
                    <br/><br/>
                    <form action="" autocomplete="off" enctype="multipart/form-data" method="post">
                        <label class="picture  input1" for="picture__input" tabIndex="0">
                            <span class="picture__image"></span>
                        </label>
                        <input type="file" name="arquivo" id="picture__input">
                        <script src="js/script.js"></script><br/><br/>
                        <label for="nome">Nome: </label>
                        <input type="text" name="nome" required> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <label for="autor">Autor: </label>
                        <input type="text" name="autor" required><br/><br/>
                        <label for="editora">Editora: </label>
                        <input type="text" name="editora" required>&nbsp;&nbsp;&nbsp;&nbsp;
                        <label for="isbn">ISBN: </label>
                        <input type="number" name='isbn' required><br/><br/>
                        <label for="pag">Página: </label>
                        <input type="number" name='pag' required>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <label for="genero">Gênero: </label>
                        <select name="genero" required>
                            <option value=""></option>
                            <option value="1">Terror</option>
                            <option value="2">Mistério</option>
                            <option value="3">Comédia</option>
                            <option value="4">Drama</option>
                            <option value="5">Romance</option>
                            <option value="6">Aventura</option>
                            <option value="7">Histórico</option>
                            <option value="8">Biografia</option>
                            <option value="9">Ação</option>
                            <option value="10">Ficçao</option>
                        </select><br/><br/>
                        <input type="submit" value="Cadastrar" name="cadastrar3" class="buttons2"><br/><br/>
                    </form>
                </div>
        <?php } elseif (isset($_POST["cdt4"])) { ?>
                <div class="cdt4 meio">
            <!-- -------------------------------------------!!!!CADASTRO DO ESTOQUE!!!!----------------------------------- -->
                    <br/><br/>
                    <form action="" autocomplete="off" method="post">
                        <label for="cod">Código: </label>
                        <input type="tel" name="cod" maxlength="3" required><br/><br/>
                        <label for="qtde">Quantidade: </label>
                        <input type="number" name="qtde" maxlength="10" required>
                        <br/><br/>
                        <input type="submit" value="Cadastrar" name="cadastrar4" class="buttons2"><br/><br/>
                    </form>
                </div>

                <table border="1" cellpadding="10" class="consulta consulta1">
                    <thead>
                        <th>Código</th>
                        <th>Nome</th>
                        <tbody>
                        <?php while ($arquivo = $sql_query->fetch_assoc()) { ?>
                            <tr>
                                <td><?php echo $arquivo["cod"]; ?></td>
                                <td><?php echo $arquivo["nome"]; ?></td>
                            </tr>
                        <?php } ?>
                        </tbody>
                    </thead>
                </table>

                <table border="1" cellpadding="10" class="consulta consulta2">
                    <thead>
                        <th>Código do Livro</th>
                        <th>Quantidade</th>
                        <th>Quantidade Atual</th>
                        <tbody>
                        <?php while (
                            $arquivo2 = $sql_query2->fetch_assoc()
                        ) { ?>
                            <tr>
                                <td><?php echo $arquivo2["cod_livro"]; ?></td>
                                <td><?php echo $arquivo2["qtde"]; ?></td>
                                <td><?php echo $arquivo2["qtde_atual"]; ?></td>
                            </tr>
                        <?php } ?>
                        </tbody>
                    </thead>
                </table>
        <?php } else { ?>
        <?php } ?>
        <!-- -----------------------------------!!!!!!OS CADASTROS TERMINAM AQUI!!!!!!-------------------------- -->

        <!-- -------------------------------------------!!!!^~TODAS AS ALTERAÇÕES!!!!----------------------------------- -->
        
        <!-- -------------------------------------------!!!!BUSCANDO AS INFORMAÇÕES QUE ESTAM NO BANCO!!!!----------------------------------- -->
        <?php if (isset($_POST["alter1"])) { ?>
            <br/><br/>
            <div class="alt1 meio">
                <form action="" autocomplete="off" method="post">
                    <label for="email_b">Email: </label>
                    <input type="text" name="email_b" required>
                    <br/><br/>
                    <input type="submit" value="Buscar" name="Buscar1" class="buttons2"><br/><br/>
                </form>
            </div>
        <?php } elseif (isset($_POST["alter2"])) { ?>
            <br/><br/>
            <div class="alt1 meio">
                <form action="" autocomplete="off" method="post">
                    <label for="email_b">Email: </label>
                    <input type="text" name="email_b" required>
                    <br/><br/>
                    <input type="submit" value="Buscar" name="Buscar2" class="buttons2"><br/><br/>
                </form>
            </div>
        <?php } elseif (isset($_POST["alter3"])) { ?>
            <br/><br/>
            <div class="alt2 meio">
                <form action="" autocomplete="off" method="POST">
                    <label for="nome_b">Nome: </label>
                    <input type="text" name="nome_b" required>
                    <br/><br/>
                    <input type="submit" value="Buscar" name="Buscar3" class="buttons2">
                </form>
            </div>
            <br/><br/>
        <?php } elseif (isset($_POST["alter4"])) { ?>
            <br/><br/>
            <div class="alt3 meio">
                <form action="" autocomplete="off" method="post">
                    <label for="cod_b">Código do livro: </label>
                    <input type="text" name="cod_b" required>
                    <br/><br/>
                    <input type="submit" value="Buscar" name="Buscar4" class="buttons2"><br/><br/>
                </form>
            </div>

            <table border="1" cellpadding="10" class="consulta consulta1">
                    <thead>
                        <th>Código</th>
                        <th>Nome</th>
                        <tbody>
                        <?php while ($arquivo = $sql_query->fetch_assoc()) { ?>
                            <tr>
                                <td><?php echo $arquivo["cod"]; ?></td>
                                <td><?php echo $arquivo["nome"]; ?></td>
                            </tr>
                        <?php } ?>
                        </tbody>
                    </thead>
                </table>

                <table border="1" cellpadding="10" class="consulta consulta2">
                    <thead>
                        <th>Código do Livro</th>
                        <th>Quantidade</th>
                        <th>Quantidade Atual</th>
                        <tbody>
                        <?php while (
                            $arquivo2 = $sql_query2->fetch_assoc()
                        ) { ?>
                            <tr>
                                <td><?php echo $arquivo2["cod_livro"]; ?></td>
                                <td><?php echo $arquivo2["qtde"]; ?></td>
                                <td><?php echo $arquivo2["qtde_atual"]; ?></td>
                            </tr>
                        <?php } ?>
                        </tbody>
                    </thead>
                </table>
        <?php } else { ?>

        <?php } ?>


        <!-- -------------------------------------------!!!!ALTERANDO AS INFORMAÇÕES QUE ESTAM NO BANCO!!!!----------------------------------- -->
        <?php if (isset($_POST["Buscar1"])) {

            // -------------------------------------------!!!!FORMULÁRIO DE ALTERAÇÃO DO FUNCIONÁRIO!!!!----------------------------------- //
            $email = $_POST["email_b"];
            ($bn_busca1 = $mysqli->query(
                "SELECT * FROM tbfuncionario WHERE email = '$email'"
            )) or die($mysqli->error);

            $quantidade = $bn_busca1->num_rows;

            if ($quantidade == 1) {
                $busca1 = $bn_busca1->fetch_assoc(); ?>
                <div class="alterar1 meio">
                    <br/><br/>
                    <form action="" autocomplete="off" method="post">
                        <label for="cod">Código: </label>
                        <input type="number" name="cod" maxlength="5" value="<?php echo $busca1["cod"]; ?>" required readonly><br/><br/>
                        <label for="nome">Nome: </label>
                        <input type="text" name="nome" required value="<?php echo $busca1["nome" ]; ?>"> &nbsp;&nbsp;&nbsp;
                        <label for="tel">Telefone: </label>
                        <input type="tel" name="tel" maxlength="11" value="<?php echo $busca1["fone"]; ?>"  required><br/><br/>
                        <label for="email">Email: </label>
                        <input type="text" name="email" value="<?php echo $busca1["email"]; ?>" required>&nbsp;&nbsp;&nbsp;&nbsp;
                        <label for="periodo">Período: </label>
                        <select name="periodo" required>
                            <option value=""><?php echo $busca1["periodo"]; ?></option>
                            <option value="M">Manhã</option>
                            <option value="T">Tarde</option>
                            <option value="N">Noite</option>
                        </select><br/><br/>
                        <label for="senha">Senha: </label>
                        <input type="text" name='senha' value="<?php echo $busca1["senha"]; ?>" required>&nbsp;&nbsp;&nbsp;&nbsp;
                        <label for="funcao">Função: </label>
                        <select name="funcao"  required>
                            <option value=""><?php echo $busca1["perfil"]; ?></option>
                            <option value="1">Master</option>
                            <option value="2">Funcionário</option>
                        </select><br/>
                        <br/><br/>
                        <input type="submit" value="Alterar" name="alterar1" class="buttons2"><br/><br/>
                    </form>
                </div>
            <?php
            } else {
            }
            ?>
        <?php
        } elseif (isset($_POST["Buscar2"])) {

            // -------------------------------------------!!!!FORMULÁRIO DE ALTERAÇÃO DO CLIENTE/ALUNO!!!!----------------------------------- //

            $email = $_POST["email_b"];
            ($bn_busca1 = $mysqli->query(
                "SELECT * FROM tbcliente WHERE email = '$email'"
            )) or die($mysqli->error);

            $quantidade = $bn_busca1->num_rows;

            if ($quantidade == 1) {
                $busca1 = $bn_busca1->fetch_assoc(); ?>
                <div class="alterar2 meio">
                    <br/><br/>
                    <form action="" autocomplete="off" method="post">
                        <label for="cod">Código: </label>
                        <input type="number" name="cod" maxlength="5" value="<?php echo $busca1["cod"]; ?>" required readonly><br/><br/>
                        <label for="nome">Nome: </label>
                        <input type="text" name="nome" value="<?php echo $busca1["nome"]; ?>" required> &nbsp;&nbsp;&nbsp;&nbsp;
                        <label for="number">Telefone: </label>
                        <input type="tel" name="number" maxlength="11" value="<?php echo $busca1["fone"]; ?>" required><br/><br/>
                        <label for="email">Email: </label>
                        <input type="text" name="email" value="<?php echo $busca1["email"]; ?>" required>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <label for="end">Endereço: </label>
                        <input type="text" name='end' value="<?php echo $busca1["endereco"]; ?>" required><br/><br/>
                        <label for="senha">Senha: </label>
                        <input type="text" name='senha' value="<?php echo $busca1["senha"]; ?>" required><br/><br/>
                        <input type="submit" value="Alterar" name="alterar2" class="buttons2"><br/><br/>
                    </form>
                </div>
            <?php
            }
            ?>
        <?php
        } elseif (isset($_POST["Buscar3"])) {

            // -------------------------------------------!!!!FORMULÁRIO DE ALTERAÇÃO DO LIVRO!!!!----------------------------------- //

            $nome_b = $_POST["nome_b"];
            ($bn_busca1 = $mysqli->query(
                "SELECT * FROM tblivro WHERE nome = '$nome_b'"
            )) or die($mysqli->error);

            $quantidade = $bn_busca1->num_rows;

            if ($quantidade == 1) {
                $busca1 = $bn_busca1->fetch_assoc(); ?>
                <div class="alterar3 meio">
                    <br/><br/>
                    <form action="" enctype="multipart/form-data" method="post">
                        <label class="picture input2" for="picture__input" tabIndex="0">
                            <span class="picture__image"></span>
                        </label>
                        <input type="file" name="arquivo" id="picture__input">
                        <script src="js/script.js"></script>
                        <img src="<?php echo $busca1["caminho"]; ?>" width="180px" id="alterImg"><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>
                        <label for="alterarft3" class="alterarft3">Alterar a imagem: </label><br/>
                        <input type="submit" value="Alterar" name="alterarft3" class="buttons2"><br/><br/>
                    <br/><br/>
                    <form action="" autocomplete="off" enctype="multipart/form-data" method="post">
                        <label for="cod">Código: </label>
                        <input type="number" name="cod" maxlength="5" value="<?php echo $busca1["cod"]; ?>" required readonly><br/><br/>
                        <label for="nome">Nome: </label>
                        <input type="text" name="nome" value="<?php echo $busca1["nome"]; ?>" required> &nbsp;&nbsp;&nbsp;&nbsp;
                        <label for="autor">Autor: </label>
                        <input type="text" name="autor" value="<?php echo $busca1["autor"]; ?>" required><br/><br/>
                        <label for="editora">Editora: </label>
                        <input type="text" name="editora" value="<?php echo $busca1["editora"]; ?>" required>&nbsp;&nbsp;&nbsp;
                        <label for="isbn">ISBN: </label>
                        <input type="number" name='isbn' value="<?php echo $busca1["isbn"]; ?>" required><br/><br/>
                        <label for="pag">Página: </label>
                        <input type="number" name='pag' value="<?php echo $busca1["pagina"]; ?>" required>&nbsp;&nbsp;&nbsp;&nbsp;
                        <label for="genero">Gênero: </label>
                        <select name="genero" required>
                            <option value="<?php echo $busca1["genero"]; ?>"><?php echo $busca1["genero"]; ?></option>
                            <option value="1">Terror</option>
                            <option value="2">Mistério</option>
                            <option value="3">Comédia</option>
                            <option value="4">Drama</option>
                            <option value="5">Romance</option>
                            <option value="6">Aventura</option>
                            <option value="7">Histórico</option>
                            <option value="8">Biografia</option>
                            <option value="9">Ação</option>
                            <option value="10">Ficçao</option>
                        </select><br/><br/>
                        <label for="alterarcp3" class="alterarcp3">Alterar os campos que são texto: </label><br/>
                        <input type="submit" value="Alterar" name="alterarcp3" class="buttons2"><br/><br/>
                    </form>
                </div>
            <?php
            } else {
            }
            ?>
        <?php
        } elseif (isset($_POST["Buscar4"])) {

            // -------------------------------------------!!!!FORMULÁRIO DE ALTERAÇÃO DO ESTOQUE!!!!----------------------------------- //

            $cod_livro = $_POST["cod_b"];
            ($bn_busca1 = $mysqli->query(
                "SELECT * FROM tbestoque WHERE cod_livro = '$cod_livro'"
            )) or die($mysqli->error);

            $quantidade = $bn_busca1->num_rows;

            if ($quantidade == 1) {
                $busca1 = $bn_busca1->fetch_assoc(); ?>
                <div class="alterar4 meio">
                    <br/><br/>
                    <form action="" autocomplete="off" method="post">
                        <label for="cod">Código do Estoque: </label>
                        <input type="number" name="cod" maxlength="5" value="<?php echo $busca1["cod"]; ?>" required readonly>&nbsp;&nbsp;&nbsp;
                        <label for="cod_livro">Código do livro: </label>
                        <input type="number" name="cod_livro" maxlength="5" value="<?php echo $busca1["cod_livro"]; ?>" required><br/><br/>
                        <label for="qtde">Quantidade Total: </label>
                        <input type="number" name="qtde" maxlength="11" value="<?php echo $busca1["qtde"]; ?>" required>&nbsp;&nbsp;&nbsp;&nbsp;
                        <label for="qtde_atual">Quantidade Atual: </label>
                        <input type="number" name="qtde_atual" maxlength="11" value="<?php echo $busca1["qtde_atual"]; ?>" required>
                        <br/><br/>
                        <input type="submit" value="Alterar" name="alterar4" class="buttons2"><br/><br/>
                    </form>
                </div>

                <table border="1" cellpadding="10" class="consulta consulta1">
                    <thead>
                        <th>Código</th>
                        <th>Nome</th>
                        <tbody>
                        <?php while ($arquivo = $sql_query->fetch_assoc()) { ?>
                            <tr>
                                <td><?php echo $arquivo["cod"]; ?></td>
                                <td><?php echo $arquivo["nome"]; ?></td>
                            </tr>
                        <?php } ?>
                        </tbody>
                    </thead>
                </table>

                <table border="1" cellpadding="10" class="consulta consulta2">
                    <thead>
                        <th>Código do Livro</th>
                        <th>Quantidade</th>
                        <th>Quantidade Atual</th>
                        <tbody>
                        <?php while (
                            $arquivo2 = $sql_query2->fetch_assoc()
                        ) { ?>
                            <tr>
                                <td><?php echo $arquivo2["cod_livro"]; ?></td>
                                <td><?php echo $arquivo2["qtde"]; ?></td>
                                <td><?php echo $arquivo2["qtde_atual"]; ?></td>
                            </tr>
                        <?php } ?>
                        </tbody>
                    </thead>
                </table>
            <?php
            } else {
            }
            ?>
        <?php
        } else {
        } ?>
    <!-- -------------------------------------------!!!!TODAS AS ALTERAÇÕES ACABAM AQUI!!!!----------------------------------- -->

    <!-- -------------------------------------------!!!!^~TODOS EXCLUIR!!!!----------------------------------- -->

    <!-- -------------------------------------------!!!!BUSCANDO AS INFORMAÇÕES QUE ESTAM NO BANCO!!!!----------------------------------- -->
    <?php if (isset($_POST["exc1"])) { ?>
        <div class="alt1 meio">
            <br/><br/>
            <form action="" autocomplete="off" method="post">
                <label for="email_d">Email: </label>
                <input type="text" name="email_d" required>
                <br/><br/>
                <input type="submit" value="Buscar" name="buscar11" class="buttons2"><br/><br/>
            </form>
        </div>
    <?php } elseif (isset($_POST["exc2"])) { ?>
        <div class="alt1 meio">
            <br/><br/>
            <form action="" autocomplete="off" method="post">
                <label for="email_d">Email: </label>
                <input type="text" name="email_d" required>
                <br/><br/>
                <input type="submit" value="Buscar" name="buscar22" class="buttons2"><br/><br/>
            </form>
        </div>
    <?php } elseif (isset($_POST["exc3"])) { ?>
        <div class="alt2 meio">
            <br/><br/>
            <form action="" autocomplete="off" method="POST">
                <label for="nome_d">Nome: </label>
                <input type="text" name="nome_d" required>
                <br/><br/>
                <input type="submit" value="Buscar" name="buscar33" class="buttons2">
            </form>
            <br/><br/>
        </div>
    <?php } elseif (isset($_POST["exc4"])) { ?>
        <div class="alt3 meio">
            <br/><br/>
            <form action="" autocomplete="off" method="post">
                <label for="cod_d">Código do livro: </label>
                <input type="text" name="cod_d" required>
                <br/><br/>
                <input type="submit" value="Buscar" name="buscar44" class="buttons2"><br/><br/>
            </form>
        </div>
        <table border="1" cellpadding="10" class="consulta consulta1">
                <thead>
                    <th>Código</th>
                    <th>Nome</th>
                    <tbody>
                    <?php while ($arquivo = $sql_query->fetch_assoc()) { ?>
                        <tr>
                            <td><?php echo $arquivo["cod"]; ?></td>
                            <td><?php echo $arquivo["nome"]; ?></td>
                        </tr>
                    <?php } ?>
                    </tbody>
                </thead>
            </table>

            <table border="1" cellpadding="10" class="consulta consulta2">
                <thead>
                    <th>Código do Livro</th>
                    <th>Quantidade</th>
                    <th>Quantidade Atual</th>
                    <tbody>
                    <?php while ($arquivo2 = $sql_query2->fetch_assoc()) { ?>
                        <tr>
                            <td><?php echo $arquivo2["cod_livro"]; ?></td>
                            <td><?php echo $arquivo2["qtde"]; ?></td>
                            <td><?php echo $arquivo2["qtde_atual"]; ?></td>
                        </tr>
                    <?php } ?>
                    </tbody>
                </thead>
            </table>
    <?php } else { ?>

    <?php } ?>


    <!-- -------------------------------------------!!!!EXCLUINDO AS INFORMAÇÕES QUE ESTAM NO BANCO!!!!----------------------------------- -->
    <?php if (isset($_POST["buscar11"])) {

        // -------------------------------------------!!!!FORMULÁRIO DE EXCLUSÃO DO FUNCIONÁRIO!!!!----------------------------------- //
        $email_d = $_POST["email_d"];
        ($bn_busca1 = $mysqli->query(
            "SELECT * FROM tbfuncionario WHERE email = '$email_d'"
        )) or die($mysqli->error);

        $quantidade = $bn_busca1->num_rows;

        if ($quantidade == 1) {
            $busca1 = $bn_busca1->fetch_assoc(); ?>
            <div class="alterar1 meio">
                <br/><br/>
                <form action="" autocomplete="off" method="post">
                    <label for="cod">Código: </label>
                    <input type="number" name="cod" maxlength="5" value="<?php echo $busca1["cod"]; ?>" required readonly><br/><br/>
                    <label for="nome">Nome: </label>
                    <input type="text" name="nome" required value="<?php echo $busca1["nome"]; ?>" readonly> &nbsp;&nbsp;&nbsp;
                    <label for="tel">Telefone: </label>
                    <input type="tel" name="tel" maxlength="11" value="<?php echo $busca1["fone"]; ?>"  required readonly><br/><br/>
                    <label for="email">Email: </label>
                    <input type="text" name="email" value="<?php echo $busca1["email"]; ?>" required readonly>&nbsp;&nbsp;&nbsp;&nbsp;
                    <label for="periodo">Período: </label>
                    <select name="periodo" required readonly>
                        <option value="<?php echo $busca1["periodo"]; ?>"><?php echo $busca1["periodo"]; ?></option>
                    </select><br/><br/>
                    <label for="senha">Senha: </label>
                    <input type="text" name='senha' value="<?php echo $busca1["senha"]; ?>" required readonly>&nbsp;&nbsp;&nbsp;&nbsp;
                    <label for="funcao">Função: </label>
                    <select name="funcao" required readonly>
                        <option value="<?php echo $busca1["perfil"]; ?>"><?php echo $busca1["perfil"]; ?></option>
                    </select><br/>
                    <br/><br/>
                    <input type="submit" value="Excluir" name="excluir1" class="buttons2"><br/><br/>
                </form>
            </div>
        <?php
        } else {
        }
        ?>
    <?php
    } elseif (isset($_POST["buscar22"])) {

        // -------------------------------------------!!!!FORMULÁRIO DE EXCLUSÃO DO CLIENTE/ALUNO!!!!----------------------------------- //

        $email_d = $_POST["email_d"];
        ($bn_busca1 = $mysqli->query(
            "SELECT * FROM tbcliente WHERE email = '$email_d'"
        )) or die($mysqli->error);

        $quantidade = $bn_busca1->num_rows;

        if ($quantidade == 1) {
            $busca1 = $bn_busca1->fetch_assoc(); ?>
            <div class="alterar2 meio">
                <br/><br/>
                <form action="" autocomplete="off" method="post">
                    <label for="cod">Código: </label>
                    <input type="number" name="cod" maxlength="5" value="<?php echo $busca1["cod"]; ?>" required readonly><br/><br/>
                    <label for="nome">Nome: </label>
                    <input type="text" name="nome" value="<?php echo $busca1["nome"]; ?>" required readonly> &nbsp;&nbsp;&nbsp;&nbsp;
                    <label for="number">Telefone: </label>
                    <input type="tel" name="number" maxlength="11" value="<?php echo $busca1["fone"]; ?>" required readonly><br/><br/>
                    <label for="email">Email: </label>
                    <input type="text" name="email" value="<?php echo $busca1["email"]; ?>" required readonly>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <label for="end">Endereço: </label>
                    <input type="text" name='end' value="<?php echo $busca1["endereco"]; ?>" required readonly><br/><br/>
                    <label for="senha">Senha: </label>
                    <input type="text" name='senha' value="<?php echo $busca1["senha"]; ?>" required readonly>
                    <br/><br/>
                    <input type="submit" value="Excluir" name="excluir2" class="buttons2"><br/><br/>
                </form>
            </div>
        <?php
        } else {
        }
        ?>
    <?php
    } elseif (isset($_POST["buscar33"])) {

        // -------------------------------------------!!!!FORMULÁRIO DE EXCLUSÃO DO LIVRO!!!!----------------------------------- //

        $nome_d = $_POST["nome_d"];
        ($bn_busca1 = $mysqli->query(
            "SELECT * FROM tblivro WHERE nome = '$nome_d'"
        )) or die($mysqli->error);

        $quantidade = $bn_busca1->num_rows;

        if ($quantidade == 1) {
            $busca1 = $bn_busca1->fetch_assoc(); ?>
            <div class="alterar3 meio">
                <br/><br/>
                <form action="" autocomplete="off" enctype="multipart/form-data" method="post">
                    <img src="<?php echo $busca1["caminho"]; ?>" width="180px" class="imagem1"><br/><br/>
                    <label for="cod">Código: </label>
                    <input type="number" name="cod" maxlength="5" value="<?php echo $busca1["cod"]; ?>" required readonly><br/><br/>
                    <label for="nome">Nome: </label>
                    <input type="text" name="nome" value="<?php echo $busca1["nome"]; ?>" required readonly> &nbsp;&nbsp;&nbsp;&nbsp;
                    <label for="autor">Autor: </label>
                    <input type="text" name="autor" value="<?php echo $busca1["autor"]; ?>" required readonly><br/><br/>
                    <label for="editora">Editora: </label>
                    <input type="text" name="editora" value="<?php echo $busca1["editora"]; ?>" required readonly>&nbsp;&nbsp;&nbsp;
                    <label for="isbn">ISBN: </label>
                    <input type="number" name='isbn' value="<?php echo $busca1["isbn"]; ?>" required readonly><br/><br/>
                    <label for="pag">Página: </label>
                    <input type="number" name='pag' value="<?php echo $busca1["pagina"]; ?>" required readonly>&nbsp;&nbsp;&nbsp;&nbsp;
                    <label for="genero">Gênero: </label>
                    <select name="genero" required readonly>
                        <option value="<?php echo $busca1["genero"]; ?>"><?php echo $busca1["genero"]; ?></option>
                    </select><br/><br/>
                    <input type="submit" value="Excluir" name="excluir3" class="buttons2"><br/><br/>
                </form>
            </div>
        <?php
        } else {
        }
        ?>
    <?php
    } elseif (isset($_POST["buscar44"])) {

        // -------------------------------------------!!!!FORMULÁRIO DE EXCLUSÃO DO ESTOQUE!!!!----------------------------------- //

        $cod_livrod = $_POST["cod_d"];
        ($bn_busca1 = $mysqli->query(
            "SELECT * FROM tbestoque WHERE cod_livro = '$cod_livrod'"
        )) or die($mysqli->error);

        $quantidade = $bn_busca1->num_rows;

        if ($quantidade == 1) {
            $busca1 = $bn_busca1->fetch_assoc(); ?>
            <div class="alterar4 meio">
                <br/><br/>
                <form action="" autocomplete="off" method="post">
                    <label for="cod">Código do Estoque: </label>
                    <input type="number" name="cod" maxlength="5" value="<?php echo $busca1["cod"]; ?>" required readonly>&nbsp;&nbsp;&nbsp;
                    <label for="cod_livro">Código do livro: </label>
                    <input type="number" name="cod_livro" maxlength="5" value="<?php echo $busca1["cod_livro"]; ?>" required readonly><br/><br/>
                    <label for="qtde">Quantidade Total: </label>
                    <input type="number" name="qtde" maxlength="11" value="<?php echo $busca1["qtde"]; ?>" required readonly> &nbsp;&nbsp;&nbsp;
                    <label for="qtde_atual">Quantidade Atual: </label>
                    <input type="number" name="qtde_atual" maxlength="11" value="<?php echo $busca1["qtde_atual"]; ?>" required readonly>
                    <br/><br/>
                    <input type="submit" value="Excluir" name="excluir4" class="buttons2"><br/><br/>
                </form>
            </div>

            <table border="1" cellpadding="10" class="consulta consulta3">
                <thead>
                    <th>Código</th>
                    <th>Nome</th>
                    <tbody>
                    <?php while ($arquivo = $sql_query->fetch_assoc()) { ?>
                        <tr>
                            <td><?php echo $arquivo["cod"]; ?></td>
                            <td><?php echo $arquivo["nome"]; ?></td>
                        </tr>
                    <?php } ?>
                    </tbody>
                </thead>
            </table>
        <?php
        } else {
        }
        ?>
    <?php
    } else {
    } ?>
    <!-- -------------------------------------------!!!!TODOS EXCLUIR ACABAM AQUI!!!!----------------------------------- -->

    <!-- -------------------------------------------!!!!^~TODOS VISUALIZAR!!!!----------------------------------- -->

    <!-- -------------------------------------------!!!!BUSCANDO AS INFORMAÇÕES QUE ESTAM NO BANCO!!!!----------------------------------- -->
    <?php if (isset($_POST["vis1"])) {
        ($ab_busca1 = $mysqli->query("SELECT * FROM tbfuncionario")) or
            die($mysqli->error); ?>
            <div class="alt1 meio">
                <br/><br/>
                <form action="" autocomplete="off" method="post">
                    <label for="email_d">Email: </label>
                    <input type="text" name="email_d" required>
                    <br/><br/>
                    <input type="submit" value="Buscar" name="buscar15" class="buttons2"><br/><br/>
                </form>
            </div>
            
            <table border="1" cellpadding="10" class="consulta consulta3">
                <thead>
                    <th>Código</th>
                    <th>Nome</th>
                    <th>Telefone</th>
                    <th>Email</th>
                    <th>Período</th>
                    <th>Perfil</th>
                    <tbody>
                    <?php while ($arquivo = $ab_busca1->fetch_assoc()) { ?>
                        <tr>
                            <td><?php echo $arquivo["cod"]; ?></td>
                            <td><?php echo $arquivo["nome"]; ?></td>
                            <td><?php echo $arquivo["fone"]; ?></td>
                            <td><?php echo $arquivo["email"]; ?></td>
                            <td><?php echo $arquivo["periodo"]; ?></td>
                            <td><?php echo $arquivo["perfil"]; ?></td>
                        </tr>
                    <?php } ?>
                    </tbody>
                </thead>
            </table><br/><br/>

    <?php
    } elseif (isset($_POST["vis2"])) {
        ($ab_busca2 = $mysqli->query("SELECT * FROM tbcliente")) or
            die($mysqli->error); ?>
            <div class="alt1 meio">
                <br/><br/>
                <form action="" autocomplete="off" method="post">
                    <label for="email_d">Email: </label>
                    <input type="text" name="email_d" required>
                    <br/><br/>
                    <input type="submit" value="Buscar" name="buscar16" class="buttons2"><br/><br/>
                </form>
            </div>

        
            <table border="1" cellpadding="10" class="consulta consulta3">
                <thead>
                    <th>Código</th>
                    <th>Nome</th>
                    <th>Telefone</th>
                    <th>Email</th>
                    <th>Endereço</th>
                    <th>Perfil</th>
                    <tbody>
                    <?php while ($arquivo = $ab_busca2->fetch_assoc()) { ?>
                        <tr>
                            <td><?php echo $arquivo["cod"]; ?></td>
                            <td><?php echo $arquivo["nome"]; ?></td>
                            <td><?php echo $arquivo["fone"]; ?></td>
                            <td><?php echo $arquivo["email"]; ?></td>
                            <td><?php echo $arquivo["endereco"]; ?></td>
                            <td><?php echo $arquivo["perfil"]; ?></td>
                        </tr>
                    <?php } ?>
                    </tbody>
                </thead>
            </table><br/><br/>
    <?php
    } elseif (isset($_POST["vis3"])) {
        ($ab_busca3 = $mysqli->query("SELECT * FROM tblivro")) or
            die($mysqli->error); ?>
            <div class="alt2 meio">
                <br/><br/>
                <form action="" autocomplete="off" method="POST">
                    <label for="nome_d">Nome: </label>
                    <input type="text" name="nome_d" required>
                    <br/><br/>
                    <input type="submit" value="Buscar" name="buscar17" class="buttons2"><br/><br/>
                </form>
            </div>

            <table border="1" cellpadding="10" class="consulta consulta3">
                <thead>
                    <th>imagem</th>
                    <th>Código</th>
                    <th>Nome</th>
                    <th>Autor</th>
                    <th>Gênero</th>
                    <th>Editora</th>
                    <th>ISBN</th>
                    <th>Páginas</th>
                    <th>Caminho</th>
                    <th>Data de Cadastro</th>
                    <tbody>
                    <?php while ($arquivo = $ab_busca3->fetch_assoc()) { ?>
                        <tr>
                            <td><img src="<?php echo $arquivo[
                                "caminho"
                            ]; ?>" width="180px"></td>
                            <td><?php echo $arquivo["cod"]; ?></td>
                            <td><?php echo $arquivo["nome"]; ?></td>
                            <td><?php echo $arquivo["autor"]; ?></td>
                            <td><?php echo $arquivo["genero"]; ?></td>
                            <td><?php echo $arquivo["editora"]; ?></td>
                            <td><?php echo $arquivo["isbn"]; ?></td>
                            <td><?php echo $arquivo["pagina"]; ?></td>
                            <td><?php echo $arquivo["caminho"]; ?></td>
                            <td><?php echo date(
                                "d/m/Y H:i",
                                strtotime($arquivo["dt_cad"])
                            ); ?></td>
                        </tr>
                    <?php } ?>
                    </tbody>
                </thead>
            </table><br/><br/>
    <?php
    } elseif (isset($_POST["vis4"])) { ?>
        <div class="alt3 meio">
            <br/><br/>
            <form action="" autocomplete="off" method="post">
                <label for="cod_d">Código do livro: </label>
                <input type="text" name="cod_d" required>
                <br/><br/>
                <input type="submit" value="Buscar" name="buscar18" class="buttons2"><br/><br/>
            </form>
        </div>

        <table border="1" cellpadding="10" class="consulta consulta1">
            <thead>
                <th>Código</th>
                <th>Nome</th>
                <tbody>
                <?php while ($arquivo = $sql_query->fetch_assoc()) { ?>
                    <tr>
                        <td><?php echo $arquivo["cod"]; ?></td>
                        <td><?php echo $arquivo["nome"]; ?></td>
                    </tr>
                <?php } ?>
                </tbody>
            </thead>
        </table>

            <table border="1" cellpadding="10" class="consulta consulta2">
                <thead>
                    <th>Código do Livro</th>
                    <th>Quantidade</th>
                    <th>Quantidade Atual</th>
                    <tbody>
                    <?php while ($arquivo2 = $sql_query2->fetch_assoc()) { ?>
                        <tr>
                            <td><?php echo $arquivo2["cod_livro"]; ?></td>
                            <td><?php echo $arquivo2["qtde"]; ?></td>
                            <td><?php echo $arquivo2["qtde_atual"]; ?></td>
                        </tr>
                    <?php } ?>
                    </tbody>
                </thead>
            </table>
    <?php } else { ?>

    <?php } ?>


    <!-- -------------------------------------------!!!!VISUALIZAR AS INFORMAÇÕES QUE ESTAM NO BANCO!!!!----------------------------------- -->
    <?php if (isset($_POST["buscar15"])) {

        // -------------------------------------------!!!!FORMULÁRIO DE VISUALIZAR DO FUNCIONÁRIO!!!!----------------------------------- //
        $email_d = $_POST["email_d"];
        ($bn_busca1 = $mysqli->query(
            "SELECT * FROM tbfuncionario WHERE email = '$email_d'"
        )) or die($mysqli->error);

        $quantidade = $bn_busca1->num_rows;

        if ($quantidade == 1) {
            $busca1 = $bn_busca1->fetch_assoc(); ?>
            <div class="alterar1 meio">
                <br/><br/>
                <form action="" autocomplete="off" method="post">
                    <label for="cod">Código: </label>
                    <input type="number" name="cod" maxlength="5" value="<?php echo $busca1["cod"]; ?>" required readonly><br/><br/>
                    <label for="nome">Nome: </label>
                    <input type="text" name="nome" required value="<?php echo $busca1["nome"]; ?>" readonly> &nbsp;&nbsp;&nbsp;
                    <label for="tel">Telefone: </label>
                    <input type="tel" name="tel" maxlength="11" value="<?php echo $busca1["fone"]; ?>"  required readonly><br/><br/>
                    <label for="email">Email: </label>
                    <input type="text" name="email" value="<?php echo $busca1["email"]; ?>" required readonly>&nbsp;&nbsp;&nbsp;&nbsp;
                    <label for="periodo">Período: </label>
                    <select name="periodo" required readonly>
                        <option value="<?php echo $busca1["periodo"]; ?>"><?php echo $busca1["periodo"]; ?></option>
                    </select><br/><br/>
                    <label for="senha">Senha: </label>
                    <input type="text" name='senha' value="<?php echo $busca1["senha"]; ?>" required readonly>&nbsp;&nbsp;&nbsp;&nbsp;
                    <label for="funcao">Função: </label>
                    <select name="funcao" required readonly>
                        <option value="<?php echo $busca1["perfil"]; ?>" readonly><?php echo $busca1["perfil"]; ?></option>
                    </select><br/>
                    <br/><br/>
                </form>
            </div>
        <?php
        } else {
        }
        ?>
    <?php
    } elseif (isset($_POST["buscar16"])) {

        // -------------------------------------------!!!!FORMULÁRIO DE VISUALIZAR DO CLIENTE/ALUNO!!!!----------------------------------- //

        $email_d = $_POST["email_d"];
        ($bn_busca1 = $mysqli->query(
            "SELECT * FROM tbcliente WHERE email = '$email_d'"
        )) or die($mysqli->error);

        $quantidade = $bn_busca1->num_rows;

        if ($quantidade == 1) {
            $busca1 = $bn_busca1->fetch_assoc(); ?>
            <div class="alterar2 meio">
                <br/><br/>
                <form action="" autocomplete="off" method="post">
                    <label for="cod">Código: </label>
                    <input type="number" name="cod" maxlength="5" value="<?php echo $busca1["cod"]; ?>" required readonly><br/><br/>
                    <label for="nome">Nome: </label>
                    <input type="text" name="nome" value="<?php echo $busca1["nome"]; ?>" required readonly> &nbsp;&nbsp;&nbsp;&nbsp;
                    <label for="number">Telefone: </label>
                    <input type="tel" name="number" maxlength="11" value="<?php echo $busca1["fone"]; ?>" required readonly><br/><br/>
                    <label for="email">Email: </label>
                    <input type="text" name="email" value="<?php echo $busca1["email"]; ?>" required readonly>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <label for="end">Endereço: </label>
                    <input type="text" name='end' value="<?php echo $busca1["endereco"]; ?>" required readonly><br/><br/>
                    <label for="senha">Senha: </label>
                    <input type="text" name='senha' value="<?php echo $busca1["senha"]; ?>" required readonly>
                    <br/><br/>
                </form>
            </div>
        <?php
        } else {
        }
        ?>
        <?php
    } elseif (isset($_POST["buscar17"])) {

        // -------------------------------------------!!!!FORMULÁRIO DE VISUALIZAR DO LIVRO!!!!----------------------------------- //

        $nome_d = $_POST["nome_d"];
        ($bn_busca1 = $mysqli->query(
            "SELECT * FROM tblivro WHERE nome = '$nome_d'"
        )) or die($mysqli->error);

        $quantidade = $bn_busca1->num_rows;

        if ($quantidade == 1) {
            $busca1 = $bn_busca1->fetch_assoc(); ?>
            <div class="alterar3 meio">
                <br/><br/>
                <form action="" autocomplete="off" enctype="multipart/form-data" method="post">
                    <img src="<?php echo $busca1["caminho"]; ?>" width="180px" class="imagem1"><br/><br/>
                    <label for="cod">Código: </label>
                    <input type="number" name="cod" maxlength="5" value="<?php echo $busca1["cod"]; ?>" required readonly><br/><br/>
                    <label for="nome">Nome: </label>
                    <input type="text" name="nome" value="<?php echo $busca1["nome"]; ?>" required readonly> &nbsp;&nbsp;&nbsp;&nbsp;
                    <label for="autor">Autor: </label>
                    <input type="text" name="autor" value="<?php echo $busca1["autor"]; ?>" required readonly><br/><br/>
                    <label for="genero">Gênero: </label>
                    <select name="genero" required readonly>
                        <option value="<?php echo $busca1["genero"]; ?>"><?php echo $busca1["genero"]; ?></option>
                    </select>&nbsp;&nbsp;&nbsp;&nbsp;
                    <label for="editora">Editora: </label>
                    <input type="text" name="editora" value="<?php echo $busca1["editora"]; ?>" required readonly><br/><br/>
                    <label for="isbn">ISBN: </label>
                    <input type="number" name='isbn' value="<?php echo $busca1["isbn"]; ?>" required readonly>&nbsp;&nbsp;&nbsp;&nbsp;
                    <label for="pag">Página: </label>
                    <input type="number" name='pag' value="<?php echo $busca1["pagina"]; ?>" required readonly><br/><br/>
                </form>
            </div>
            <?php
        } else {
        }
        ?>
        <?php
    } elseif (isset($_POST["buscar18"])) {

        // -------------------------------------------!!!!FORMULÁRIO DE VISUALIZAR DO ESTOQUE!!!!----------------------------------- //

        $cod_livrod = $_POST["cod_d"];
        ($bn_busca1 = $mysqli->query(
            "SELECT * FROM tbestoque WHERE cod_livro = '$cod_livrod'"
        )) or die($mysqli->error);
        ($bn_busca2 = $mysqli->query(
            "SELECT * FROM tblivro WHERE cod = '$cod_livrod'"
        )) or die($mysqli->error);

        $quantidade = $bn_busca1->num_rows;

        if ($quantidade == 1) {
            $busca1 = $bn_busca1->fetch_assoc(); ?>
            <div class="alterar4 meio">
                <br/><br/>
                <form action="" autocomplete="off" method="post">
                    <label for="cod">Código do Estoque: </label>
                    <input type="number" name="cod" maxlength="5" value="<?php echo $busca1["cod"]; ?>" required readonly>&nbsp;&nbsp;&nbsp;
                    <label for="cod_livro">Código do livro: </label>
                    <input type="number" name="cod_livro" maxlength="5" value="<?php echo $busca1["cod_livro"]; ?>" required readonly><br/><br/>
                    <label for="qtde">Quantidade Total: </label>
                    <input type="number" name="qtde" maxlength="11" value="<?php echo $busca1["qtde"]; ?>" required readonly>&nbsp;&nbsp;&nbsp;&nbsp;
                    <label for="qtde_atual">Quantidade Atual: </label>
                    <input type="number" name="qtde_atual" maxlength="11" value="<?php echo $busca1["qtde_atual"]; ?>" required readonly>
                    <br/><br/>
                </form>
            </div>

            <table border="1" cellpadding="10" class="consulta consulta3">
                <thead>
                    <th>Código</th>
                    <th>Nome</th>
                    <tbody>
                    <?php $bn_busca22 = $bn_busca2->fetch_assoc(); ?>
                        <tr>
                            <td><?php echo $bn_busca22["cod"]; ?></td>
                            <td><?php echo $bn_busca22["nome"]; ?></td>
                        </tr>
                    </tbody>
                </thead>
            </table>
            <?php
        } else {
        }
        ?>
        <?php
    } else {
    } ?>
        <!-- -------------------------------------------!!!!TODOS VISUALIZAR ACABAM AQUI!!!!----------------------------------- -->
    </div>
</body>
</html>