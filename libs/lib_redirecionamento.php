<?php

include ("dbconfig.php");
include("lib_valida_sessao.php");

$iden = $_REQUEST['login'];


$consulta = pg_query("SELECT id_tpuser, id_user FROM autenticacao WHERE identificador = '$iden'") or die("Erro tabela usuario".pg_last_error());
$saida = pg_fetch_array($consulta);



// dependendo do valor de tp_user ele vai encaminhar o usuário para a página correta!
if( ($saida[id_tpuser]=='1') && ($saida[id_user] == '1') )
    echo "root";

elseif($saida[id_tpuser]=='1')
    echo "1";

elseif($saida[id_tpuser]=='2')
    echo "2";

elseif($saida[id_tpuser]=='3')
    echo "3";
 
elseif($saida[id_tpuser]=='4')
    echo "4";

?>