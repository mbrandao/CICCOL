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

//Pega o perfil profissional do currículo do professor cadastrado no banco
$SQL = pg_query("SELECT perfil_profissional, id_curriculo FROM Curriculo WHERE doc_matricula IN (SELECT identificador FROM Autenticacao WHERE (id_user='$idUsuario'))") or die("Couldn t execute query".pg_last_error());

while ($row_perfil = pg_fetch_array($SQL)){
     $perfil = $row_perfil["perfil_profissional"];
}

$smarty->assign('perfil',$perfil);

//Pega o último emprego do currículo do professor cadastrado no banco
$SQL = pg_query("SELECT  ultimo_emprego, id_curriculo FROM Curriculo WHERE doc_matricula IN (SELECT identificador FROM Autenticacao WHERE (id_user='$idUsuario'))") or die("Couldn t execute query".pg_last_error());

while ($row_ult_emprego = pg_fetch_array($SQL)){
     $ultEmprego = $row_ult_emprego["ultimo_emprego"];
}

$smarty->assign('ultEmprego',$ultEmprego);

//Pega o id do currículo do professor cadastrado no banco
$SQL = pg_query("SELECT  id_curriculo, dt_criacao, lattes FROM Curriculo WHERE doc_matricula IN (SELECT identificador FROM Autenticacao WHERE (id_user='$idUsuario'))") or die("Couldn t execute query".pg_last_error());

while ($row_id = pg_fetch_array($SQL)){
     $idCurriculo = $row_id["id_curriculo"];
     $dtCriacao = $row_id["dt_criacao"];
     $lattes = $row_id["lattes"];
}

$smarty->assign('dtCriacao', $dtCriacao);
$smarty->assign('idCurriculo',$idCurriculo);
$smarty->assign('curLattes',$lattes);

$SQL = pg_query("SELECT descricao FROM cargo WHERE id_cargo IN (SELECT id_cargo_atual FROM Curriculo WHERE doc_matricula IN (SELECT identificador FROM Autenticacao WHERE (id_user='$idUsuario')))");
while ($row = pg_fetch_array($SQL)){
     $descCargo = $row["descricao"];
}

$smarty->assign('descCargo', $descCargo);

//Pega a lista dos cargos cadastrados no banco
$SQL_Cargo = pg_query("SELECT id_cargo, descricao FROM Cargo WHERE (descricao<>'$descCargo') ORDER BY descricao") or die("A consulta não pode ser realizada!".pg_last_error());


while ($row_nome = pg_fetch_array($SQL_Cargo)){
     $cargo[] = array("cargo"=>$row_nome["descricao"], "id"=>$row_nome["id_cargo"]);
}

$smarty->assign('cargo',$cargo);

//Pega as áreas de interesse
$SQL_Interesse = pg_query("SELECT descricao, id_interesse from AreaInteresse ORDER BY descricao") or die("A consulta não pode ser realizada!".pg_last_error());
while ($row_nome = pg_fetch_array($SQL_Interesse)){
     $interesse[] = array("interesse"=>$row_nome["descricao"], "id"=>$row_nome["id_interesse"]);
}

$smarty->assign('interesse',$interesse);


//Pega a data de criação cadastrada no banco
$SQL = pg_query("SELECT FuncFormataData(dt_criacao) AS data FROM Curriculo WHERE doc_matricula IN (SELECT identificador FROM Autenticacao WHERE (id_user='$idUsuario'))") or die("A consulta não pode ser realizada".pg_last_error());

while ($row = pg_fetch_array($SQL)){
     $dtCriacao = $row["data"];
}

if(!($dtCriacao==""))
{
    $dtAtualizacao = "Última atualização em:" ." ". $dtCriacao;
}

$smarty->assign('dtAtualizacao', $dtAtualizacao);

$smarty->display('cad_curriculo.tpl');

?>