<?php

header("Content-Type: text/html; charset=UTF-8",true);

include "dbconfig.php";

//recebendo variável da ação
$request_action = trim(strtolower($_REQUEST['action']));
$request_reference = trim(strtolower($_REQUEST['reference']));

switch ($request_reference) {
    case "busca":
        switch ($request_action) {

            case "busca":

                //Recebe as variáveis do datastring
                $request_nome = trim($_REQUEST['nome']);
                $request_interesse = trim($_REQUEST['interesse']);
                $request_disciplina_ministra = trim($_REQUEST['disciplina_ministra']);


                $page = $_REQUEST['page'];
                $limit = $_REQUEST['rows'];
                $sidx = $_REQUEST['sidx'];
                $sord = $_REQUEST['sord'];

                if(!$sidx) $sidx =1;

                $result = pg_query("SELECT COUNT(*) AS count FROM autenticacao WHERE id_tpuser = 1 AND NOT(id_user = 1)");
                $row = pg_fetch_array($result);
                $count = $row['count'];


                if( $count >0 ) {
                        $total_pages = ceil($count/$limit);
                } else {
                        $total_pages = 0;
                }

                if ($page > $total_pages) $page=$total_pages;

                $start = $limit*$page - $limit;
                if($start <0) $start = 0;

                $sql1="SELECT DISTINCT D.matricula, D.id_user, U.nome, U.sobrenome, CU.lattes
                        FROM usuario U NATURAL JOIN docente D
                        JOIN disciplina DI ON  D.matricula = DI.doc_matricula
                        NATURAL JOIN curriculo CU
                        NATURAL JOIN areainteressecurriculo AR
                        NATURAL JOIN areainteresse AI WHERE ";

                if($request_interesse == NULL)
                    $sql2 ="";
                if($request_interesse != NULL)
                    $sql2 ="AI.descricao ILIKE '%".$request_interesse."%' ";

                if($request_nome == NULL)
                    $sql3 ="";
                if(($request_nome != NULL) &&($request_interesse == NULL))
                    $sql3 ="U.nome ILIKE '%".$request_nome."%' OR U.sobrenome ILIKE '%".$request_nome."%' ";
                if(($request_nome != NULL) &&($request_interesse != NULL))
                    $sql3 ="AND U.nome ILIKE '%".$request_nome."%' OR U.sobrenome ILIKE '%".$request_nome."%' ";

                if($request_disciplina_ministra == NULL)
                    $sql4 ="";
                if(($request_disciplina_ministra != NULL) && ($request_interesse == NULL) && ($request_nome == NULL))
                    $sql4 ="DI.nome ILIKE '%".$request_disciplina_ministra."%' ";
                if(($request_disciplina_ministra != NULL) && ($request_interesse != NULL) || ($request_nome != NULL))
                    $sql4 ="AND DI.nome ILIKE '%".$request_disciplina_ministra."%' ";


                $sql_5 = "ORDER BY U.nome";

               //Verifica se está cadastrado na tabela docente
                if(($request_interesse==NULL)&&($request_nome==NULL)&&($request_disciplina_ministra==NULL))
                    $SQL = "SELECT DISTINCT D.matricula, D.id_user, U.nome, U.sobrenome, CU.lattes
                        FROM usuario U NATURAL JOIN docente D
                        JOIN disciplina DI ON  D.matricula = DI.doc_matricula
                        NATURAL JOIN curriculo CU
                        NATURAL JOIN areainteressecurriculo AR
                        NATURAL JOIN areainteresse AI ORDER BY U.nome";
                if(($request_interesse!=NULL)||($request_nome!=NULL)||($request_disciplina_ministra!=NULL))
                    $SQL = $sql1.$sql2.$sql3.$sql4.$sql5;

                $result = pg_query( $SQL ) or die("Couldn t execute query.".pq_last_error());

                if ( stristr($_SERVER["HTTP_ACCEPT"],"application/xhtml+xml") ) {
                        header("Content-type: application/xhtml+xml;charset=utf-8"); }
                else { header("Content-type: text/xml;charset=utf-8");
                }

                        echo "<?xml version='1.0' encoding='utf-8'?>";
                        echo "<rows>";
                        echo "<page>".$page."</page>";
                        echo "<total>".$total_pages."</total>";
                        echo "<records>".$count."</records>";

                while($row = pg_fetch_array($result)) {

                    echo "<row id='". $row[id_user]."'>";


                        echo "<cell>". $row[nome]." ".$row[sobrenome]."</cell>";


                    echo "<cell>";
                    $sql_disciplina =  "SELECT nome FROM disciplina WHERE doc_matricula='$row[matricula]'";
                    $result_disciplina = pg_query( $sql_disciplina ) or die("Couldn t execute query.".pq_last_error());
                    $num_sql_disciplina = pg_num_rows($result_disciplina);
                    while($row_disciplina = pg_fetch_array($result_disciplina)) {
                       echo "$row_disciplina[nome]";
                       if($num_sql_disciplina != 1)
                           echo " - ";
                       $num_sql_disciplina--;
                    }
                    echo "</cell>";


                    echo "<cell>";
                    $sql_interesse =  "SELECT AI.descricao FROM curriculo C Natural JOIN areainteressecurriculo AIC NATURAL JOIN areainteresse AI WHERE C.doc_matricula='$row[matricula]'";
                    $result_interesse = pg_query( $sql_interesse ) or die("Couldn t execute query.".pq_last_error());
                    $num_sql_interesse = pg_num_rows($result_interesse);
                    while($row_interesse = pg_fetch_array($result_interesse)) {
                       echo "$row_interesse[descricao]";
                       if($num_sql_interesse != 1)
                           echo " - ";
                       $num_sql_interesse--;
                    }
                    echo "</cell>";

                    echo "<cell>". $row[lattes]."</cell>";


                        echo "</row>";
                }
                echo "</rows>";

            break;


             case "lista_professores":

                //Recebe as variáveis do datastring
                $request_matricula = trim($_REQUEST['matricula']);

                $request_nome = trim($_REQUEST['nome']);


                $page = $_REQUEST['page'];
                $limit = $_REQUEST['rows'];
                $sidx = $_REQUEST['sidx'];
                $sord = $_REQUEST['sord'];

                if(!$sidx) $sidx =1;

                $result = pg_query("SELECT COUNT(*) AS count FROM autenticacao WHERE id_tpuser = 1 AND NOT(id_user = 1)");
                $row = pg_fetch_array($result);
                $count = $row['count'];


                if( $count >0 ) {
                        $total_pages = ceil($count/$limit);
                } else {
                        $total_pages = 0;
                }

                if ($page > $total_pages) $page=$total_pages;

                $start = $limit*$page - $limit;
                if($start <0) $start = 0;


               //Verifica se está cadastrado na tabela docente
                $SQL = "SELECT DISTINCT D.matricula, D.id_user, U.nome, U.sobrenome, CU.lattes
                        FROM usuario U NATURAL JOIN docente D
                        JOIN disciplina DI ON  D.matricula = DI.doc_matricula
                        NATURAL JOIN curriculo CU
                        NATURAL JOIN areainteressecurriculo AR
                        NATURAL JOIN areainteresse AI ORDER BY U.nome";
                $result = pg_query( $SQL ) or die("Couldn t execute query.".pq_last_error());


                if ( stristr($_SERVER["HTTP_ACCEPT"],"application/xhtml+xml") ) {
                        header("Content-type: application/xhtml+xml;charset=utf-8"); }
                else { header("Content-type: text/xml;charset=utf-8");
                }

                        echo "<?xml version='1.0' encoding='utf-8'?>";
                        echo "<rows>";
                        echo "<page>".$page."</page>";
                        echo "<total>".$total_pages."</total>";
                        echo "<records>".$count."</records>";

                while($row = pg_fetch_array($result)) {

                    echo "<row id='". $row[id_user]."'>";

                    echo "<cell>". $row[nome]." ".$row[sobrenome]."</cell>";

                    echo "<cell>";
                    $sql_disciplina =  "SELECT nome FROM disciplina WHERE doc_matricula='$row[matricula]'";
                    $result_disciplina = pg_query( $sql_disciplina ) or die("Couldn t execute query.".pq_last_error());
                    $num_sql_disciplina = pg_num_rows($result_disciplina);
                    while($row_disciplina = pg_fetch_array($result_disciplina)) {
                       echo "$row_disciplina[nome]";
                       if($num_sql_disciplina != 1)
                           echo " - ";
                       $num_sql_disciplina--;
                    }
                    echo "</cell>";


                    echo "<cell>";
                    $sql_interesse =  "SELECT AI.descricao FROM curriculo C Natural JOIN areainteressecurriculo AIC NATURAL JOIN areainteresse AI WHERE C.doc_matricula='$row[matricula]'";
                    $result_interesse = pg_query( $sql_interesse ) or die("Couldn t execute query.".pq_last_error());
                    $num_sql_interesse = pg_num_rows($result_interesse);
                    while($row_interesse = pg_fetch_array($result_interesse)) {
                       echo "$row_interesse[descricao]";
                       if($num_sql_interesse != 1)
                           echo " - ";
                       $num_sql_interesse--;
                    }
                    echo "</cell>";

                    echo "<cell>". $row[lattes]."</cell>";

                     
                        echo "</row>";
                }
                echo "</rows>";

            break;

        }

        }

//Fecha conexão com o banco de dados
pg_close();
?>
