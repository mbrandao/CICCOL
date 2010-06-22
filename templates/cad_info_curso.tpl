<script type="text/javascript" charset="ISO-8859-1">
    //-------------------------------------------- Ação sobre o botão OK --------------------------------------

  $('#bt_ok_cad_info_curso').click(function(){

            //Pega os valores do formulário
            var objetivo = $("#cad_objetivo").val();
            var atuacao = $("#cad_atuacao").val();
            var dt_criacao = $("#cad_info_dt_criacao").val();


            //Armazena os valores do formulário na variável dataString
           var dataString = 'objetivo=' + objetivo + '&area_atuacao=' + atuacao + '&dt_criacao=' + dt_criacao;


            //Defique qual action será passada na url
            if (dt_criacao=="")
                var opcao= 'inserir_info_curso';
            else
                var opcao='update_info_curso';

            //Envia a variável dataString para a lib que insere no banco de dados
            $.ajax({
                    type: "GET",
                    url: "libs/lib_cad_info_curso.php?reference=info_curso&action="+ opcao,
                    processData: false,
                    data: dataString,
                    //dataType: "html",
                    success: function(){
                      if(opcao=='inserir_info_curso')
                          alert("Informação do curso cadastrada com sucesso!");
                      else
                          alert("Informação do curso atualizada com sucesso!");
                    }
                });

    })

//------------------------------------ Ação sobre o botão Limpar ----------------------

$('#bt_limpar_info_curso').click(function(){

    var dt_criacao = $("#cad_info_dt_criacao").val();

    if (dt_criacao=="")
    {
        //Limpa o formulário
        $('#form_cad_info_curso').each(function(){
                    this.reset();
        });
    }
    else
    {
        //Armazena os valores do formulário na variável dataString
        var dataString = 'dt_criacao=' + dt_criacao;

        var opcao='apagar_info_curso';

        //Envia a variável dataString para a lib que insere no banco de dados
            $.ajax({
                    type: "GET",
                    url: "libs/lib_cad_info_curso.php?reference=info_curso&action="+ opcao,
                    processData: false,
                    data: dataString,
                    //dataType: "html",
                    success: function(){
                       alert("Informações do curso removidas com sucesso!");
                       $("#cad_objetivo").val("");
                       $("#cad_atuacao").val("");
                       $("#cad_info_dt_criacao").val("");
                    }
             });
    }

})

</script>


<p class="heading">Cadastro das Informações do Curso</p>

<!-- Formulário de cadastro e edição -->
<div id="cad_info">
    <form class="dialog-form" id="form_cad_info_curso" >
        <fieldset class="ui-widget ui-widget-content ui-corner-all">
		<legend class="ui-widget ui-widget-header ui-corner-all">Informações do Curso</legend>
                    <p><!--{$dtAtualizacao}--></p><br/>
                    <label>Objetivo</label>
                    <TEXTAREA type="text" name="cad_objetivo" id="cad_objetivo" class="text ui-widget-content ui-corner-all" COLS="40" ROWS="8"><!--{$objet}--></TEXTAREA><br/><br/>

                    <label>Área de Atuação</label>
                    <TEXTAREA type="text" name="cad_atuacao" id="cad_atuacao" class="text ui-widget-content ui-corner-all" COLS="40" ROWS="8"><!--{$atuacao}--></TEXTAREA><br/><br/>

                    <input type="text" size="10" name="cad_info_dt_criacao" id="cad_info_dt_criacao" value="<!--{$dtCriacao}-->" style="display:none;" /><br/>

                    <div id="dialog-form_button">
                        <input type="button" value="OK" id="bt_ok_cad_info_curso" title="OK" class="ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only">
                        <input type="button" value="Limpar" id="bt_limpar_info_curso" title="Limpar" class="ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only">
                    </div>
         </fieldset>
    </form>
  </div>