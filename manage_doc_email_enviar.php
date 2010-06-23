<?php

header("Content-Type: text/html; charset=utf-8",true);
require_once 'libs/Smarty.class.php';
require_once 'head_1.php';
include ("libs/dbconfig.php");
@session_start();

$smarty = new Smarty();

$smarty->template_dir = 'templates/';
$smarty->compile_dir = 'templates_c/';
$smarty->left_delimiter = '<!--{';
$smarty->right_delimiter = '}-->';

$smarty->compile_check = true;
$smarty->debugging = false;

$idUsuario = $_SESSION['idUsuario'];

//Pega a lista as disciplinas ministradas pelo professor
$SQL = pg_query("SELECT nome, id_disciplina FROM Disciplina WHERE doc_matricula IN (SELECT identificador FROM Autenticacao WHERE (id_user='$idUsuario'))") or die("A consulta não pode ser realizada!".pg_last_error());


while ($row = pg_fetch_array($SQL)){
     $disciplina[] = array("disciplina"=>$row["nome"], "id"=>$row["id_disciplina"]);
}

$smarty->assign('disciplina',$disciplina);


$smarty->display('doc_email_enviar.tpl');

?>