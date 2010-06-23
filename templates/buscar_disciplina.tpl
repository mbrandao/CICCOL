<script type="text/javascript">

// ------------------------------------Grid administrador---------------------------

var lastsel;

$("#list_buscar_disciplina").jqGrid({
    url: "libs/lib_buscar_disciplina.php?reference=busca&action=lista_disciplinas",
    width: 500,
    datatype: "xml",
    loadtext: "Carregando...",
    colNames:['Código', 'Nome','Carga H', 'Créditos','Semestre', 'Docente Atual', 'Tipo'],
    colModel:[
        {name:'buscar_disciplina_codigo',index:'buscar_disciplina_codigo', width:60,align:"center"},
        {name:'buscar_disciplina_nome',index:'buscar_disciplina_nome', width:80,align:"center"},
        {name:'buscar_disciplina_carga_h',index:'buscar_disciplina_carga_h', width:60,align:"center"},
        {name:'buscar_disciplina_cred',index:'buscar_disciplina_cred', width:80,align:"center"},
        {name:'buscar_disciplina_semestre',index:'buscar_disciplina_semestre', width:60,align:"center"},
        {name:'buscar_disciplina_docente',index:'buscar_disciplina_docente', width:80,align:"center"},
        {name:'buscar_disciplina_tipo',index:'buscar_disciplina_tipo', width:60,align:"center"},
        ],
    rowNum:10,
    rowList:[10,20,30],
    pager: '#pager_buscar_disciplina',
    sortname: 'id',
    viewrecords: true,
    sortorder: "desc",
    imgpath: 'themes/steel/images',
    onSelectRow: function(id){
        if(id && id!==lastsel){
            $('#list').restoreRow(lastsel);
            lastsel=id;
        }
    },
    //editurl: "libs/lib_administrador.php?reference=administrador&action=grid_buscar_administrador'",
    caption: "Buscar Disciplina"
})


//-------------------------------------------- Ação sobre o botão OK --------------------------------------

  $('#bt_ok_buscar_disciplina').click(function(){

            //Pega os valores do formulário
            var nome = $("#buscar_disciplina_nome").val();
            var semestre = $("#buscar_disciplina_semestre").val();
            var docente = $("#buscar_disciplina_docente").val();


            //Armazena os valores do formulário na variável dataString
            //var dataString = 'matricula='+ matricula + '&nome=' + nome;
            //alert(dataString);


            //Envia a variável dataString para a lib que insere no banco de dados
           // $.ajax({
            //        type: "GET",
            //        url: "libs/lib_administrador_1.php?reference=administrador&action=busca",
             //       processData: false,
              //      data: dataString,
                    //dataType: "html",
              //      success: function(){
                     //$("#cad_adm").hide();
               //      $("#list_buscar_disciplina").trigger("reloadGrid");
              //      }
              //  });

                $("#list_buscar_disciplina").setGridParam({
                    url: "libs/lib_buscar_disciplina.php?reference=busca&action=busca&nome="+nome+"&semestre="+semestre+"&docente="+docente}).trigger("reloadGrid");
    })



</script>


<p class="heading">Buscar disciplina</p>

<!-- Formulário de cadastro e edição-->
<div id="cad_adm">
    <form class="dialog-form" id="form_buscar_disciplina" >
        <fieldset class="ui-widget ui-widget-content ui-corner-all">
		<legend class="ui-widget ui-widget-header ui-corner-all">Buscar Disciplina</legend>


                    <label>Nome</label>
                    <input type="text" maxlength="30" size="30"  name="buscar_disciplina_nome" id="buscar_disciplina_nome" class="text ui-widget-content ui-corner-all aux" /><br/>

                    <label>Semestre</label>
                    <input type="text" maxlength="1" size="1" name="buscar_disciplina_semestre" id="buscar_disciplina_semestre" class="text ui-widget-content ui-corner-all" /><br/>

                    <label>Profesor Atual</label><br/>
                    <input type="text" size="30" maxlength="30" name="buscar_disciplina_docente" id="buscar_disciplina_docente" class="text ui-widget-content ui-corner-all aux" /><br/><br/>

                   <!-- <input type="text" id="buscar_disciplina_id" name="buscar_disciplina_id" style="display:none;"> -->

                    <div id="dialog-form_button"
                        <input type="button" value="Buscar" id="bt_ok_buscar_disciplina" class="ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only">
                    </div>
        </fieldset>
    </form>
  </div>


 <!--Exibe a Grid-->
<div id="form">
    <table id="list_buscar_disciplina" class="scroll" cellpadding="0" cellspacing="0"> </table>
    <div id="pager_buscar_disciplina" class="scroll" style="text-align:center;"></div>
</div>



