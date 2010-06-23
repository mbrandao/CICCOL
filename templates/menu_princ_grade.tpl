<script type="text/javascript" charset="ISO-8859-1">

var lastsel;

jQuery("#list_grade_1").jqGrid({
    url:'libs/lib_grade.php?reference=grade&action=grid_buscar_grade1',
    width:520,
    height:190,
    datatype: "xml",
    colNames:['Ementa', 'VerEmenta','Matéria', 'Disciplina', 'Carga Horária', 'Créditos', 'Pré-Requisito'],
    colModel:[
        {name:'act',index:'act', width:60, sortable:false},
        {name:'visualizar_ementa',index:'visualizar_ementa', width:50,align:"center", hidden:true},
        {name:'materia',index:'materia', width:200,align:"center"},
        {name:'disciplina',index:'disciplina', width:200, align:"center"},
        {name:'carhoraria',index:'carhoraria', width:100,align:"center"},
        {name:'creditos',index:'creditos', width:65, align:"center"},
        {name:'prerequisito',index:'prerequisito', width:300,align:"center"},
    ],
    rowNum:7,
    pager: jQuery('#pager_grade_1'),
    pgbuttons: false,
    pgtext: false,
    pginput:false,
    sortname: '',
    viewrecords: true,
    sortorder: "desc",
    hiddengrid: true,
    shrinkToFit:false,
    scrollOffset: true,
    imgpath: 'themes/steel/images',
    gridComplete: function(){
        var ids = $("#list_grade_1").getDataIDs();
        for(var i=0;i < ids.length;i++){
            var cl = ids[i];
            bv = "<input style='height:22px;width:32px;' type='button' id='bt_ver_ementa' value='Ver' onclick=\"$dialog.dialog('option', 'title', 'Ementa'); $dialog.dialog('open'); exibe('1','"+cl+"'); \"  />";
            $("#list_grade_1").setRowData(ids[i],{act:bv});
         }
    },
    caption: "1º Semestre"

});

jQuery("#list_grade_2").jqGrid({
    url:'libs/lib_grade.php?reference=grade&action=grid_buscar_grade2',
    width:520,
    height:190,
    datatype: "xml",
    colNames:['Ementa', 'VerEmenta','Matéria', 'Disciplina', 'Carga Horária', 'Créditos', 'Pré-Requisito'],
    colModel:[
        {name:'act',index:'act', width:60, sortable:false},
        {name:'visualizar_ementa',index:'visualizar_ementa', width:50,align:"center", hidden:true},
        {name:'materia',index:'materia', width:200,align:"center"},
        {name:'disciplina',index:'disciplina', width:200, align:"center"},
        {name:'carhoraria',index:'carhoraria', width:100,align:"center"},
        {name:'creditos',index:'creditos', width:65, align:"center"},
        {name:'prerequisito',index:'prerequisito', width:300,align:"center"},
    ],
    rowNum:7,
    pager: jQuery('#pager_grade_2'),
    pgbuttons: false,
    pgtext: false,
    pginput:false,
    sortname: '',
    viewrecords: true,
    sortorder: "desc",
    hiddengrid: true,
    shrinkToFit:false,
    scrollOffset: true,
    imgpath: 'themes/steel/images',
    gridComplete: function(){
        var ids = $("#list_grade_2").getDataIDs();
        for(var i=0;i < ids.length;i++){
            var cl = ids[i];
            bv = "<input style='height:22px;width:32px;' type='button' id='bt_ver_ementa' value='Ver' onclick=\"$dialog.dialog('option', 'title', 'Ementa'); $dialog.dialog('open'); exibe('2','"+cl+"'); \"  />";

            $("#list_grade_2").setRowData(ids[i],{act:bv});

         }
    },
    caption: "2º Semestre"

});



jQuery("#list_grade_3").jqGrid({
    url:'libs/lib_grade.php?reference=grade&action=grid_buscar_grade3',
    width:520,
    height:190,
    datatype: "xml",
    colNames:['Ementa', 'VerEmenta','Matéria', 'Disciplina', 'Carga Horária', 'Créditos', 'Pré-Requisito'],
    colModel:[
        {name:'act',index:'act', width:60, sortable:false},
        {name:'visualizar_ementa',index:'visualizar_ementa', width:50,align:"center", hidden:true},
        {name:'materia',index:'materia', width:200,align:"center"},
        {name:'disciplina',index:'disciplina', width:200, align:"center"},
        {name:'carhoraria',index:'carhoraria', width:100,align:"center"},
        {name:'creditos',index:'creditos', width:65, align:"center"},
        {name:'prerequisito',index:'prerequisito', width:300,align:"center"},
    ],
    rowNum:7,
    pager: jQuery('#pager_grade_3'),
    pgbuttons: false,
    pgtext: false,
    pginput:false,
    sortname: '',
    viewrecords: true,
    sortorder: "desc",
    hiddengrid: true,
    shrinkToFit:false,
    scrollOffset: true,
    imgpath: 'themes/steel/images',
    gridComplete: function(){
        var ids = $("#list_grade_3").getDataIDs();
        for(var i=0;i < ids.length;i++){
            var cl = ids[i];
            bv = "<input style='height:22px;width:32px;' type='button' id='bt_ver_ementa' value='Ver' onclick=\"$dialog.dialog('option', 'title', 'Ementa'); $dialog.dialog('open'); exibe('3','"+cl+"'); \"  />";

            $("#list_grade_3").setRowData(ids[i],{act:bv});

         }
    },
    caption: "3º Semestre"

});



jQuery("#list_grade_4").jqGrid({
    url:'libs/lib_grade.php?reference=grade&action=grid_buscar_grade4',
    width:520,
    height:190,
    datatype: "xml",
    colNames:['Ementa', 'VerEmenta','Matéria', 'Disciplina', 'Carga Horária', 'Créditos', 'Pré-Requisito'],
    colModel:[
        {name:'act',index:'act', width:60, sortable:false},
        {name:'visualizar_ementa',index:'visualizar_ementa', width:50,align:"center", hidden:true},
        {name:'materia',index:'materia', width:200,align:"center"},
        {name:'disciplina',index:'disciplina', width:200, align:"center"},
        {name:'carhoraria',index:'carhoraria', width:100,align:"center"},
        {name:'creditos',index:'creditos', width:65, align:"center"},
        {name:'prerequisito',index:'prerequisito', width:300,align:"center"},
    ],
    rowNum:7,
    pager: jQuery('#pager_grade_4'),
    pgbuttons: false,
    pgtext: false,
    pginput:false,
    sortname: '',
    viewrecords: true,
    sortorder: "desc",
    hiddengrid: true,
    shrinkToFit:false,
    scrollOffset: true,
    imgpath: 'themes/steel/images',
    gridComplete: function(){
        var ids = $("#list_grade_4").getDataIDs();
        for(var i=0;i < ids.length;i++){
            var cl = ids[i];
            bv = "<input style='height:22px;width:32px;' type='button' id='bt_ver_ementa' value='Ver' onclick=\"$dialog.dialog('option', 'title', 'Ementa'); $dialog.dialog('open'); exibe('4','"+cl+"'); \"  />";

            $("#list_grade_4").setRowData(ids[i],{act:bv});

         }
    },
    caption: "4º Semestre"

});



jQuery("#list_grade_5").jqGrid({
    url:'libs/lib_grade.php?reference=grade&action=grid_buscar_grade5',
    width:520,
    height:190,
    datatype: "xml",
    colNames:['Ementa', 'VerEmenta','Matéria', 'Disciplina', 'Carga Horária', 'Créditos', 'Pré-Requisito'],
    colModel:[
        {name:'act',index:'act', width:60, sortable:false},
        {name:'visualizar_ementa',index:'visualizar_ementa', width:50,align:"center", hidden:true},
        {name:'materia',index:'materia', width:200,align:"center"},
        {name:'disciplina',index:'disciplina', width:200, align:"center"},
        {name:'carhoraria',index:'carhoraria', width:100,align:"center"},
        {name:'creditos',index:'creditos', width:65, align:"center"},
        {name:'prerequisito',index:'prerequisito', width:300,align:"center"},
    ],
    rowNum:7,
    pager: jQuery('#pager_grade_5'),
    pgbuttons: false,
    pgtext: false,
    pginput:false,
    sortname: '',
    viewrecords: true,
    sortorder: "desc",
    hiddengrid: true,
    shrinkToFit:false,
    scrollOffset: true,
    imgpath: 'themes/steel/images',
    gridComplete: function(){
        var ids = $("#list_grade_5").getDataIDs();
        for(var i=0;i < ids.length;i++){
            var cl = ids[i];
            bv = "<input style='height:22px;width:32px;' type='button' id='bt_ver_ementa' value='Ver' onclick=\"$dialog.dialog('option', 'title', 'Ementa'); $dialog.dialog('open'); exibe('5','"+cl+"'); \"  />";

            $("#list_grade_5").setRowData(ids[i],{act:bv});

         }
    },
    caption: "5º Semestre"

});



jQuery("#list_grade_6").jqGrid({
    url:'libs/lib_grade.php?reference=grade&action=grid_buscar_grade6',
    width:520,
    height:190,
    datatype: "xml",
    colNames:['Ementa', 'VerEmenta','Matéria', 'Disciplina', 'Carga Horária', 'Créditos', 'Pré-Requisito'],
    colModel:[
        {name:'act',index:'act', width:60, sortable:false},
        {name:'visualizar_ementa',index:'visualizar_ementa', width:50,align:"center", hidden:true},
        {name:'materia',index:'materia', width:200,align:"center"},
        {name:'disciplina',index:'disciplina', width:200, align:"center"},
        {name:'carhoraria',index:'carhoraria', width:100,align:"center"},
        {name:'creditos',index:'creditos', width:65, align:"center"},
        {name:'prerequisito',index:'prerequisito', width:300,align:"center"},
    ],
    rowNum:7,
    pager: jQuery('#pager_grade_6'),
    pgbuttons: false,
    pgtext: false,
    pginput:false,
    sortname: '',
    viewrecords: true,
    sortorder: "desc",
    hiddengrid: true,
    shrinkToFit:false,
    scrollOffset: true,
    imgpath: 'themes/steel/images',
    gridComplete: function(){
        var ids = $("#list_grade_6").getDataIDs();
        for(var i=0;i < ids.length;i++){
            var cl = ids[i];
            bv = "<input style='height:22px;width:32px;' type='button' id='bt_ver_ementa' value='Ver' onclick=\"$dialog.dialog('option', 'title', 'Ementa'); $dialog.dialog('open'); exibe('6','"+cl+"'); \"  />";

            $("#list_grade_6").setRowData(ids[i],{act:bv});

         }
    },
    caption: "6º Semestre"

});



jQuery("#list_grade_7").jqGrid({
    url:'libs/lib_grade.php?reference=grade&action=grid_buscar_grade7',
    width:520,
    height:190,
    datatype: "xml",
    colNames:['Ementa', 'VerEmenta','Matéria', 'Disciplina', 'Carga Horária', 'Créditos', 'Pré-Requisito'],
    colModel:[
        {name:'act',index:'act', width:60, sortable:false},
        {name:'visualizar_ementa',index:'visualizar_ementa', width:50,align:"center", hidden:true},
        {name:'materia',index:'materia', width:200,align:"center"},
        {name:'disciplina',index:'disciplina', width:200, align:"center"},
        {name:'carhoraria',index:'carhoraria', width:100,align:"center"},
        {name:'creditos',index:'creditos', width:65, align:"center"},
        {name:'prerequisito',index:'prerequisito', width:300,align:"center"},
    ],
    rowNum:7,
    pager: jQuery('#pager_grade_7'),
    pgbuttons: false,
    pgtext: false,
    pginput:false,
    sortname: '',
    viewrecords: true,
    sortorder: "desc",
    hiddengrid: true,
    shrinkToFit:false,
    scrollOffset: true,
    imgpath: 'themes/steel/images',
    gridComplete: function(){
        var ids = $("#list_grade_7").getDataIDs();
        for(var i=0;i < ids.length;i++){
            var cl = ids[i];
            bv = "<input style='height:22px;width:32px;' type='button' id='bt_ver_ementa' value='Ver' onclick=\"$dialog.dialog('option', 'title', 'Ementa'); $dialog.dialog('open'); exibe('7','"+cl+"'); \"  />";

            $("#list_grade_7").setRowData(ids[i],{act:bv});

         }
    },
    caption: "7º Semestre"

});


jQuery("#list_grade_8").jqGrid({
    url:'libs/lib_grade.php?reference=grade&action=grid_buscar_grade8',
    width:520,
    height:190,
    datatype: "xml",
    colNames:['Ementa', 'VerEmenta','Matéria', 'Disciplina', 'Carga Horária', 'Créditos', 'Pré-Requisito'],
    colModel:[
        {name:'act',index:'act', width:60, sortable:false},
        {name:'visualizar_ementa',index:'visualizar_ementa', width:50,align:"center", hidden:true},
        {name:'materia',index:'materia', width:200,align:"center"},
        {name:'disciplina',index:'disciplina', width:200, align:"center"},
        {name:'carhoraria',index:'carhoraria', width:100,align:"center"},
        {name:'creditos',index:'creditos', width:65, align:"center"},
        {name:'prerequisito',index:'prerequisito', width:300,align:"center"},
    ],
    rowNum:7,
    pager: jQuery('#pager_grade_8'),
    pgbuttons: false,
    pgtext: false,
    pginput:false,
    sortname: '',
    viewrecords: true,
    sortorder: "desc",
    hiddengrid: true,
    shrinkToFit:false,
    scrollOffset: true,
    imgpath: 'themes/steel/images',
    gridComplete: function(){
        var ids = $("#list_grade_8").getDataIDs();
        for(var i=0;i < ids.length;i++){
            var cl = ids[i];
            bv = "<input style='height:22px;width:32px;' type='button' id='bt_ver_ementa' value='Ver' onclick=\"$dialog.dialog('option', 'title', 'Ementa'); $dialog.dialog('open'); exibe('8','"+cl+"'); \"  />";

            $("#list_grade_8").setRowData(ids[i],{act:bv});

         }
    },
    caption: "8º Semestre"

});

jQuery("#list_grade_optativa").jqGrid({
    url:'libs/lib_grade.php?reference=grade&action=grid_buscar_grade_optativa',
    width:520,
    height:190,
    datatype: "xml",
    colNames:['Ementa', 'VerEmenta','Matéria', 'Disciplina', 'Carga Horária', 'Créditos', 'Pré-Requisito'],
    colModel:[
        {name:'act',index:'act', width:60, sortable:false},
        {name:'visualizar_ementa',index:'visualizar_ementa', width:50,align:"center", hidden:true},
        {name:'materia',index:'materia', width:200,align:"center"},
        {name:'disciplina',index:'disciplina', width:200, align:"center"},
        {name:'carhoraria',index:'carhoraria', width:100,align:"center"},
        {name:'creditos',index:'creditos', width:65, align:"center"},
        {name:'prerequisito',index:'prerequisito', width:300,align:"center"},
    ],
    rowNum:7,
    pager: jQuery('#pager_grade_optativa'),
    pgbuttons: false,
    pgtext: false,
    pginput:false,
    sortname: '',
    viewrecords: true,
    sortorder: "desc",
    hiddengrid: true,
    shrinkToFit:false,
    scrollOffset: true,
    imgpath: 'themes/steel/images',
    gridComplete: function(){
        var ids = $("#list_grade_optativa").getDataIDs();
        for(var i=0;i < ids.length;i++){
            var cl = ids[i];
            bv = "<input style='height:22px;width:32px;' type='button' id='bt_ver_ementa' value='Ver' onclick=\"$dialog.dialog('option', 'title', 'Ementa'); $dialog.dialog('open'); exibe('optativa','"+cl+"'); \"  />";

            $("#list_grade_optativa").setRowData(ids[i],{act:bv});

         }
    },
    caption: "Disciplinas Optativas"

});


//-------------------------------------------- Ação sobre o botão OK --------------------------------------

  $('#bt_ok_busca_grade').click(function(){

            //Pega os valores do formulário
            var id_grade = $("#buscar_id_grade").val();
            var num_semestre = 8;
            
            for(var i=1; i<=num_semestre; i++)
             {
                 $("#list_grade_"+i).setGridParam({
                    url: "libs/lib_grade.php?reference=grade&action=grid_buscar_grade"+i+"&id_grade="+id_grade}).trigger("reloadGrid");
             }
            
             $("#list_grade_optativa").setGridParam({
                    url: "libs/lib_grade.php?reference=grade&action=grid_buscar_grade_optativa&id_grade="+id_grade}).trigger("reloadGrid");
})


// -------------------------------------ABRE FORMULÁRIO PARA CADASTRO E EDIÇÃO--------------------------
   var $dialog = $('#form_ver_ementa').dialog({
        width:350,
        height:260,
        modal: true,
        autoOpen: false

    });

// -------------------------------------EXIBIR A EMENTA DA DISCIPLINA--------------------------

function exibe(num_semestre, id)
{
    $("#bt_ver_ementa").click(function(){
         $("#list_grade_"+num_semestre).GridToForm(id,"#form_ver_ementa");
    })
}


</script>


<p class="heading">Grade Curricular</p>


<div id="form">

     <label for="tipo">Buscar por:</label>
     <select size="1" id="buscar_id_grade" name="buscar_id_grade">
                <option selected></option>
                <!--{section name=cont_grade loop=$grade}-->
                <option value="<!--{$idGrade[cont_grade].id}-->"><!--{"Grade "|cat:$grade[cont_grade]}--></option>
           <!--{/section}-->
     </select>
     <input type="button" id="bt_ok_busca_grade" value="OK" class="ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only"/>

</div>

<div id="form">
    <table id="list_grade_1" class="scroll" cellpadding="0" cellspacing="0"> </table>
    <div id="pager_grade_1" class="scroll" style="text-align:center;"></div>
</div>

<div id="form">
    <table id="list_grade_2" class="scroll" cellpadding="0" cellspacing="0"> </table>
    <div id="pager_grade_2" class="scroll" style="text-align:center;"></div>
</div>

<div id="form">
    <table id="list_grade_3" class="scroll" cellpadding="0" cellspacing="0"> </table>
    <div id="pager_grade_3" class="scroll" style="text-align:center;"></div>
</div>

<div id="form">
    <table id="list_grade_4" class="scroll" cellpadding="0" cellspacing="0"> </table>
    <div id="pager_grade_4" class="scroll" style="text-align:center;"></div>
</div>

<div id="form">
    <table id="list_grade_5" class="scroll" cellpadding="0" cellspacing="0"> </table>
    <div id="pager_grade_5" class="scroll" style="text-align:center;"></div>
</div>

<div id="form">
    <table id="list_grade_6" class="scroll" cellpadding="0" cellspacing="0"> </table>
    <div id="pager_grade_6" class="scroll" style="text-align:center;"></div>
</div>

<div id="form">
    <table id="list_grade_7" class="scroll" cellpadding="0" cellspacing="0"> </table>
    <div id="pager_grade_7" class="scroll" style="text-align:center;"></div>
</div>

<div id="form">
    <table id="list_grade_8" class="scroll" cellpadding="0" cellspacing="0"> </table>
    <div id="pager_grade_8" class="scroll" style="text-align:center;"></div>
</div>

<div id="form">
    <table id="list_grade_optativa" class="scroll" cellpadding="0" cellspacing="0"> </table>
    <div id="pager_grade_optativa" class="scroll" style="text-align:center;"></div>
</div>

<!-- Formulário de cadastro e edição-->
 <form class="dialog-form" id="form_ver_ementa" style="display:none; background-color: white;">
        <textarea name="visualizar_ementa" cols="28" rows="10" readonly="readonly" class="text ui-widget-content ui-corner-all aux"></textarea>
 </form>






