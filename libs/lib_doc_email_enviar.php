<?php

        header("Content-Type: text/html; charset=UTF-8",true);

        include ("dbconfig.php");
        @session_start();

        $id_disciplina = trim($_REQUEST['id_disciplina']);
        $assunto = trim($_REQUEST['assunto']);
        $texto = trim($_REQUEST['texto']);
        $idUsuario = $_SESSION['idUsuario'];

        //Buscar o número de matrícula do professor que enviou o email
        $SQL_Doc = ("SELECT matricula FROM Docente WHERE id_user = '$idUsuario' ");
        $result_doc = pg_query( $SQL_Doc ) or die("Não foi possível encontrar a matricula do Docente".pg_last_error());
        $rowDoc = pg_fetch_array($result_doc);
        $doc_matricula = $rowDoc[matricula];

        //Captura a data atual para montar a data de envio do email
        $data = date("d/m/Y");

        //Montar a data no formato DD-MM-AAAA
        $day = substr($data, 0, 2);
        $month = substr($data, 3, 2);
        $year = substr($data, 6, 4);

        $meses = array("01"=>"Jan", "02"=>"Feb", "03"=>"Mar", "04"=>"Apr", "05"=>"May", "06"=>"June", "07"=>"July", "08"=>"Aug", "09"=>"Sept", "10"=>"Oct", "11"=>"Nov", "12"=>"Dec");

        $dtEnvio = $day. "-" . $meses[$month]. "-" . $year;

        //Buscar o nome da disciplina
        $SQL = ("SELECT nome FROM Disciplina WHERE id_disciplina = '$id_disciplina' ");
        $result = pg_query( $SQL) or die("Não foi possível encontrar o nome da disciplina".pg_last_error());
        $row = pg_fetch_array($result);
        $nome = $row[nome];

        $destinatario = "Alunos de ".$nome;

        //Buscar o email do docente
        $SQL = ("SELECT email FROM Usuario WHERE id_user IN (SELECT id_user FROM Docente WHERE matricula IN (SELECT identificador FROM Autenticacao WHERE (id_user=$idUsuario))) ");
        $result = pg_query( $SQL) or die("Não foi possível encontrar o email dos alunos".pg_last_error());
        $row = pg_fetch_array($result);
        $doc_email = $row[email];

        //Cadastrar o email no banco
        $SQL = ("INSERT INTO Email (assunto, texto, remetente, destinatario, dt_envio, doc_matricula) VALUES ('$assunto', '$texto', '$doc_email', '$destinatario', '$dtEnvio', '$doc_matricula')");

        //Verifica se foi inserido com sucesso
        $result = pg_query( $SQL ) or die("Não foi possível cadastrar o email".pg_last_error());


        //Busca o email dos alunos da disciplina
        $SQL = ("SELECT email FROM Usuario WHERE id_user IN (SELECT id_user FROM Aluno WHERE matricula IN (SELECT alu_matricula FROM AlunoDisciplina WHERE nome IN (SELECT nome from Disciplina WHERE id_disciplina='$id_disciplina')))");
        $result = pg_query( $SQL) or die("Não foi possível encontrar o cargo.".pg_last_error());

        while( $row = pg_fetch_array($result) )
        {
                  $headers .= "MIME-Version: 1.0\r\n";
                  $headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
                  $headers .= "From: CICCOL <no-reply@ciccol.com>\r\n";

                  echo $row[email];
                  mail($row[email], $assunto, $texto, $headers);
        }






        // AQUI VAI ENTRAR O ENVIO DE EMAIL
          /*$assunto = "Assistência de senha do CICCOL";
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
	  $headers .= "From: CICCOL <no-reply@ciccol.com>\r\n";*/

        

?>