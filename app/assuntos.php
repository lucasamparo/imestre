<?php
	require_once('../models/bootstrap.php');
	session_start();
	if(!($_SESSION['logado'])){
		header('Location: index.php');
	}
	
	if(isset($_GET['id'])){
		$d = new Disciplina();
		$d->setIdDisciplina($_GET['id']);
		$disc = $d->retornaDisciplinaPorId();
		if(isset($_GET['e'])){
			$a = new Assunto();
			$a->setIdAssunto($_GET['e']);
			$a->deletarAssunto();
			header('Location: assuntos.php?id='.$_GET['id']);
		}		
		if(isset($_POST['nomeAssunto'])){
			$a = new Assunto();
			$a->setIdDisciplina($disc->getIdDisciplina());
			$a->setNomeAssunto($_POST['nomeAssunto']);
			$a->inserirAssunto();
		}
		
		if(isset($_POST['nomeAssuntoEd'])){
			$a = new Assunto();
			$a->setIdAssunto($_POST['idAssunto']);
			$a->setNomeAssunto($_POST['nomeAssuntoEd']);
			$a->alterarAssunto();
		}
	} else {
		header('Location: disciplinas.php');
	}
?>
<html>
<head>
<title>iMestre :: Controle de Assuntos - Professor <?php echo $_SESSION['nomeProfessor'];?></title>
<link rel="stylesheet" type="text/css" href="css/foundation.css">
<link rel="stylesheet" type="text/css" href="css/basic_simplemodal.css">
<script language="JScript" src="js/vendor/jquery.js"></script>
<script language="JScript" src="js/vendor/modernizr.js"></script>
<script language="JScript" src="js/foundation.min.js"></script>
<script language="JScript" src='js/jquery.simplemodal.js'></script>
<script language="JScript" src='js/imestre.js'></script>
<Script language="JScript">
	function editar(id,nome){
		$('#nomeAssuntoEd').val(nome);
		$('#idAssunto').val(id);
		$('#formEd').css('display','inline');
	}
</Script>
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
			<h4 class="text-center">Controle de Assuntos</h4>
			<h5 class="text-center">Disciplina "<?= $disc->getNomeDisciplina()?>" - Área "<?= $disc->getAreaMenor()->getNomeArea()?>"</h5>
			<form method="post">
				<fieldset>
					<legend>Novo Assunto</legend>
					<div class="large-9 columns">
						<input type="text" name="nomeAssunto" required>
					</div>
					<div class="large-1 columns">&nbsp;</div>
					<div class="large-2 columns">
						<input type="submit" name="submeter" value="Adicionar" class="button tiny">
					</div>
				</fieldset>
			</form>
			<form method="post">
				<fieldset>
					<legend>Assuntos Cadastrados</legend>
						<table class="large-12">
							<thead>
								<th width="80%">Nome</th>
								<th width="10%" class="text-center"><img src="img/editar.png" width="25"></th>
								<th width="10%" class="text-center"><img src="img/deletar.png" width="25"></th>					
							</thead>
							<tbody>
								<?php 
									$a = new Assunto();
									$a->setIdDisciplina($disc->getIdDisciplina());
									$as = $a->retornaTodosAssuntosPorDisciplina();
									foreach($as as $a){
										echo '<tr>';
											echo '<td>'.$a->getNomeAssunto().'</td>';
											echo '<td class="text-center"><a href="#formEd" onclick="editar('."'".$a->getIdAssunto()."','".$a->getNomeAssunto()."'".')"><img src="img/editar.png" width="25"></a></td>';
											echo '<td class="text-center"><a href="#" onclick="confirmacao('."'assuntos.php?id=".$disc->getIdDisciplina()."&e=".$a->getIdAssunto()."'".')"><img src="img/deletar.png" width="25"></a></td>';
										echo '</tr>';
									}
								?>
							</tbody>
						</table>
				</fieldset>
			</form>
			<form method="post" action="assuntos.php?id=<?= $_GET['id']?>" style="display: none;" id="formEd">
				<fieldset>
					<legend>Editar Assunto</legend>
					<div class="large-9 columns">
						<label>Nome:</label>
						<input type="text" name="nomeAssuntoEd" id="nomeAssuntoEd">
						<input type="hidden" name="idAssunto" id="idAssunto">
					</div>
					<div class="large-1 columns">&nbsp;</div>
					<div class="large-2 columns">
						<label>&nbsp;</label>
						<input type="submit" name="submeterEd" value="Adicionar" class="button tiny">
					</div>
				</fieldset>
			</form>
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