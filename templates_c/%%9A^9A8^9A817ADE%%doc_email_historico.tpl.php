<?php /* Smarty version 2.6.26, created on 2010-06-22 22:58:22
         compiled from doc_email_historico.tpl */ ?>
<script type="text/javascript">

// ------------------------------------Grid Histórico de Email---------------------------

jQuery("#list_doc_email_historico").jqGrid({
    url:'libs/lib_doc_email_historico.php',
    width: 540,
    height:190,
    datatype: "xml",
    colNames:['Data de Envio', 'Destinatario', 'Assunto', 'Mensagem'],
    colModel:[
        {name:'dt_envio',index:'dt_envio', width:95,sortable:false,align:"center"},
        {name:'destinatario',index:'destinatario', width:300,sortable:false,align:"center"},
        {name:'assunto',index:'assunto', width:250,sortable:false,align:"center"},
        {name:'texto',index:'texto', width:600,sortable:false,align:"center"}

    ],
    rowNum:10,
    rowList:[10,20,30],
    scrollOffset: true,
    shrinkToFit:false,
    pager: '#pager_email_historico',
    sortname: '',
    viewrecords: true,
    sortorder: "desc",
    imgpath: 'themes/steel/images',
    caption: "Emails Enviados"
});

</script>


<p class="heading">Histórico de Emails Enviados</p>


 <!--Exibe a Grid-->
<div id="form">
    <table id="list_doc_email_historico" class="scroll" cellpadding="0" cellspacing="0"> </table>
    <div id="pager_email_historico" class="scroll" style="text-align:center;"></div>
</div>


