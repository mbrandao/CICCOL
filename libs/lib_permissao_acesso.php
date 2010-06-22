<?php

include ("dbconfig.php");

$email = trim($_REQUEST['email']);
$matricula = trim($_REQUEST['matricula']);
$senha = trim($_REQUEST['senha']);
$cpf = trim($_REQUEST['cpf']);



// Verifica se ja existe no banco!

$consulta = pg_query("SELECT id_user FROM aluno WHERE matricula = '$matricula'") or die("Erro tabela usuario".pg_last_error());
$saida = pg_fetch_array($consulta);

	if(!$saida[id_user])
	{
            $consulta1 = pg_query("SELECT id_user FROM docente WHERE matricula = '$matricula'") or die("Erro tabela usuario".						    	pg_last_error());
            $saida1 = pg_fetch_array($consulta1);

            if(!$saida1[id_user])
            {
                $consulta2 = pg_query("SELECT id_user FROM adminmoderador WHERE matricula = '$matricula'") or die("Erro tabela 				        	usuario".pg_last_error());
                $saida2 = pg_fetch_array($consulta2);

                if(!$saida2[id_user])
                {
                    $retorno = 0;
                    echo $retorno;
                   }
                else
                {
                    $id_user = $saida2[id_user];
                    $tpuser = '1';
                }
            }
            else
            {
                $id_user = $saida1[id_user];
                $tpuser = 3;
            }
        }
        else
        {
            $id_user = $saida[id_user];
            $tpuser = 4;
        }

       if($id_user){
    
        $atualiza_email = pg_query("UPDATE usuario SET email= '$email' WHERE id_user = '$id_user'") or die ("Erro!".pg_last_error());
        $preenche_dados = pg_query("UPDATE autenticacao SET senha = '$senha' WHERE id_user = '$id_user' ") or die("   >> Erro   ".pg_last_error());
        $retorno =  1;
        echo $retorno;
        
       
        // AQUI VAI ENTRAR O ENVIO DE EMAIL
          $assunto = "Assistência de senha do CICCOL";
	  $mensagem = "<html>";
	  $mensagem .= "<body>";
	  $mensagem .= "<br><br>Para iniciar o processo de redefinição de senha da sua conta do Ciccol Leonardo, clique no link abaixo:</br>";
	  $mensagem .= "<br><br>LINK LINK<br>";
	  $mensagem .= "<br>Se o link não funcionar, copie e cole o URL em uma nova janela do navegador.";
	  $mensagem .= "<br>Caso tenha recebido esse e-mail por engano, provavelmente outro usuário inseriu seu endereço de e-mail ao tentar redefinir uma senha. <br>Caso não tenha feito a solicitação, você não precisa tomar nenhuma ação e pode desconsiderar este e-mail com segurança.";
	  $mensagem .= "<br>Para qualquer dúvida sobre sua conta, entre em contato com o administrador do sistema do seu colegiado.<br>";
	  $mensagem .= "<br>Att,<br>Ciccol.";
          $mensagem .= "</body>";
	  $mensagem .= "</html>";
	  $headers = "MIME-Version: 1.0\r\n";
          $headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
	  $headers .= "From: CICCOL <no-reply@ciccol.com>\r\n";

          mail($email, $assunto, $mensagem, $headers);

        }
     
?>