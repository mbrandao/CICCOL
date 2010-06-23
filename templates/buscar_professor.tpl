<script type="text/javascript">

// ------------------------------------Grid administrador---------------------------

var lastsel;

$("#list_buscar_professor").jqGrid({
    url: "libs/lib_buscar_professor.php?reference=busca&action=lista_professores",
    width: 500,
    datatype: "xml",
    loadtext: "Carregando...",
    colNames:['Nome','Disciplinas que Ministra', 'Áreas de interesse','Lattes'],
    colModel:[
        {name:'buscar_professor_nome',index:'buscar_professor_nome', width:80,align:"center"},
        {name:'buscar_professor_disciplina_ministra',index:'buscar_professor_disciplina_ministra', width:60,align:"center"},
        {name:'buscar_professor_interesse',index:'buscar_professor_interesse', width:80,align:"center"},
        {name:'buscar_professor_lattes',index:'buscar_professor_lattes', width:60,align:"center", formatter:'link'},
        ],
    rowNum:10,
    rowList:[10,20,30],
    pager: '#pager_buscar_professor',
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
    caption: "Buscar Professor"
})


//-------------------------------------------- Ação sobre o botão OK --------------------------------------

  $('#bt_ok_buscar_professor').click(function(){

            //Pega os valores do formulário
            var interesse = $("#buscar_professor_interesse").val();
            var nome = $("#buscar_professor_nome").val();
            var disciplina_ministra = $("#buscar_professor_disciplina_ministra").val();


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
               //      $("#list_buscar_professor").trigger("reloadGrid");
              //      }
              //  });

                $("#list_buscar_professor").setGridParam({
                    url: "libs/lib_buscar_professor.php?reference=busca&action=busca&nome="+nome+"&interesse="+interesse+"&disciplina_ministra="+disciplina_ministra}).trigger("reloadGrid");
    })



</script>


<p class="heading">Buscar Professor</p>

<!-- Formulário de cadastro e edição-->
<div id="cad_adm">
    <form class="dialog-form" id="form_buscar_professor" >
        <fieldset class="ui-widget ui-widget-content ui-corner-all">
		<legend class="ui-widget ui-widget-header ui-corner-all">Buscar professor</legend>


                    <label>Nome</label>
                    <input type="text" maxlength="30" size="30"  name="buscar_professor_nome" id="buscar_professor_nome" class="text ui-widget-content ui-corner-all aux" /><br/>

                    <label>Área de Interesse</label><br/>
                    <input type="text" maxlength="30" size="30" name="buscar_professor_interesse" id="buscar_professor_interesse" class="text ui-widget-content ui-corner-all" /><br/>

                    <label>Matéria que Ministra</label><br/>
                    <input type="text" size="30" maxlength="30" name="buscar_professor_disciplina_ministra" id="buscar_professor_disciplina_ministra" class="text ui-widget-content ui-corner-all aux" /><br/><br/>

                   <!-- <input type="text" id="buscar_professor_id" name="buscar_professor_id" style="display:none;"> -->

                    <div id="dialog-form_button"
                        <input type="button" value="Buscar" id="bt_ok_buscar_professor" class="ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only">
                    </div>
        </fieldset>
    </form>
  </div>


 <!--Exibe a Grid-->
<div id="form">
    <table id="list_buscar_professor" class="scroll" cellpadding="0" cellspacing="0"> </table>
    <div id="pager_buscar_professor" class="scroll" style="text-align:center;"></div>
</div>



