<script type="text/javascript" charset="ISO-8859-1">
    
 //-------------------------------------------- Ação sobre o botão Enviar --------------------------------------

  $('#bt_enviar_email').click(function(){

            //Pega os valores do formulário
            var destinatario = $("#email_destinatario").val();
            var assunto = $("#email_assunto").val();
            var texto = $("#email_texto").val();
       

            //Armazena os valores do formulário na variável dataString
            var dataString = 'destinatario=' + destinatario + '&assunto=' + assunto + '&texto=' + texto;


            //Envia a variável dataString para a lib que insere no banco de dados
            $.ajax({
                    type: "GET",
                    url: "libs/lib_admmod_email_enviar.php",
                    processData: false,
                    data: dataString,
                    success: function(){
                       alert("Email enviado com sucesso!");
                       $("#email_destinatario").val("");
                       $("#email_assunto").val("");
                       $("#email_texto").val("");
                    }
                });

    })

//------------------------------------ Ação sobre o botão Limpar ----------------------

$('#bt_limpar_email').click(function(){

    //Limpa o formulário
    $('#form_envia_email').each(function(){
              this.reset();
    });

})

</script>

<p class="heading">Enviar Email</p>

<div id="envia_email">
    <form id="form_envia_email">
        <br/>
        <table width="55%" cellspacing="12">
             <tr>
                 <td><label>Para:</label></td>
                 <td><input type="text" name="email_destinatario" id="email_destinatario" size="43" class="text ui-widget-content ui-corner-all"/></td>
             </tr>
             <tr>
                 <td><label>Assunto:</label></td>
                 <td><input type="text" name="email_assunto" id="email_assunto" size="43" class="text ui-widget-content ui-corner-all"/></td>
             </tr>
             <tr>
                 <td><label>Mensagem:</label></td>
                 <td><TEXTAREA name="email_texto" id="email_texto" COLS=50 ROWS=10 class="text ui-widget-content ui-corner-all" >  </TEXTAREA></td>
             </tr>
        </table>
    </form>
</div>

<div id="email-form_button">
        <input type="button" value="Enviar" id="bt_enviar_email" title="Enviar" class="ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only">
        <input type="button" value="Limpar" id="bt_limpar_email" title="Limpar" class="ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only">
</div>




