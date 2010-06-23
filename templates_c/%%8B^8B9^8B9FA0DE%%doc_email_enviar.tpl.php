<?php /* Smarty version 2.6.26, created on 2010-06-22 22:58:14
         compiled from doc_email_enviar.tpl */ ?>
<script type="text/javascript" charset="ISO-8859-1">
    
 //-------------------------------------------- Ação sobre o botão Enviar --------------------------------------

  $('#bt_enviar_email').click(function(){

            //Pega os valores do formulário
            var id_disciplina = $("#cad_email_disciplina").val();
            var assunto = $("#email_assunto").val();
            var texto = $("#email_texto").val();
       

            //Armazena os valores do formulário na variável dataString
            var dataString = 'id_disciplina=' + id_disciplina + '&assunto=' + assunto + '&texto=' + texto;


            //Envia a variável dataString para a lib que insere no banco de dados
            $.ajax({
                    type: "GET",
                    url: "libs/lib_doc_email_enviar.php",
                    processData: false,
                    data: dataString,
                    success: function(){
                       alert("Email enviado com sucesso!");
                       $("#cad_email_disciplina").val("");
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
         <table width="55%" cellspacing="12">
             <tr>
                 <td><label>Disciplina:</label></td>
                 <td><select id="cad_email_disciplina" name="cad_email_disciplina">
                       <option>Selecione</option>
                       <?php unset($this->_sections['cont_disc']);
$this->_sections['cont_disc']['name'] = 'cont_disc';
$this->_sections['cont_disc']['loop'] = is_array($_loop=$this->_tpl_vars['disciplina']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['cont_disc']['show'] = true;
$this->_sections['cont_disc']['max'] = $this->_sections['cont_disc']['loop'];
$this->_sections['cont_disc']['step'] = 1;
$this->_sections['cont_disc']['start'] = $this->_sections['cont_disc']['step'] > 0 ? 0 : $this->_sections['cont_disc']['loop']-1;
if ($this->_sections['cont_disc']['show']) {
    $this->_sections['cont_disc']['total'] = $this->_sections['cont_disc']['loop'];
    if ($this->_sections['cont_disc']['total'] == 0)
        $this->_sections['cont_disc']['show'] = false;
} else
    $this->_sections['cont_disc']['total'] = 0;
if ($this->_sections['cont_disc']['show']):

            for ($this->_sections['cont_disc']['index'] = $this->_sections['cont_disc']['start'], $this->_sections['cont_disc']['iteration'] = 1;
                 $this->_sections['cont_disc']['iteration'] <= $this->_sections['cont_disc']['total'];
                 $this->_sections['cont_disc']['index'] += $this->_sections['cont_disc']['step'], $this->_sections['cont_disc']['iteration']++):
$this->_sections['cont_disc']['rownum'] = $this->_sections['cont_disc']['iteration'];
$this->_sections['cont_disc']['index_prev'] = $this->_sections['cont_disc']['index'] - $this->_sections['cont_disc']['step'];
$this->_sections['cont_disc']['index_next'] = $this->_sections['cont_disc']['index'] + $this->_sections['cont_disc']['step'];
$this->_sections['cont_disc']['first']      = ($this->_sections['cont_disc']['iteration'] == 1);
$this->_sections['cont_disc']['last']       = ($this->_sections['cont_disc']['iteration'] == $this->_sections['cont_disc']['total']);
?>
                       <option value="<?php echo $this->_tpl_vars['disciplina'][$this->_sections['cont_disc']['index']]['id']; ?>
"><?php echo $this->_tpl_vars['disciplina'][$this->_sections['cont_disc']['index']]['disciplina']; ?>
</option>
                       <?php endfor; endif; ?>
                 </select></td>
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



