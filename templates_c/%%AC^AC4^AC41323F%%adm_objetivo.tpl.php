<?php /* Smarty version 2.6.26, created on 2010-06-17 10:28:43
         compiled from adm_objetivo.tpl */ ?>
<script type="text/javascript">
     //-------------------------------------------- Ação sobre o botão OK --------------------------------------

  $('#bt_ok_cad_objetivo').click(function(){

            //Pega os valores do formulário
            var objetivo = $("#cad_curriculo_perfil_profissional").val();
            var ultimo_emprego = $("#cad_curriculo_ultimo_emprego").val();
            var cargo = $("#cad_curriculo_cargo").val();
            var id_curriculo = $("#cad_curriculo_id").val();

            var interesse = [];

            //Função para pegar os valores do segundo select
            $("#select2 option:selected").each(function() {
                interesse.push($(this).val());
            });


            //Armazena os valores do formulário na variável dataString
           var dataString = 'perfil_profissional=' + perfil_profissional + '&ultimo_emprego=' + ultimo_emprego + '&cargo=' + cargo + '&id_curriculo=' + id_curriculo + '&interesse=' + interesse;


            //Defique qual action será passada na url
            if (id_curriculo=="")
                var opcao= 'inserir_curriculo';
            else
                var opcao='update_curriculo';

            //Envia a variável dataString para a lib que insere no banco de dados
            $.ajax({
                    type: "GET",
                    url: "libs/lib_cad_curriculo.php?reference=curriculo&action="+ opcao,
                    processData: false,
                    data: dataString,
                    //dataType: "html",
                    success: function(){
                      //alert(msg);
                      alert("Currículo feito com sucesso!");
                    }
                });

    })
</script>


<p class="heading">Cadastrar Objetivo</p>



<div id="cad_adm">
    <TEXTAREA COLS=60 ROWS=8 class="text ui-widget-content ui-corner-all"> <?php echo $this->_tpl_vars['objet']; ?>
 </TEXTAREA><br/><br/>

    <div id="dialog-form_button">
           <input type="button" value="OK" id="bt_ok_cad_objetivo" title="OK" class="ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only">
           <input type="button" value="Limpar" id="bt_limpar_cad_objetivo" title="Limpar" class="ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only">
    </div>
</div>



