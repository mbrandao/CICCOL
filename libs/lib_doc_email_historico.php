<?php

        header("Content-Type: text/html; charset=UTF-8",true);

        include "dbconfig.php";
        @session_start();

        $page = $_REQUEST['page'];
        $limit = $_REQUEST['rows'];
        $sidx = $_REQUEST['sidx'];
        $sord = $_REQUEST['sord'];

        $idUsuario = $_SESSION['idUsuario'];
               
        if(!$sidx) $sidx =1;

        $result = pg_query("SELECT COUNT(*) AS count FROM Email WHERE doc_matricula IN (SELECT identificador FROM Autenticacao WHERE (id_user=$idUsuario))");
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


        $SQL = "SELECT id, FuncFormataData(dt_envio) AS dt_envio, destinatario, assunto, texto FROM Email WHERE doc_matricula IN (SELECT identificador FROM Autenticacao WHERE (id_user=$idUsuario)) ORDER BY dt_envio ";
        $result = pg_query( $SQL ) or die("Couldn t execute query.".pq_last_error());

              
        if ( stristr($_SERVER["HTTP_ACCEPT"],"application/xhtml+xml") ) {
            header("Content-type: application/xhtml+xml;charset=utf-8"); }
        else {
            header("Content-type: text/xml;charset=utf-8");
        }

        echo "<?xml version='1.0' encoding='utf-8'?>";
        echo "<rows>";
        echo "<page>".$page."</page>";
        echo "<total>".$total_pages."</total>";
        echo "<records>".$count."</records>";

        while($row = pg_fetch_array($result)) {
              echo "<row id='". $row[id]."'>";
              echo "<cell>". $row[dt_envio]."</cell>";
              echo "<cell>". $row[destinatario]."</cell>";
              echo "<cell>". $row[assunto]."</cell>";
              echo "<cell>". $row[texto]."</cell>";
              echo "</row>";
        }
        echo "</rows>";


//Fecha conexão com o banco de dados
pg_close();
?>
