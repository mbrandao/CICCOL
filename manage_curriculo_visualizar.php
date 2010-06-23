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

/* Faz uma consulta ao banco para pegar o nome e sobrenome do docente */
$SQL = pg_query("SELECT nome, sobrenome FROM Usuario WHERE id_user='$idUsuario'") or die ("A consulta não pode ser realizada!".pg_last_error());

while ($row_nome = pg_fetch_array($SQL)){
    $doc = $row_nome["nome"] . ' '. $row_nome["sobrenome"];
}

$smarty->assign('docente',$doc);

//Pega o perfil profissional do currículo do professor cadastrado no banco
$SQL = pg_query("SELECT perfil_profissional, id_curriculo FROM Curriculo WHERE doc_matricula IN (SELECT identificador FROM Autenticacao WHERE id_user='$idUsuario')") or die("Couldn t execute query".pg_last_error());

while ($row_perfil = pg_fetch_array($SQL)){
     $perfil = $row_perfil["perfil_profissional"];
}

$smarty->assign('perfil',$perfil);

//Pega o último emprego do currículo do professor cadastrado no banco
$SQL = pg_query("SELECT  ultimo_emprego, lattes FROM Curriculo WHERE doc_matricula IN (SELECT identificador FROM Autenticacao WHERE id_user='$idUsuario')") or die("A consulta não pode ser realizada!".pg_last_error());

while ($row = pg_fetch_array($SQL)){
     $ultEmprego = $row["ultimo_emprego"];
     $lattes = $row["lattes"];
}

$smarty->assign('ultEmprego',$ultEmprego);
$smarty->assign('curLattes',$lattes);


/* Faz uma consulta ao banco para pegar o cargo do docente */
$SQL = pg_query("SELECT descricao FROM Cargo WHERE id_cargo IN (SELECT id_cargo_atual FROM Curriculo WHERE doc_matricula IN (SELECT identificador FROM Autenticacao WHERE id_user='$idUsuario'))") or die ("A consulta não pode ser realizada!".pg_last_error());
$rowCargo = pg_fetch_array($SQL);
$descricao = $rowCargo["descricao"];

$smarty->assign('cargo',$descricao);


//Pega a área de interesse do currículo do professor cadastrado no banco
$SQL = pg_query("SELECT descricao, id_interesse FROM AreaInteresse WHERE id_interesse IN (SELECT id_interesse FROM (Curriculo NATURAL JOIN AreaInteresseCurriculo) WHERE doc_matricula IN (SELECT identificador FROM Autenticacao WHERE id_user='$idUsuario'))") or die("A consulta não pode ser realizada!".pg_last_error());

$interesse = array();

while ($row_nome = pg_fetch_array($SQL)){
     array_push($interesse, $row_nome["descricao"]);
}

$descInteresse = "";

for($i=0; $i<sizeof($interesse); $i++)
{
    $descInteresse = $descInteresse . ", " . $interesse[$i];
}

/* Remove a vírgula inicial da string*/
$descInteresse = substr($descInteresse, 1);

$smarty->assign('interesse',$descInteresse);

$smarty->display('curriculo_visualizar.tpl');

?>