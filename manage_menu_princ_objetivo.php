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

//Pega o objetivo cadastrado no banco
$SQL = pg_query("SELECT objetivo FROM InfoCurso") or die("A consulta não pode ser realizada".pg_last_error());

while ($row_objetivo = pg_fetch_array($SQL)){
     $objetivo = $row_objetivo["objetivo"];
}

$smarty->assign('objet', $objetivo);

$smarty->display('menu_princ_objetivo.tpl');

?>