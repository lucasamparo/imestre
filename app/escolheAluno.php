<?php
	require_once('../models/bootstrap.php');
	session_start();
	if(!($_SESSION['logado'])){
		header('Location: index.php');
	}
?>
<html>
<head>
<title>iMestre :: Escolher Aluno - Professor <?php echo $_SESSION['nomeProfessor'];?></title>
<link rel="stylesheet" type="text/css" href="css/foundation.css">
<script language="JScript" src="js/vendor/jquery.js"></script>
<script language="JScript" src="js/vendor/modernizr.js"></script>
<script language="JScript" src="js/jquery.dataTables.js"></script>
<script language="JScript" src='js/imestre.js'></script>
<script language="JScript">
$(document).ready(function(){
	$('#tabela').dataTable({
		"bJQueryUI": true,
		"sPaginationType": "full_numbers",
		"sDom": '<"H"Tlfr>t<"F"ip>',
		"oLanguage": {
			"sLengthMenu": "Registros _MENU_",
			"sZeroRecords": "Nenhum registro encontrado",
			"sInfo": "Mostrando _START_ / _END_ de _TOTAL_ registro(s)",
			"sInfoEmpty": "Mostrando 0 / 0 de 0 registros",
			"sInfoFiltered": "(filtrado de _MAX_ registros)",
			"sSearch": "Pesquisar: ",
			"oPaginate": {
				"sFirst": " |< ",
				"sPrevious": " << ",
				"sNext": " >> ",
				"sLast": " >| " }
		},
		"aaSorting": [[0, 'desc']],
		"aoColumnDefs": [ {"sType": "num-html", "aTargets": [0]} ]
	});
	$('#tabela_info').addClass("large-12 medium-12 small-12 text-center");
	$('#tabela_length').addClass("large-3 medium-3 small-3 columns");
	$('#tabela_filter').addClass("large-9 medium-9 small-9 columns");
	$('#tabela').addClass("large-12");
	$('#tabela_paginate').addClass("large-12 medium-12 small-12 text-center");
});

function seleciona(codigo){
	window.opener.insereAluno(codigo);
}
</script>
</head>
<body>
<div class="row">
	<div class="large-12 columns">
		<fieldset>
			<legend>Selecione Aluno</legend>
			<table class="large-12" id="tabela">
				<thead>
					<tr>
						<th>Nome</th>
						<th></th>
					</tr>					
				</thead>
				<tbody>
					<?php 
						$a = new Aluno();
						$alunos = $a->retornaTodosAlunos();
						foreach($alunos as $a){
							echo '<tr>';
								echo '<td width="90%">'.$a->getNomeAluno().'</td>';
								echo 	'<td width="10%">
											<a href="#" onclick="seleciona('.$a->getIdAluno().')">
												<img src="img/checado.jpeg">
											</a>
										</td>';
							echo '</tr>';
						}
					?>
				</tbody>
			</table>				
		</fieldset>
	</div>		
</div>
</body>
</html>