<?php
require_once("config.php");

//Carrega um usuário
/*
$root=new Usuario();

$root->loadById(2);

echo $root;
*/
//Carrega uma lista de usuários

//o método é estático
/*
$lista= Usuario::getList();
echo json_encode($lista);
*/

//carrega uma lista de usuários buscando pelo login
/*
$search=Usuario::search("u");
echo json_encode($search);
*/

//carrega um usuario usuando o login e a senha
/*
$usuario=new Usuario();
$usuario->login("root","12345");
echo json_encode($usuario);
*/
//inserindo dados no banco de dados
/*
$aluno=new Usuario();
$aluno->setDeslogin("Alexandre");
$aluno->setDesenha("Taissaduzentos5");

$aluno->insert();
echo $aluno;
*/

//Atualizando dados no banco de dados
/*
$usuario=new Usuario();
$usuario->loadById(5);
$usuario=new Usuario();
$usuario->update("Almeida","creare553b85");
echo $usuario;
*/
$usuario=new Usuario();
$usuario->loadById(2);
$usuario->delete();
echo $usuario;








/*
$sql=new sql();

$usuarios=$sql->select("SELECT * FROM tb_usuarios ");

var_dump($usuarios);
*/

?>