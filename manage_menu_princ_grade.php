<?php
header("Content-Type: text/html; charset=utf-8",true);
require_once 'libs/Smarty.class.php';
require_once 'head_1.php';
require_once 'head_dialog.php';
include('libs/dbconfig.php');


$smarty = new Smarty();

$smarty->template_dir = 'templates/';
$smarty->compile_dir = 'templates_c/';
$smarty->left_delimiter = '<!--{';
$smarty->right_delimiter = '}-->';

$smarty->compile_check = true;
$smarty->debugging = false;


//Pega a lista as grades cadastradas no banco
$SQL = pg_query("SELECT id_grade, FuncFormataData(dt_implantacao) AS data FROM GradeCurricular ORDER BY dt_implantacao DESC") or die("Couldn t execute query".pg_last_error());

$aux = 0;

while ($row = pg_fetch_array($SQL)){

    /* Montar o ano de início e término da Grade Acadêmica */
    if ($aux == 0)
    {
        $periodo = '';
        $year = substr($row["data"], 6, 4);
    }
    else
    {
        $periodo = " - ".($year-1);
        $year = substr($row["data"], 6, 4);
    }

    $idGrade[] = array("id"=>$row["id_grade"]);

    $intervalo = $year.$periodo;

     $grade[$aux] = $intervalo;
     $aux = $aux + 1;
}


$smarty->assign('grade', $grade);
$smarty->assign('idGrade', $idGrade);

$smarty->display('menu_princ_grade.tpl');

?>