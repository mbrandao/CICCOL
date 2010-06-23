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
                $request_matricula = trim($_REQUEST['matricula']);
                $request_nome = trim($_REQUEST['nome']);
                $request_ano_ingresso = trim($_REQUEST['ano_ingresso']);

                           
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

                $sql1="SELECT A.matricula, A.semestre, A.semestre_entrada, A.ano_entrada, U.id_user, U.nome, U.sobrenome, U.email
                        FROM aluno A JOIN usuario U ON A.id_user = U.id_user WHERE ";

                if($request_matricula == NULL)
                    $sql2 ="";
                if($request_matricula != NULL)
                    $sql2 ="A.matricula ILIKE '%".$request_matricula."%' ";

                if($request_nome == NULL)
                    $sql3 ="";
                if(($request_nome != NULL) &&($request_matricula == NULL))
                    $sql3 ="U.nome ILIKE '%".$request_nome."%' OR U.sobrenome ILIKE '%".$request_nome."%' ";
                if(($request_nome != NULL) &&($request_matricula != NULL))
                    $sql3 ="AND U.nome ILIKE '%".$request_nome."%' OR U.sobrenome ILIKE '%".$request_nome."%' ";

                if($request_ano_ingresso == NULL)
                    $sql4 ="";
                if(($request_ano_ingresso != NULL) && ($request_matricula == NULL) && ($request_nome == NULL))
                    $sql4 ="CAST(A.ano_entrada as varchar(4)) ILIKE '%".$request_ano_ingresso."%' ";
                if(($request_ano_ingresso != NULL) && ($request_matricula != NULL) || ($request_nome != NULL))
                    $sql4 ="AND CAST(A.ano_entrada as varchar(4)) ILIKE '%".$request_ano_ingresso."%' ";

                $sql_5 = "ORDER BY U.nome";

               //Verifica se está cadastrado na tabela docente
                if(($request_matricula==NULL)&&($request_nome==NULL)&&($request_ano_ingresso==NULL))
                    $SQL = "SELECT A.matricula, A.semestre, A.semestre_entrada, A.ano_entrada, U.id_user, U.nome, U.sobrenome, U.email FROM aluno A JOIN usuario U ON A.id_user = U.id_user ORDER BY U.nome";
                if(($request_matricula!=NULL)||($request_nome!=NULL)||($request_ano_ingresso!=NULL))
                    $SQL = $sql1.$sql2.$sql3.$sql4.$sql_5;

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
                        echo "<cell>". $row[matricula]."</cell>";
                        echo "<cell>". $row[nome]." ".$row[sobrenome]."</cell>";
                        echo "<cell>". $row[ano_entrada].".".$row[semestre_entrada]."</cell>";
                        echo "<cell>". $row[semestre]."º Semestre"."</cell>";
                        echo "<cell>". $row[email]."</cell>";
                        echo "</row>";
                }
                echo "</rows>";

            break;
                
                
             case "lista_alunos":

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
                $SQL = "SELECT A.matricula, A.semestre, A.semestre_entrada, A.ano_entrada, U.id_user, U.nome, U.sobrenome, U.email
                        FROM aluno A JOIN usuario U ON A.id_user = U.id_user ORDER BY U.nome";
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
                        echo "<cell>". $row [matricula]."</cell>";
                        echo "<cell>". $row[nome]." ".$row[sobrenome]."</cell>";
                        echo "<cell>". $row[ano_entrada].".".$row[semestre_entrada]."</cell>";
                        echo "<cell>". $row[semestre]."º Semestre"."</cell>";
                        echo "<cell>". $row[email]."</cell>";
                        echo "</row>";
                }
                echo "</rows>";

            break;
           
        }

        }

//Fecha conexão com o banco de dados
pg_close();
?>
