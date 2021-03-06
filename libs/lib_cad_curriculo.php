<?php

header("Content-Type: text/html; charset=UTF-8",true);

include "dbconfig.php";
@session_start();

//recebendo variável da ação
$request_action = trim(strtolower($_REQUEST['action']));
$request_reference = trim(strtolower($_REQUEST['reference']));

switch ($request_reference)
{
    case "curriculo":
        switch ($request_action)
        {

            case "inserir_curriculo":


                //Recebe as variáveis do datastring
                $request_perfil_profissional = trim(($_REQUEST['perfil_profissional']));
                $request_ultimo_emprego = trim(($_REQUEST['ultimo_emprego']));
                $request_cargo = trim($_REQUEST['cargo']);
                $request_id_curriculo = trim($_REQUEST['id_curriculo']);
                $request_interesse = trim($_REQUEST['interesse']);
                $request_lattes = trim($_REQUEST['lattes']);
                $idUsuario = $_SESSION['idUsuario'];


                //Busca id do cargo
                $SQL_Cargo = ("SELECT id_cargo FROM Cargo WHERE descricao='$request_cargo'");
                $result_cargo = pg_query( $SQL_Cargo ) or die("Não foi possível encontrar o cargo.".pg_last_error());
                $rowCargo = pg_fetch_array($result_cargo);
                $idCargo = $rowCargo[id_cargo];

                //Busca o número de matrícula do Docente
                $SQL_Doc = ("SELECT matricula FROM Docente WHERE matricula IN (SELECT identificador FROM Autenticacao WHERE (id_user=$idUsuario)) ");
                $result_doc = pg_query( $SQL_Doc ) or die("Não foi possível encontrar a matricula do Docente".pg_last_error());
                $rowDoc = pg_fetch_array($result_doc);
                $doc_matricula = $rowDoc[matricula];

                 //Captura a data atual
                 $data = date("d/m/Y");

                //Montar a data no formato DD-MM-AAAA
                 $day = substr($data, 0, 2);
                 $month = substr($data, 3, 2);
                 $year = substr($data, 6, 4);

                 $meses = array("01"=>"Jan", "02"=>"Feb", "03"=>"Mar", "04"=>"Apr", "05"=>"May", "06"=>"June", "07"=>"July", "08"=>"Aug", "09"=>"Sept", "10"=>"Oct", "11"=>"Nov", "12"=>"Dec");

                 $dtCriacao = $day. "-" . $meses[$month]. "-" . $year;


                if($idCargo=="")
                {
                    //Insere no banco
                    $SQL = ("INSERT INTO Curriculo (ultimo_emprego, perfil_profissional, doc_matricula, id_cargo_atual, dt_criacao, lattes) VALUES ('$request_ultimo_emprego', '$request_perfil_profissional', '$doc_matricula', NULL, '$dtCriacao', '$request_lattes')");

                    //Verifica se foi inserido com sucesso
                    $result = pg_query( $SQL ) or die("Não foi possível cadastrar currículo".pg_last_error());
                    
                    echo "Cadastro realizado com sucesso";
                }
                else
                {
                    //Insere no banco
                    $SQL = ("INSERT INTO Curriculo (ultimo_emprego, perfil_profissional, doc_matricula, id_cargo_atual, dt_criacao, lattes) VALUES ('$request_ultimo_emprego', '$request_perfil_profissional', '$doc_matricula', '$idCargo', '$dtCriacao', '$request_lattes')");

                    //Verifica se foi inserido com sucesso
                    $result = pg_query( $SQL ) or die("Não foi possível cadastrar currículo".pg_last_error());

                    echo "Cadastro realizado com sucesso";

                }

                $idInteresse = array();

                //Pegar os ids da área de interesse que veio em uma string e colocar no array
                for($i=0; $i<strlen($request_interesse); $i=$i+2)
                {
                    array_push($idInteresse, $request_interesse[$i]);
                }

                if($idInteresse)
                {
                    //Busca id do curriculo cadastrado
                    $SQL = ("SELECT id_curriculo FROM Curriculo WHERE doc_matricula='$doc_matricula'");
                    $result = pg_query( $SQL ) or die("Não foi possível encontrar o currículo.".pg_last_error());
                    $row = pg_fetch_array($result);
                    $idCurriculo = $row[id_curriculo];

                    //Inserir a área de interesse do docente
                    for($i=0; $i<sizeof($idInteresse); $i++)
                    {
                        $SQL = ("INSERT INTO AreaInteresseCurriculo(id_curriculo, id_interesse) VALUES ('$idCurriculo', '$idInteresse[$i]')");

                        //Verifica se foi atualizado com sucesso
                        $result = pg_query( $SQL ) or die("A área de interesse não pode ser cadastrada".pg_last_error());

                    }
                }
                           
                
            break;


            case "update_curriculo":

                //Recebe as variáveis do datastring
                $request_perfil_profissional = trim(($_REQUEST['perfil_profissional']));
                $request_ultimo_emprego = trim(($_REQUEST['ultimo_emprego']));
                $request_cargo = trim($_REQUEST['cargo']);
                $request_id_curriculo = trim($_REQUEST['id_curriculo']);
                $request_interesse = trim($_REQUEST['interesse']);
                $request_dtCriacao = trim($_REQUEST['dt_criacao']);
                $request_lattes = trim($_REQUEST['lattes']);
                $idUsuario = $_SESSION['idUsuario'];

                $idInteresse = array();

                //Pegar os ids da área de interesse que veio em uma string e colocar no array
                for($i=0; $i<strlen($request_interesse); $i=$i+2)
                {
                    array_push($idInteresse, $request_interesse[$i]);
                }

                if($idInteresse)
                {
                    //Inserir a área de interesse atualizada do docente
                    for($i=0; $i<sizeof($idInteresse); $i++)
                    {
                        $result_areaInteresse = pg_query("SELECT id_interesse FROM AreaInteresseCurriculo WHERE (id_curriculo='$request_id_curriculo' AND id_interesse='$idInteresse[$i]')") or die("Não foi possível consultar a área de interesse.".pg_last_error());
                        $rowInteresse = pg_fetch_array($result_areaInteresse);
                        $id = $rowInteresse[id_interesse];

                        if($id=="")
                        {
                            $SQL = ("INSERT INTO AreaInteresseCurriculo(id_curriculo, id_interesse) VALUES ('$request_id_curriculo', '$idInteresse[$i]')");

                            //Verifica se foi atualizado com sucesso
                            $result = pg_query( $SQL ) or die("A área de interesse não pode ser atualizada".pg_last_error());
                        }

                    }
                  }

                  // Removendo as áreas de interesse que não foram novamente selecionadas
                  $result_Interesse = pg_query("SELECT id_interesse FROM AreaInteresseCurriculo WHERE (id_curriculo='$request_id_curriculo')") or die("Não foi possível consultar a área de interesse.".pg_last_error());
                  while ($rowInter = pg_fetch_array($result_Interesse))
                  {
                            $id = $rowInter["id_interesse"];

                            if(!in_array($id, $idInteresse))
                            {
                                //Remove do banco
                                $SQL = ("DELETE FROM AreaInteresseCurriculo WHERE (id_interesse = '$id')");

                                //Verifica se foi removido com sucesso
                                $result = pg_query( $SQL ) or die("A área de interesse não pode ser removida do currículo".pg_last_error());

                            }

                  }
                


                  //Busca id do cargo
                  $SQL_Cargo = ("SELECT id_cargo FROM Cargo WHERE descricao='$request_cargo'");
                  $result_cargo = pg_query( $SQL_Cargo ) or die("Não foi possível encontrar o cargo.".pg_last_error());
                  $rowCargo = pg_fetch_array($result_cargo);
                  $idCargo = $rowCargo[id_cargo];

                  //Busca o número de matrícula do Docente
                  $SQL_Doc = ("SELECT matricula FROM Docente WHERE matricula IN (SELECT identificador FROM Autenticacao WHERE (id_user=$idUsuario)) ");
                  $result_doc = pg_query( $SQL_Doc ) or die("Não foi possível encontrar a matricula do Docente.".pg_last_error());
                  $rowDoc = pg_fetch_array($result_doc);
                  $doc_matricula = $rowDoc[matricula];

                  //Captura a data atual
                  $data = date("d/m/Y");

                  //Montar a data no formato DD-MM-AAAA
                  $day = substr($data, 0, 2);
                  $month = substr($data, 3, 2);
                  $year = substr($data, 6, 4);

                  $meses = array("01"=>"Jan", "02"=>"Feb", "03"=>"Mar", "04"=>"Apr", "05"=>"May", "06"=>"June", "07"=>"July", "08"=>"Aug", "09"=>"Sept", "10"=>"Oct", "11"=>"Nov", "12"=>"Dec");

                  $dtCriacao = $day. "-" . $meses[$month]. "-" . $year;

                  if($idCargo=="")
                  {
                      //Atualiza no banco
                      $SQL = ("UPDATE Curriculo SET lattes = '$request_lattes', dt_criacao = '$dtCriacao', perfil_profissional = '$request_perfil_profissional', ultimo_emprego = '$request_ultimo_emprego', id_cargo_atual = NULL, doc_matricula = '$doc_matricula' WHERE (id_curriculo = '$request_id_curriculo')");

                      //Verifica se foi atualizado com sucesso
                      $result = pg_query( $SQL ) or die("Erro na atualização dos dados.".pg_last_error());

                      echo "Atualização realizada com sucesso";
                  }
                  else
                  {
                      //Atualiza no banco
                      $SQL = ("UPDATE Curriculo SET lattes = '$request_lattes', dt_criacao = '$dtCriacao', perfil_profissional = '$request_perfil_profissional', ultimo_emprego = '$request_ultimo_emprego', id_cargo_atual = '$idCargo', doc_matricula = '$doc_matricula' WHERE (id_curriculo = '$request_id_curriculo')");

                      //Verifica se foi inserido com sucesso
                      $result = pg_query( $SQL ) or die("Couldn t execute query".pg_last_error());
                       echo "Atualização realizada com sucesso";
                  }
 
            break;


            case "apagar_curriculo":

                  //Recebe as variáveis do datastring
                  $request_id = trim($_REQUEST['id_curriculo']);
                  
                  //Remove do banco
                  $SQLInteresse = ("DELETE FROM AreaInteresseCurriculo WHERE (id_curriculo = $request_id)");

                  //Verifica se foi removido com sucesso
                  $resultInteresse = pg_query( $SQLInteresse ) or die("A área de interesse não pode ser removida".pg_last_error());
                       
                  //Remove do banco
                  $SQL = ("DELETE FROM Curriculo WHERE (id_curriculo = $request_id)");

                  //Verifica se foi removido com sucesso
                  $result = pg_query( $SQL ) or die("O currículo não pode ser removido".pg_last_error());
                
            break;

        }

}

//Fecha conexão com o banco de dados
pg_close();
?>
