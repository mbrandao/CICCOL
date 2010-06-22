<?php

include ("dbconfig.php");

$login = trim($_REQUEST['login']);
$senha = trim($_REQUEST['senha']);

// Verifica se já existe no banco!

$consulta = pg_query("SELECT identificador, id_user FROM autenticacao WHERE identificador = '$login' AND senha = '$senha'") or die("Erro tabela usuario".pg_last_error());
$saida = pg_fetch_array($consulta);

if($saida)
    {
          
        session_start();

   	$_SESSION['login'] = $login;
   	$_SESSION['senha'] = $senha;
        $_SESSION['idUsuario'] = $saida['id_user'];
        
   	header("Location:lib_redirecionamento.php?login=$login"); // Essa é a pagina para a qual será enviada o usuário que foi
    
    }
else
    {
        echo "0";
    }


?>