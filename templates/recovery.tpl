<script type="text/javascript" src="js/jquery.maskedinput-1.2.2.js"></script>


<script type="text/javascript">

$("#rec_senha_ok").click(function(){

    var cpf = $('#rec_senha_cpf').val();
    var nascimento = $('#rec_senha_nascimento').val();
   

    dataString = 'nascimento='+ nascimento + '&cpf='+ cpf;
    
                $.ajax({
                    type: "GET",
                    url: "libs/lib_recupera_senha_envia_email.php",
                    processData: false,
                    data: dataString,
                    success: function (msg){
                        alert(msg);
                    }

                });
	
})

$("#rec_senha_cpf").mask("99999999999");
$("#rec_senha_nascimento").mask("99/99/9999");

	
</script>
<body>
 <p class="heading">Recuperação de senha</p>

 <div id="cad_adm">
    <form class="dialog-form" id="form_rec_senha" >
        <fieldset class="ui-widget ui-widget-content ui-corner-all">
		<legend class="ui-widget ui-widget-header ui-corner-all">Dados</legend>


                    <label>CPF</label>
                    <input type="text" size="11" name="rec_senha_cpf" id="rec_senha_cpf" class="text ui-widget-content ui-corner-all" /><br/>

                    <label>Data de nascimento</label>
                    <input type="text" size="10" name="rec_senha_nascimento" id="rec_senha_nascimento" class="text ui-widget-content ui-corner-all" /><br/><br/>

                    <div id="dialog-form_button"
                        <input type="button" value="Recuperar" id="rec_senha_ok" title="OK" class="ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only">
                    </div>
        </fieldset>
    </form>
  </div>
</body>