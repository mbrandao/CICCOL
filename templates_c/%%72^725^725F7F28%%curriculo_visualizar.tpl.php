<?php /* Smarty version 2.6.26, created on 2010-06-22 22:57:31
         compiled from curriculo_visualizar.tpl */ ?>
<script type="text/javascript">

// ------------------------------------Grid Projeto---------------------------
var lastsel;

jQuery("#list_cad_projeto").jqGrid({
    url:'libs/lib_projeto.php?reference=projeto&action=grid_buscar_projeto',
    width: 430,
    height:150,
    datatype: "xml",
    colNames:['Descrição'],
    colModel:[
        {name:'cad_projeto_descricao',index:'cad_projeto_descricao', width:100,sortable:false,align:"left"}
    ],
    rowNum:10,
    pager: '#pager_cad_projeto',
    sortname: 'id',
    viewrecords: true,
    sortorder: "desc",
    shrinkToFit:false,
    scrollOffset: true,
    hiddengrid: true,
    imgpath: 'themes/steel/images',
    onSelectRow: function(id){
        if(id && id!=lastsel){
            $('#list_cad_projeto').restoreRow(lastsel);

            lastsel=id;
        }
    },
    //editurl: "local",
    caption: "Projetos de Pesquisa"
});
</script>

<p class="heading">Meu Currículo</p>

<!-- Formulário de cadastro e edição -->
<div id="ver_curriculo">
    <form class="dialog-form" id="form_cad_curriculo">
        <fieldset class="ui-widget ui-widget-content ui-corner-all">
		<legend class="ui-widget ui-widget-header ui-corner-all"><?php echo $this->_tpl_vars['docente']; ?>
</legend>
                    <br/>

                    <label>Perfil Profissional</label><br/>
                    <p><?php echo $this->_tpl_vars['perfil']; ?>
</p><br/><br/>

                    <label>Último Emprego</label><br/>
                    <p><?php echo $this->_tpl_vars['ultEmprego']; ?>
</p><br/><br/>

                    <label>Cargo Atual</label><br/>
                    <p><?php echo $this->_tpl_vars['cargo']; ?>
</p><br/><br/>

                    <label>Áreas de Interesse</label><br/>
                    <p><?php echo $this->_tpl_vars['interesse']; ?>
</p><br><br/>

                    <label>Link para o Currículo Lattes</label><br/>
                    <p><a href="<?php echo $this->_tpl_vars['curLattes']; ?>
" target="_blank"><?php echo $this->_tpl_vars['curLattes']; ?>
</a></p>
                    <br/><br/><br/>
                    
                    <div id="form_grid_projeto">
                        <table id="list_cad_projeto" style="float: right" class="scroll" cellpadding="0" cellspacing="0"> </table>
                        <div id="pager_cad_projeto" class="scroll" style="text-align:center;"></div>
                    </div>
                    
                    <br/>
         </fieldset>
    </form>
  </div>




