<?php /* Smarty version 2.6.26, created on 2010-06-06 20:46:29
         compiled from editar_perfil_dados_professor.tpl */ ?>
<script type="text/javascript">

// ------------------------------------Grid professor---------------------------

var lastsel;
$("#list_editar_perfil_dados").jqGrid({
    url:'libs/lib_perfil_professor.php?reference=professor&action=grid_buscar_dados_professor',
    width: 500,
    height: 50,
    datatype: "xml",
    loadtext: "Carregando...",
    colNames:['Matricula','Nome','Sobrenome', 'E-Mail', 'CPF', 'Nasc'],
    colModel:[
        {name:'editar_perfil_dados_matricula',index:'editar_perfil_dados_matricula', width:60,align:"center"},
        {name:'editar_perfil_dados_nome',index:'editar_perfil_dados_nome', width:80,align:"center"},
        {name:'editar_perfil_dados_sobrenome',index:'editar_perfil_dados_sobrenome', width:100, align:"center"},
        {name:'editar_perfil_dados_email',index:'editar_perfil_dados_email', width:100, align:"center"},
        {name:'editar_perfil_dados_cpf',index:'editar_perfil_dados_cpf', width:60, align:"center"},
        {name:'editar_perfil_dados_nascimento',index:'editar_perfil_dados_nascimento', width:60, align:"center"},
    ],
    pgbuttons: false,
    pgtext: false,
    pginput:false,
    pager: '#pager_editar_perfil_dados',
    sortname: 'id',
    sortorder: "desc",
    imgpath: 'themes/steel/images',
    onSelectRow: function(id){
        if(id && id!==lastsel){
            $('#list').restoreRow(lastsel);
            lastsel=id;
        }
    },
     caption: "Meus dados"
})


 //--------------------------------------Ação sobre o botão Editar ----------------------------

    $('#bt_editar_editar_perfil_dados').click(function(){


       //Reseta o formulário
       $('#form_editar_perfil_dados').each(function(){
	        this.reset();
       });


       //Pega o id e armazena em gsr
       var gsr = $("#list_editar_perfil_dados").getGridParam('selrow');
       $("#editar_perfil_dados_id").val(gsr);

       if(gsr){

           //Abre formulário
            $("#cad_adm").show();

           //Pega os valores da grid e coloca no formuário
           $("#list_editar_perfil_dados").GridToForm(gsr,"#form_editar_perfil_dados");

       }else{
           alert("Selecione uma linha!");
       }
    });


//-------------------------------------------- Ação sobre o botão OK --------------------------------------

  $('#bt_ok_editar_perfil_dados').click(function(){

            //Pega os valores do formulário

            var sobrenome = $("#editar_perfil_dados_sobrenome").val();
            var email = $("#editar_perfil_dados_email").val();
            var nascimento = $("#editar_perfil_dados_nascimento").val();
            var id_cad = $("#editar_perfil_dados_id").val();

            //Armazena os valores do formulário na variável dataString
            var dataString = 'sobrenome=' + sobrenome + '&email=' +  email + '&nascimento=' + nascimento + '&cad_id=' + id_cad;

                       //Envia a variável dataString para a lib que insere no banco de dados
            $.ajax({
                    type: "GET",
                    url: "libs/lib_perfil_professor.php?reference=professor&action=update_dados_professor",
                    processData: false,
                    data: dataString,
                    //dataType: "html",
                    success: function(){
                     $("#cad_adm").hide();
                     $("#list_editar_perfil_dados").trigger("reloadGrid");
                    }
                });

    })

//------------------------------------ Ação sobre o botão Cancelar ----------------------

$('#bt_cancelar_editar_perfil_dados').click(function(){
    //Esconde formulário
    $("#cad_adm").hide();

})


//--------------------------------------Máscaras---------------------------------------------------


$("#editar_perfil_dados_nascimento").mask("99/99/9999",{placeholder:" "});
</script>


<p class="heading">Alterar Dados</p>

<!-- Botões-->
<div id="button">
        <ul class="icons ui-widget">
           
             <!-- Botão Editar -->
	    <li id="bt_editar_editar_perfil_dados" onClick="" class="ui-state-default ui-corner-all" title="Editar">
	         <span class="ui-icon ui-icon-pencil"></span>
	         <span>Editar</span>
	    </li>
        </ul>
</div>


<!-- Formulário de cadastro e edição-->
<div id="cad_adm" style="display:none;">
    <form class="dialog-form" id="form_editar_perfil_dados" >
        <fieldset class="ui-widget ui-widget-content ui-corner-all">
		<legend class="ui-widget ui-widget-header ui-corner-all">Editar</legend>


                    <label>Matrícula</label>
                    <input type="text" maxlength="9" size="9" name="editar_perfil_dados_matricula" id="editar_perfil_dados_matricula" readonly="readonly" class="text ui-widget-content ui-corner-all readonly" /><br/>
                    
                    <label>CPF</label>
                    <input type="text" maxlength="11" size="11" name="editar_perfil_dados_cpf" id="editar_perfil_dados_cpf" readonly="readonly" class="text ui-widget-content ui-corner-all readonly" /><br/>

                    <label>Nome</label>
                    <input type="text" size="30"  name="editar_perfil_dados_nome" id="editar_perfil_dados_nome" readonly="readonly" readonly="readonly" class="text ui-widget-content ui-corner-all readonly" /><br/>

                    <label>Sobrenome</label>
                    <input type="text" size="30" name="editar_perfil_dados_sobrenome" id="editar_perfil_dados_sobrenome" class="text ui-widget-content ui-corner-all" /><br/>

                    <label>E-mail</label>
                    <input type="text"  size="30" name="editar_perfil_dados_email" id="editar_perfil_dados_email" class="text ui-widget-content ui-corner-all" /><br/>

                    <label>Nascimento</label>
                    <input type="text" size="10" name="editar_perfil_dados_nascimento" id="editar_perfil_dados_nascimento" class="text ui-widget-content ui-corner-all" /><br/>

                    <input type="text" id="editar_perfil_dados_id" name="editar_perfil_dados_id" style="display:none;">

                    <div id="dialog-form_button"
                        <input type="button" value="OK" id="bt_ok_editar_perfil_dados" class="ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only">
                        <input type="button" value="Cancelar" id="bt_cancelar_editar_perfil_dados" class="ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only">
                    </div>
        </fieldset>
    </form>
  </div>


 <!--Exibe a Grid-->
<div id="form">
    <table id="list_editar_perfil_dados" class="scroll" cellpadding="0" cellspacing="0"> </table>
    <div id="pager_editar_perfil_dados" class="scroll" style="text-align:center;"></div>
</div>


