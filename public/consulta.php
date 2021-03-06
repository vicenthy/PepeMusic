<html>
<head>
 
 <meta http-equiv="Content-Type" content="text/html; charset=UTF8">
 <link href="../css/themes/redmond/jquery-ui-1.8.16.custom.css" rel="stylesheet" type="text/css" />
 <link href="../js/jtable/themes/metro/blue/jtable.css" rel="stylesheet" type="text/css" />
 <script src="../js/jquery-1.6.4.min.js" type="text/javascript"></script>
 <script src="../js/jquery-ui-1.8.16.custom.min.js" type="text/javascript"></script>
 <script src="../js/jtable/jquery.jtable.js" type="text/javascript"></script>
 <link href="../js/jtable/localization/jquery.jtable.pt-BR.js" rel="stylesheet" type="text/javascript" />	
<title>META-DADOS - Sistema de Consulta de obras - PEPE MUSIC</title>
</head>

<body>

<!--inicio div tabs-->
<div id="tabs">

  <!--link das tabs-->
  <ul>
    <li><a href="#tabs-1">Pesquisar por Titular</a></li>
    <li><a href="#tabs-2">Pesquisar por Obra</a></li>
  </ul>

<!--inicio tabs1-->
<div id="tabs-1">
 <fieldset >
<legend>Parametros da Consulta de Titular</legend>
<form id="fmrPrincipal">

<select name="parametro" id="parametro" >
	<option value="nome">Nome</option>	
	<option value="nomefantasia">Nome Artístico</option>	
	<option value="codecad">Código Ecad</option>	
</select>

<input type="text" name="nome" id="nome" title="DIGITE O NOME, NOME ARTÍSTICO OU CÓDIGO ECAD DA OBRA">
<input type="button" id="buttonPes" value="Pesquisar">
<input type="button" id="limpar" value="Limpar">
<br />
</form>

<!--div Jtable Titular-->
<div id="table" > </div>

</fieldset>

 </div>
 <!--fim tab1-->

<!--inicio tab2-->
 <div id="tabs-2">

 
<fieldset>
<legend>Parametros da Consulta de Obra</legend>
<form id="fmrPrincipalObra" >
<select name="parametroObra" id="parametroObra">
	<option value="titulo">Titulo da obra</option>	
	<option value="codecad">Código Ecad</option>	
</select>
<input type="text" name="nomeObra" id="nomeObra" title="DIGITE O TÍTULO OU CÓDIGO ECAD DA OBRA">
<input type="button" id="buttonPesObra" value="Pesquisar">
<input type="button" id="limparObra" value="Limpar">
<br />

</form>

<div id="tableObra" ></div>

</fieldset>

  </div>

 </div>
 
<div id="dialog" title="Titulares da Obra">

<div id="users-contain" class="ui-widget">
  <table id="users" class="ui-widget ui-widget-content">
    <thead>
      <tr class="ui-widget-header ">
        <th>Titulares</th>
        <th>Percentual</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td></td>
        <td></td>
      </tr>
    </tbody>
  </table>
</div>
</div>

</body>

<script type="text/javascript">
	$(document).ready(function () {



  $(function() {
    $( "#tabs" ).tabs();
  });

			$(function(){	
				    $("#dialog").dialog({
			    	autoOpen:false,
			    	 height: 300,
      				width: 700,
      				modal: true,
      				close: function(){

					$( "#users tr" ).remove();

		$( "#users tbody" ).append( 

						'<tr class="ui-widget-header ">'
        				+'<th>Titulares</th>'
        				+'<th>Percentual</th>'
      					+'</tr>'
      					);

				}

			    });

			});





	$('#table').jtable({
		title:'Titulares Encontrados',
		paging: true,
		pageSize: 10,
		actions: {
			listAction: 'buscar.php?action=list',
		},

		fields: {
		
		objref: {
				key: true,
				create: false,
				edit: false,
				list: false
		},

		obras: {
			title: '',
			width: '3%',
			display: function(exibirobrasData) {
				var $img = $('<img src="../img/eye-icon.png" title="Ver as obras deste Titular" align="center" width="30px" />');
				var $childTable;
				$img.click(function(){
					$('#table').jtable('openChildTable',
					$img.closest('tr'),	
					{
						title: 'Obras do titular: '+ exibirobrasData.record.nome,
						selecting: true,
						actions:{
						listAction:'buscarObra.php?action=listObra&objref='+exibirobrasData.record.objref,

						},

						fields:{
							
							titularObjref: {
								type:'hidden',
								defaultValue: exibirobrasData.record.objref
							},

							obraobjref: {
								key:true,
								create:false,
								edit:false,
								list:false
							},
						
							titulo: {
								title: 'Titulo da Obra',
								width: '40%'
								
							},
							obracodecad: {
								title: 'Código Ecad',
								width: '40%'
								
							}

						},

						selectionChanged: function(){

							var $selectedRows = $childTable.childTable.jtable('selectedRows');
							
							$selectedRows.each(function(){
								var $record = $(this).data('record');
								obterobra($record.obraobjref);
							});


							function obterobra(objref){
						$.ajax({
								  url: 'exibirObras.php?action=listObra&objref='+objref,
								  dataType: 'json',	
	  							success: function(data) {
  							
 						for($i=0; $i < data.length; $i++){

							 			$( "#users tbody" ).append( 
							 				"<tr>" +
							          		"<td>" + data[$i].nometitular + "</td>" +
							          		"<td>" + parseFloat(data[$i].percentual).toFixed(2)+ "%</td>" +
							        		"</tr>" );

									}

								$('#dialog').dialog('open');

								  }


								});



							}

							

						}


					}, function(data){
							data.childTable.jtable('load');
							$childTable = data;

					});


				});
		

				return $img;
			}

		},

		nome: {
			title: 'Nome',
			width: '40%'
			
		},
			
		nomefantasia: {
				title: 'Nome Fantasia',
				width: '40%'
			
		},

		codecad: {
			title: 'Codido Ecad',
			width: '40%'
		}

	}
	


});


	






	$('#limpar').click(function(){

		$('#table').hide();
     
     });
 

	$('#buttonPes').click(function(){
	
	$('#table').jtable('load',{

		nome: $('#nome').val(),
		parametro: $('#parametro').val()

		 });


	$('#table').show();

	});




$('#table').hide();

//#######JTABLE OBRA############

	$('#tableObra').jtable({
		title:'Obras Encontradas',
		selecting: true,
		paging: true,
		pageSize: 10,
		actions: {
			listAction: 'buscarObra2.php?action=listObra',

		},

		fields: {
		
		obraobjref: {
				key: true,
				create: false,
				edit: false,
				list: false
		},

		titulo: {
			title: 'Titulo da Obra',
			width: '40%'
			
		},
			
		obracodecad: {
				title: 'Codigo Ecad',
				width: '40%'
			
		}

	},

		selectionChanged: function(){
 
		var $selectedRows = $('#tableObra').jtable('selectedRows');
		$selectedRows.each(function(){
		var $record = $(this).data('record');
		obterobra($record.obraobjref);


});

	function obterobra(objref){

		$.ajax({
		  url: 'exibirObras.php?action=listObra&objref='+objref,
		  dataType: 'json',	

         success: function(data) {
  							
 		for($i=0; $i < data.length; $i++){

		$( "#users tbody" ).append( 
							
							"<tr>" +
							"<td>" + data[$i].nometitular + "</td>" +
							"<td>" + parseFloat(data[$i].percentual).toFixed(2)+ "%</td>" +
							"</tr>" );

		            	}

	$('#dialog').dialog('open');


            	  }

          });

      }					

   }


});




	$('#limparObra').click(function(){

		$('#tableObra').hide();
     

     });
 
	$('#buttonPesObra').click(function(){
	
	$('#tableObra').jtable('load',{

		nomeObra: $('#nomeObra').val(),
		parametroObra:$('#parametroObra').val(),

		 });


	$('#tableObra').show();

	});


$('#tableObra').hide();


//#######FIM JTABLE OBRA#######################
	
});

</script>
</html>