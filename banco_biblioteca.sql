create database biblioteca_mk;
use biblioteca_mk;

create table tbfuncionario(cod int primary key auto_increment,
						   nome varchar(90),
                           fone varchar(11),
                           email varchar(50),
                           periodo char(1),
                           senha varchar(10),
                           perfil int references tbfuncao
                           );

insert into tbfuncionario(nome, fone, email, periodo, senha, perfil) values('Rogério Carlos', '12345678910', 'rogerio@gmail.com', 'T', '12345678', 1);
insert into tbfuncionario(nome, fone, email, periodo, senha, perfil) values('Carlos Rogério', '10987654321', 'carlos@gmail.com', 'M', '12345678', 2);
                           
create table tbcliente(cod int primary key auto_increment,
						nome varchar(90),
                        fone varchar(11),
                        email varchar(50),
                        senha varchar(10),
                        endereco varchar(120),
                        perfil int references tbfuncao,
                        qtde_livro char(1)
                        );
                        
insert into tbcliente(nome, fone, email, senha, endereco, perfil, qtde_livro) values('Roberto Carlos', '11987654321', 'roberto@gmail.com', 12345678, '12345678', 3, 0);
                        
create table tblivro(cod int primary key auto_increment,
						nome varchar(90),
                        autor varchar(90),
                        genero int references tbgenero,
                        editora varchar(90),
                        isbn varchar(30),
                        pagina int,
						caminho varchar(100),
                        dt_cad TIMESTAMP DEFAULT CURRENT_TIMESTAMP
                        );

insert into tblivro (nome, autor, genero, editora, isbn, pagina, caminho) values('It a Coisa', 'Stephen King', 1,'MK', 9780123456786, 200, 'Fotos_Livros/Terror.jpg');
insert into tblivro (nome, autor, genero, editora, isbn, pagina, caminho) values('A volta de Sherlock Holmes', 'Arthur Conan Doyle', 2,'MK', 9780123456781, 200, 'Fotos_Livros/Mistério.jpg');
insert into tblivro (nome, autor, genero, editora, isbn, pagina, caminho) values('O diário do Chaves', 'Roberto Gómez Bolaños', 3,'MK', 9780123456782, 200, 'Fotos_Livros/Comédia.jpg');
insert into tblivro (nome, autor, genero, editora, isbn, pagina, caminho) values('Vem Comigo', 'Karma Brown', 4,'MK', 9780123456783, 200, 'Fotos_Livros/Drama.jpg');
insert into tblivro (nome, autor, genero, editora, isbn, pagina, caminho) values('Todas as suas perfeições', 'Colleen Hoover', 5,'MK', 9780123456784, 200, 'Fotos_Livros/Romance.jpg');
insert into tblivro (nome, autor, genero, editora, isbn, pagina, caminho) values('O feiticeiro de Terramar', 'Ursula K. Le Guin', 6,'MK', 9780123456785, 200, 'Fotos_Livros/Aventura.jpg');
insert into tblivro (nome, autor, genero, editora, isbn, pagina, caminho) values('Tharpe Pusztítása', 'Bernard Cornwell', 7,'MK', 9780123456787, 200, 'Fotos_Livros/Histórico.jpg');
insert into tblivro (nome, autor, genero, editora, isbn, pagina, caminho) values('Mito ou Verdade', 'Flávio Bolsonaro', 8,'MK', 9780123456788, 200, 'Fotos_Livros/Biografia.jpg');
insert into tblivro (nome, autor, genero, editora, isbn, pagina, caminho) values('O livro de Eli', 'Denzel Washington', 9,'MK', 9780123456789, 200, 'Fotos_Livros/Ação.jpg');
insert into tblivro (nome, autor, genero, editora, isbn, pagina, caminho) values('A Cabana', 'Willian P. Young', 10,'MK', 9780123456717, 200, 'Fotos_Livros/Ficção.jpg');

create table tbgenero(cod int primary key,
						genero varchar(20)
                        );
                        
insert into tbgenero values (1, 'Terror');
insert into tbgenero values (2, 'Mistério');
insert into tbgenero values (3, 'Comédia');
insert into tbgenero values (4, 'Drama');
insert into tbgenero values (5, 'Romance');
insert into tbgenero values (6, 'Aventura');
insert into tbgenero values (7, 'Histórico');
insert into tbgenero values (8, 'Biografia');
insert into tbgenero values (9, 'Ação');
insert into tbgenero values (10, 'Ficção');

create table tbfuncao (cod char(2) primary key unique,
					nome varchar(20) not null
                    );
                    
insert into tbfuncao values (1, 'Master');
insert into tbfuncao values (2, 'Funcionário');
insert into tbfuncao values (3, 'Cliente');

create table tbestoque(cod int primary key auto_increment,
					   cod_livro int references tblivro,
                       qtde int,
                       qtde_atual int
                       );
                       
insert into tbestoque(cod_livro,qtde,qtde_atual) values(1, 110, 110);
insert into tbestoque(cod_livro,qtde,qtde_atual) values(2, 120, 120);
insert into tbestoque(cod_livro,qtde,qtde_atual) values(3, 130, 130);
insert into tbestoque(cod_livro,qtde,qtde_atual) values(4, 140, 140);
insert into tbestoque(cod_livro,qtde,qtde_atual) values(5, 150, 150);
insert into tbestoque(cod_livro,qtde,qtde_atual) values(6, 160, 160);
insert into tbestoque(cod_livro,qtde,qtde_atual) values(7, 170, 170);
insert into tbestoque(cod_livro,qtde,qtde_atual) values(8, 180, 180);
insert into tbestoque(cod_livro,qtde,qtde_atual) values(9, 190, 190);
insert into tbestoque(cod_livro,qtde,qtde_atual) values(10, 200, 200);
                       
create table tbcomanda(cod int primary key auto_increment,
					   cod_clie int references tbcliente,
                       cod_livro int references tblivro,
                       dt_saida TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                       dt_dev TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                       multa double(6,2)
                       );
      
select * from tbfuncionario;
select * from tbcliente;
select * from tblivro;
select * from tbestoque;
select * from tbcomanda;