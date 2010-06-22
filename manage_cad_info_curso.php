<?php
header("Content-Type: text/html; charset=utf-8",true);
require_once 'libs/Smarty.class.php';
require_once 'head_1.php';
include ("libs/dbconfig.php");

$smarty = new Smarty();

$smarty->template_dir = 'templates/';
$smarty->compile_dir = 'templates_c/';
$smarty->left_delimiter = '<!--{';
$smarty->right_delimiter = '}-->';

$smarty->compile_check = true;
$smarty->debugging = false;

//Pega o objetivo, a área de atuação e a data de criação cadastrados no banco
$SQL = pg_query("SELECT objetivo, area_atuacao, dt_criacao FROM InfoCurso") or die("A consulta não pode ser realizada".pg_last_error());

while ($row = pg_fetch_array($SQL)){
     $objetivo = $row["objetivo"];
     $areaAtuacao = $row["area_atuacao"];
     $dtCriacao = $row["dt_criacao"];
}

$smarty->assign('objet', $objetivo);

$smarty->assign('atuacao', $areaAtuacao);

$smarty->assign('dtCriacao', $dtCriacao);

//Pega a data de criação cadastrada no banco
$SQL = pg_query("SELECT FuncFormataData(dt_criacao) AS data FROM InfoCurso") or die("A consulta não pode ser realizada".pg_last_error());

while ($row = pg_fetch_array($SQL)){
     $dtCriacao = $row["data"];
}



if(!($dtCriacao==""))
{
    $dtAtualizacao = "Última atualização em:" ." ". $dtCriacao;
}

$smarty->assign('dtAtualizacao', $dtAtualizacao);

$smarty->display('cad_info_curso.tpl');

?>
