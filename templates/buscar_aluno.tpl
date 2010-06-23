<script type="text/javascript">

// ------------------------------------Grid administrador---------------------------

var lastsel;

$("#list_buscar_aluno").jqGrid({
    url: "libs/lib_buscar_aluno.php?reference=busca&action=lista_alunos",
    width: 500,
    datatype: "xml",
    loadtext: "Carregando...",
    colNames:['Matricula','Nome', 'Ano.Sem Entrada','Sem. Atual', 'Email'],
    colModel:[
        {name:'buscar_aluno_matricula',index:'buscar_aluno_matricula', width:60,align:"center"},
        {name:'buscar_aluno_nome',index:'buscar_aluno_nome', width:80,align:"center"},
        {name:'buscar_aluno_ano_sem_ent',index:'buscar_aluno_ano_sem_ent', width:60,align:"center"},
        {name:'buscar_aluno_sem_atual',index:'buscar_aluno_sem_atual', width:80,align:"center"},
        {name:'buscar_aluno_email',index:'buscar_aluno_email', width:60,align:"center"},
        ],
    rowNum:10,
    rowList:[10,20,30],
    pager: '#pager_buscar_aluno',
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
    caption: "Buscar Aluno"
})


//-------------------------------------------- Ação sobre o botão OK --------------------------------------

  $('#bt_ok_buscar_aluno').click(function(){

            //Pega os valores do formulário
            var matricula = $("#buscar_aluno_matricula").val();
            var nome = $("#buscar_aluno_nome").val();
            var ano_ingresso = $("#buscar_aluno_ano_ingresso").val();


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
               //      $("#list_buscar_aluno").trigger("reloadGrid");
              //      }
              //  });

                $("#list_buscar_aluno").setGridParam({
                    url: "libs/lib_buscar_aluno.php?reference=busca&action=busca&nome="+nome+"&matricula="+matricula+"&ano_ingresso="+ano_ingresso}).trigger("reloadGrid");
    })



</script>


<p class="heading">Buscar Aluno</p>

<!-- Formulário de cadastro e edição-->
<div id="cad_adm">
    <form class="dialog-form" id="form_buscar_aluno" >
        <fieldset class="ui-widget ui-widget-content ui-corner-all">
		<legend class="ui-widget ui-widget-header ui-corner-all">Buscar Aluno</legend>


                    <label>Matrícula</label>
                    <input type="text" maxlength="9" size="9" name="buscar_aluno_matricula" id="buscar_aluno_matricula" class="text ui-widget-content ui-corner-all" /><br/>


                    <label>Nome</label>
                    <input type="text" maxlength="30" size="30"  name="buscar_aluno_nome" id="buscar_aluno_nome" class="text ui-widget-content ui-corner-all aux" /><br/>

                    <label>Ano de Ingresso</label>
                    <input type="text" size="4" maxlength="4" name="buscar_aluno_ano_ingresso" id="buscar_aluno_ano_ingresso" class="text ui-widget-content ui-corner-all aux" /><br/><br/>

                   <!-- <input type="text" id="buscar_aluno_id" name="buscar_aluno_id" style="display:none;"> -->

                    <div id="dialog-form_button"
                        <input type="button" value="Buscar" id="bt_ok_buscar_aluno" class="ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only">
                    </div>
        </fieldset>
    </form>
  </div>


 <!--Exibe a Grid-->
<div id="form">
    <table id="list_buscar_aluno" class="scroll" cellpadding="0" cellspacing="0"> </table>
    <div id="pager_buscar_aluno" class="scroll" style="text-align:center;"></div>
</div>



