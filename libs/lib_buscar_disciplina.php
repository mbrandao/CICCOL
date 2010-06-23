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
                $request_semestre = trim($_REQUEST['semestre']);
                $request_docente = trim($_REQUEST['docente']);


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

                $sql1="SELECT DI.cod_disciplina, DI.nome, DI.carga_horaria, DI.num_cred, DI.semestre, DI.optativa, U.nome, U.sobrenome
                        FROM disciplina DI JOIN docente D ON DI.doc_matricula = D.matricula
                        JOIN usuario U ON D.id_user = U.id_user WHERE ";

                if($request_docente == NULL)
                    $sql2 ="";
                if($request_docente != NULL){
                        $sql2 ="U.nome ILIKE '%".$request_docente."%' OR U.sobrenome ILIKE '%".$request_docente."%' ";
                }

                if($request_semestre == NULL)
                    $sql3 ="";
                if($request_semestre != NULL){
                    if($request_docente == NULL)
                        $sql3 ="CAST(DI.semestre as varchar(4)) ILIKE '%".$request_semestre."%' ";
                    if($request_docente != NULL)
                        $sql3 ="AND CAST(DI.semestre as varchar(4)) ILIKE '%".$request_semestre."%' ";
                }


                if($request_nome == NULL)
                    $sql4 ="";
                if($request_nome != NULL){
                	if(($request_semestre == NULL) && ($request_docente == NULL))
                    	$sql4 ="DI.nome ILIKE '%".$request_nome."%' ";
                	if(($request_semestre != NULL) || ($request_docente != NULL))
                    	$sql4 ="AND DI.nome ILIKE '%".$request_nome."%' ";
                 }

                $sql_5 = "ORDER BY U.nome";

               //Verifica se está cadastrado na tabela docente
                if(($request_semestre==NULL)&&($request_nome==NULL)&&($request_docente==NULL))
                    $SQL = "SELECT DI.cod_disciplina, DI.nome, DI.carga_horaria, DI.num_cred, DI.semestre, DI.optativa, U.nome, U.sobrenome
                        FROM disciplina DI JOIN docente D ON DI.doc_matricula = D.matricula
                        JOIN usuario U ON D.id_user = U.id_user";
                if(($request_semestre!=NULL)||($request_nome!=NULL)||($request_docente!=NULL))
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

                    $sql_nome_mat = "SELECT nome FROM disciplina WHERE cod_disciplina='$row[cod_disciplina]'";
                    $result_nome_mat = pg_query( $sql_nome_mat ) or die("Couldn t execute query.".pq_last_error());
                    $row_nome_mat = pg_fetch_array($result_nome_mat);

                    echo "<row id='". $row[id_user]."'>";
                    echo "<cell>". $row[cod_disciplina]."</cell>";
                    echo "<cell>". $row_nome_mat[nome]."</cell>";
                    echo "<cell>". $row[carga_horaria]." Horas"."</cell>";
                    echo "<cell>". $row[num_cred]."</cell>";
                    echo "<cell>". $row[semestre]."</cell>";
                    echo "<cell>". $row[nome]." ".$row[sobrenome]."</cell>";
                    if($row[optativa] == 1)
                    echo "<cell>Obrigatória</cell>";
                    if($row[optativa] != 1)
                    echo "<cell>Optativa</cell>";

                        echo "</row>";
                }
                echo "</rows>";

            break;


             case "lista_disciplinas":

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
                $SQL = "SELECT DI.cod_disciplina, DI.nome, DI.carga_horaria, DI.num_cred, DI.semestre, DI.optativa, U.nome, U.sobrenome
                        FROM disciplina DI JOIN docente D ON DI.doc_matricula = D.matricula
                        JOIN usuario U ON D.id_user = U.id_user ORDER BY DI.nome";
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

                    $sql_nome_mat = "SELECT nome FROM disciplina WHERE cod_disciplina='$row[cod_disciplina]'";
                    $result_nome_mat = pg_query( $sql_nome_mat ) or die("Couldn t execute query.".pq_last_error());
                    $row_nome_mat = pg_fetch_array($result_nome_mat);

                    echo "<row id='". $row[id_user]."'>";
                    echo "<cell>". $row[cod_disciplina]."</cell>";
                    echo "<cell>". $row_nome_mat[nome]."</cell>";
                    echo "<cell>". $row[carga_horaria]." Horas"."</cell>";
                    echo "<cell>". $row[num_cred]."</cell>";
                    echo "<cell>". $row[semestre]."</cell>";
                    echo "<cell>". $row[nome]." ".$row[sobrenome]."</cell>";
                    if($row[optativa] == 1)
                    echo "<cell>Obrigatória</cell>";
                    if($row[optativa] != 1)
                    echo "<cell>Optativa</cell>";

                        echo "</row>";
                }
                echo "</rows>";

            break;

        }

        }

//Fecha conexão com o banco de dados
pg_close();
?>
