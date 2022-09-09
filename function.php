<?php

function cad_Fun($a,$b,$c,$d,$e,$f){
    include('Conexao.php');

    $res = mysqli_query($mysqli,"INSERT INTO tbfuncionario(nome, fone, email, periodo, senha, perfil) VALUES('$a','$b','$c','$d','$e',$f)"); 

    mysqli_close($mysqli);
}

function cad_Clie($a,$b,$c,$d,$e){
    include('Conexao.php');

    $res = mysqli_query($mysqli,"INSERT INTO tbcliente(nome, fone, email, senha, endereco, perfil) VALUES('$a','$b','$c','$d','$e',3)"); 
    mysqli_close($mysqli);
}

function cadLivro($a,$b,$c,$d,$e,$f,$g){
    include('Conexao.php');

    $res = mysqli_query($mysqli,"INSERT INTO tblivro(nome, autor, genero, editora, isbn, pagina, caminho) VALUES('$a','$b',$c,'$d',$e,$f,'$g')"); 

    mysqli_close($mysqli);
}

function cad_QTDE($a,$b,$c){
    include('Conexao.php');

    $res = mysqli_query($mysqli,"INSERT INTO tbestoque(cod_livro, qtde, qtde_atual) VALUES($c,$a,$b)"); 

    mysqli_close($mysqli);
}

function alter_Fun($cod,$a,$b,$c,$d,$e,$f){
    include('Conexao.php');

    $res = mysqli_query($mysqli,"UPDATE tbfuncionario SET nome = '$a', fone = $b, email = '$c', periodo = '$d', senha = '$e', perfil = $f WHERE cod = $cod"); 

    mysqli_close($mysqli);
}

function alter_Clie($cod,$a,$b,$c,$d,$e){
    include('Conexao.php');

    $res = mysqli_query($mysqli,"UPDATE tbcliente SET nome = '$a', fone = $b, email = '$c', senha = '$d',  endereco = '$e' WHERE cod = $cod"); 

    mysqli_close($mysqli);
}


function alter_Estoque($cod,$a,$b,$c,$d,$e){
    include('Conexao.php');

    $res = mysqli_query($mysqli,"UPDATE tbcliente SET nome = '$a', fone = $b, email = '$c', senha = '$d',  endereco = '$e' WHERE cod = $cod"); 

    mysqli_close($mysqli);
}

function alter_Livroft($cod,$a){
    include('Conexao.php');

        $sql_query = $mysqli->query("SELECT * FROM tblivro WHERE cod = $cod") or die($mysqli->error);
        $arquivo = $sql_query->fetch_assoc();
        $imagem = $arquivo['caminho'];
        unlink($imagem);
    
        $res = mysqli_query($mysqli,"UPDATE tblivro SET caminho = '$a' WHERE cod = $cod"); 

    mysqli_close($mysqli);
}

function alter_Livrocp($cod,$a,$b,$c,$d,$e,$g){
    include('Conexao.php');

        $res = mysqli_query($mysqli,"UPDATE tblivro SET nome = '$a', autor = '$b', genero = $c, editora = '$d', isbn = $e, pagina = $g WHERE cod = $cod"); 

    mysqli_close($mysqli);
}

function alter_QTDE($cod,$a,$b,$c){
    include('Conexao.php');

    $res = mysqli_query($mysqli,"UPDATE tbestoque SET cod_livro = '$a', qtde = $b, qtde_atual = '$c' WHERE cod = $cod"); 

    mysqli_close($mysqli);
}

function exc_Fun($cod){
    include('Conexao.php');

    $res = mysqli_query($mysqli,"DELETE FROM tbfuncionario WHERE cod = $cod"); 

    mysqli_close($mysqli);
}

function exc_Clie($cod){
    include('Conexao.php');

    $res = mysqli_query($mysqli,"DELETE FROM tbcliente WHERE cod = $cod"); 

    mysqli_close($mysqli);
}

function exc_Livro($cod){
    include('Conexao.php');

    $sql_query = $mysqli->query("SELECT * FROM tblivro WHERE cod = $cod") or die($mysqli->error);
    $arquivo = $sql_query->fetch_assoc();
    $imagem = $arquivo['caminho'];
    unlink($imagem);

    $res1 = mysqli_query($mysqli,"DELETE FROM tbestoque WHERE cod_livro = $cod"); 

    $res2 = mysqli_query($mysqli,"DELETE FROM tblivro WHERE cod = $cod"); 

    mysqli_close($mysqli);
}

function exc_QTDE($cod){
    include('Conexao.php');

    $res = mysqli_query($mysqli,"DELETE FROM tbestoque WHERE cod = $cod"); 

    mysqli_close($mysqli);
}

function cmd($a,$b,$c,$d){
    include('Conexao.php');

    $res = mysqli_query($mysqli,"INSERT INTO tbcomanda(cod_clie, cod_livro, dt_dev, multa) VALUES($a,$b,DATE_ADD(CURRENT_TIMESTAMP(),INTERVAL $c DAY), $d)"); 

    $res2 = mysqli_query($mysqli,"UPDATE tbestoque SET qtde_atual = qtde_atual - 1 WHERE cod_livro = $b");

    $res3 = mysqli_query($mysqli,"UPDATE tbcliente SET qtde_livro = qtde_livro + 1 WHERE cod = $a"); 

    mysqli_close($mysqli);
}

function cmd_dev($a,$b){
    include('Conexao.php');

    $res = mysqli_query($mysqli,"DELETE FROM tbcomanda  WHERE cod_clie = $a && cod_livro = $b"); 

    $res2 = mysqli_query($mysqli,"UPDATE tbestoque SET qtde_atual = qtde_atual + 1 WHERE cod_livro = $b");

    $res3 = mysqli_query($mysqli,"UPDATE tbcliente SET qtde_livro = qtde_livro - 1 WHERE cod = $a"); 

    mysqli_close($mysqli);
}