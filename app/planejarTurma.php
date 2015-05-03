<?php
	require_once('../models/bootstrap.php');
	session_start();
	if(!($_SESSION['logado'])){
		header('Location: index.php');
	}
	
	if(isset($_GET['id'])){
		$t = new Turma();
		$t->setIdTurma($_GET['id']);
		$turma = $t->retornaTurmaPorId();
		
		if(isset($_POST['plan'])){
			$limite = count($_POST['plan']);
			for($j = 0; $j < $limite; $j++){
				$pe = new Planejaementa();
				$pe->setIdTurma($_GET['id']);
				$pe->setIdItemEmenta($_POST['idItem'][$j]);
				$pe->setPrevisto($_POST['plan'][$j]);
				$pe->inserirPlanejamento();
			}
		}
	}
?>
<html>
<head>
<title>iMestre :: Listagem de Turmas - Professor <?php echo $_SESSION['nomeProfessor'];?></title>
<link rel="stylesheet" type="text/css" href="css/foundation.css">
<link rel="stylesheet" type="text/css" href="css/basic_simplemodal.css">
<script language="JScript" src="js/vendor/jquery.js"></script>
<script language="JScript" src="js/vendor/modernizr.js"></script>
<script language="JScript" src="js/foundation.min.js"></script>
<script language="JScript" src='js/jquery.simplemodal.js'></script>
<script language="JScript" src='js/imestre.js'></script>
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
			<h4 class="text-center">Planejamento de Turma - <?= $turma->getNomeTurma();?></h4>
			<div class="large-12 columns">
				<?php
					$p = new Planejaementa();
					$p->setIdTurma($_GET['id']);
					$planos = $p->retornaPlanejamentoPorIdTurma();
					if(count($planos) > 0){
						//Se tiver planejamento
						?>
						<table class="large-12">
							<thead>
								<th width="15%">Índice</th>
								<th width="65%">Conteúdo</th>
								<th width="20%">Data Planejada</th>
							</thead>
							<tbody>
								<?php 
									foreach($planos as $p){
										echo '<tr>';
											echo '<td>'.$p->getItemementa()->getIndice().'</td>';
											echo '<td>'.$p->getItemementa()->getConteudo().'</td>';
											echo '<td>'.Util::arrumaData($p->getPrevisto()).'</td>';
										echo '</tr>';
									}
								?>
							</tbody>
						</table>
						<?
					} else {
					//Se não tiver planejamento
					//Se não tiver planejamento
						if(isset($_POST['anoEmenta'])){
						?>
						<table class="large-12">
							<thead>
								<th width="15%">Índice</th>
								<th width="65%">Conteúdo</th>
								<th width="20%">Data Planejada</th>
							</thead>
							<tbody>								
								<?php
									$idEmenta = $_POST['anoEmenta'];
									$e = new Ementa();
									$e->setIdEmenta($idEmenta);
									$itens = $e->retornaEmentaPorId()->getItemementa();
									echo '<form method="post">';
									foreach($itens as $i){
										echo '<tr>';
											echo '<td>'.$i->getIndice().'</td>';
											echo '<td>'.$i->getConteudo().'</td>';
											echo '<td><input type="date" name="plan[]"><input type="hidden" name="idItem[]" value="'.$i->getIdItemEmenta().'"></td>';
										echo '</tr>';
									}
									echo '<input type="submit" value="Salvar" class="large-4 button">';
									echo '</form>';
								?>								
							</tbody>
						</table>
						<?
						} else {
						?>
						<form method="post">
							<select name="anoEmenta" class="large-9 columns">
								<?php 
									$ementas = $turma->getDisciplina()->getEmenta();
									foreach($ementas as $e){
										echo '<option value="'.$e->getIdEmenta().'">'.$e->getAno().'</option>';	
									}
								?>
							</select>
							<div class="large-3 columns">
								<input type="submit" value="Selecionar" class="large-12 button tiny">
							</div>
						</form>
						<?
						}
					}
						?>
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