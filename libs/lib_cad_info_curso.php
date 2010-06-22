<?php

header("Content-Type: text/html; charset=UTF-8",true);

include "dbconfig.php";
@session_start();

//recebendo variável da ação
$request_action = trim(strtolower($_REQUEST['action']));
$request_reference = trim(strtolower($_REQUEST['reference']));

switch ($request_reference)
{
    case "info_curso":
        switch ($request_action)
        {

            case "inserir_info_curso":

                //Recebe as variáveis do datastring
                $request_objetivo = trim($_REQUEST['objetivo']);
                $request_atuacao = trim($_REQUEST['area_atuacao']);
                $idUsuario = $_SESSION['idUsuario'];

                //Buscar a matrícula do administrador e/ou moderador
                $SQL = ("SELECT matricula FROM AdminModerador NATURAL JOIN Usuario WHERE cpf IN (SELECT identificador FROM Autenticacao WHERE id_user=$idUsuario) ");
                $result = pg_query( $SQL ) or die("Não foi possível encontrar a matricula".pg_last_error());
                $row = pg_fetch_array($result);
                $adminmod_matricula = $row[matricula];

                $data = date("d/m/Y");

                //Montar a data no formato DD-MM-AAAA
                 $day = substr($data, 0, 2);
                 $month = substr($data, 3, 2);
                 $year = substr($data, 6, 4);

                 $meses = array("01"=>"Jan", "02"=>"Feb", "03"=>"Mar", "04"=>"Apr", "05"=>"May", "06"=>"June", "07"=>"July", "08"=>"Aug", "09"=>"Sept", "10"=>"Oct", "11"=>"Nov", "12"=>"Dec");

                 $dtCriacao = $day. "-" . $meses[$month]. "-" . $year;

                //Insere no banco
                $SQL1 = ("INSERT INTO InfoCurso (objetivo, area_atuacao, dt_criacao, admmod_matricula) VALUES ('$request_objetivo', '$request_atuacao', '$dtCriacao', '$adminmod_matricula')");

                //Verifica se foi inserido com sucesso
                $result1 = pg_query( $SQL1 ) or die("A informação do curso não pode ser inserida!".pg_last_error());
                echo "Cadastro Efetuado com sucesso!!";
                
            break;


            case "update_info_curso":

                //Recebe as variáveis do datastring
                $request_objetivo = trim($_REQUEST['objetivo']);
                $request_atuacao = trim($_REQUEST['area_atuacao']);
                $request_dtCriacao = trim($_REQUEST['dt_criacao']);
                $idUsuario = $_SESSION['idUsuario'];

                //Buscar a matrícula do administrador e/ou moderador
                $SQL = ("SELECT matricula FROM AdminModerador NATURAL JOIN Usuario WHERE cpf IN (SELECT identificador FROM Autenticacao WHERE id_user=$idUsuario) ");
                $result = pg_query( $SQL ) or die("Não foi possível encontrar a matricula".pg_last_error());
                $row = pg_fetch_array($result);
                $adminmod_matricula = $row[matricula];

                 $data = date("d/m/Y");

                //Montar a data no formato DD-MM-AAAA
                 $day = substr($data, 0, 2);
                 $month = substr($data, 3, 2);
                 $year = substr($data, 6, 4);

                 $meses = array("01"=>"Jan", "02"=>"Feb", "03"=>"Mar", "04"=>"Apr", "05"=>"May", "06"=>"June", "07"=>"July", "08"=>"Aug", "09"=>"Sept", "10"=>"Oct", "11"=>"Nov", "12"=>"Dec");

                 $dtCriacao = $day. "-" . $meses[$month]. "-" . $year;

                //Atualiza no banco
                $SQL = ("UPDATE InfoCurso SET dt_criacao = '$dtCriacao', admmod_matricula = '$adminmod_matricula' ,objetivo = '$request_objetivo', area_atuacao = '$request_atuacao' WHERE (dt_criacao = '$request_dtCriacao')");

                //Verifica se foi inserido com sucesso
                $result = pg_query( $SQL ) or die("Erro na atualização da Informação do Curso".pg_last_error());
                echo "Atualização Efetuada com sucesso!!";
            break;


            case "apagar_info_curso":

                //Recebe as variáveis do datastring
                $request_dtCriacao = trim($_REQUEST['dt_criacao']);

                //Insere no bano
                $SQL = ("DELETE FROM InfoCurso WHERE (dt_criacao = '$request_dtCriacao')");

                //Verifica se foi removido com sucesso
                $result = pg_query( $SQL ) or die("Informação do Curso não pode ser removida!".pg_last_error());

            break;

        }

}

//Fecha conexão com o banco de dados
pg_close();
?>
