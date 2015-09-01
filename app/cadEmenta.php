<?php
	require_once('../models/bootstrap.php');
	session_start();
	if(!($_SESSION['logado'])){
		header('Location: index.php');
	}
	
	if(isset($_GET['id'])){
		$idDisciplina = $_GET['id'];
		$d = new Disciplina();
		$d->setIdDisciplina($idDisciplina);
		$disc = $d->retornaDisciplinaPorId();
		
		if(isset($_POST['indice'])){
			$e = new Ementa();
			$e->setAno($_POST['ano']);
			$e->setIdDisciplina($idDisciplina);
			$id = $e->inserirEmenta();
			
			$id_array = $id->toArray();
			$limite = count($_POST['indice']);
			
			for($j = 0; $j < $limite; $j++){
				$i = new Itemementa();
				$i->setIndice($_POST['indice'][$j]);
				$i->setConteudo($_POST['conteudo'][$j]);
				$i->setIdEmenta($id_array[0]['max']);
				$i->inserirItemEmenta();
			}			
			header('Location: ementas.php?id='.$idDisciplina);
		}
	}
?>
<html>
<head>
<title>iMestre :: Cadastro de Ementas - Professor <?php echo $_SESSION['nomeProfessor'];?></title>
<link rel="stylesheet" type="text/css" href="css/foundation.css">
<link rel="stylesheet" type="text/css" href="css/basic_simplemodal.css">
<script language="JScript" src="js/vendor/jquery.js"></script>
<script language="JScript" src="js/vendor/modernizr.js"></script>
<script language="JScript" src="js/foundation.min.js"></script>
<script language="JScript" src='js/jquery.simplemodal.js'></script>
<script language="JScript" src='js/imestre.js'></script>
<script language="JScript">
$(document).ready(function (){
	$('#novoItem').click(function (){
		$('#divItem').css('display','inline');
		$('#indice').focus();
	});
	$('#addItem').click(function (){
		$('#divItem').css('display','none');
		var indice = $('#indice').val();
		var conteudo = $('#conteudo').val();
		var linha = '<tr><td>'+indice+'</td><td>'+conteudo+'</td></tr>';
		$('#corpoEmenta').append(linha);
		var form = '<input type="hidden" name="indice[]" value="'+indice+'">'
					+'<input type="hidden" name="conteudo[]" value="'+conteudo+'">';
		$('#formItens').append(form);
		$('#indice').val("");
		$('#conteudo').val("");
	});
});
</script>
</head>
<body>
	<div class="row"><!-- Linha do header -->
		<?php include('header.php');?>
	</div>
	<div class="row"><!-- Linha do Menu -->
		<div class="large-12 columns">
			<?php include('menu.php')?>
		</div>
		<div class="large-12 columns">
			<hr>
		</div>
	</div>
	<div class="row"><!-- Linha do Content -->
		<div class="large-2 columns">
			<?php include('sidebar.php');?>
		</div>
		<div class="large-10 columns" style="border-left-style: solid; border-width: 1px;">
			<h4 class="text-center">Cadastro de Ementas - Disciplina <?= $disc->getNomeDisciplina();?></h4>
			<fieldset>
				<form id="formItens" method="post">
				<legend>Nova Ementa</legend>
				<div class="large-12 columns">
					<label>Ano:</label>
					<input type="text" name="ano" maxlength="5">
				</div>
				<fieldset>
					<legend>Itens da Ementa</legend>
					<table class="large-12">
						<thead>
							<th>#</th>
							<th>Conteúdo</th>
						</thead>
						<tbody id="corpoEmenta">
						</tbody>
					</table>
						<div class="row collapse">
							<div class="large-4 columns">
								<a href="#divItem" class="large-12 button" id="novoItem">Novo Item</a>
							</div>
							<div class="large-8 columns text-right">
								<input type="submit" value="Salvar" class="large-6 button">
							</div>
						</div>
					</form>
				</fieldset>				
			</fieldset>
			<div class="large-12 columns" style="display: none;" id="divItem">
				<form method="post">
					<fieldset>
						<legend>Novo Item de Ementa</legend>
						<div class="large-2 columns">
							<label>Índice:</label>
							<input type="number" step="1" id="indice" min="1">
						</div>
						<div class="large-10 columns">
							<label>Conteúdo:</label>
							<textarea id="conteudo"></textarea>
						</div>
						<div class="large-12 columns text-right">
							<a href="#" class="large-4 button" id="addItem">Adicionar</a>
						</div>
					</fieldset>
				</form>
			</div>
		</div>
	<hr>
	</div>
	<div class="large-12 columns">
			<?php include('footer.php')?>
	</div>	
</body>
<script>
  $(document).foundation();
</script>
</html>