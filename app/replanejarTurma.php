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
		
		if(isset($_POST['nova'])){
			$limite = count($_POST['nova']);
			$pe = new Planejaementa();
			$pe->setIdTurma($_GET['id']);
			$plan = $pe->retornaPlanejamentoPorIdTurma();
			for($j = 0; $j < $limite; $j++){
				$plan[$j]->setPrevisto($_POST['nova'][$j]);
				$plan[$j]->alterarPlanejamento();			
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
			<h4 class="text-center">Replanejamento de Turma - <?= $turma->getNomeTurma();?></h4>
			<div class="large-12 columns">
			<form method="post">
				<?php 
					$idTurma = $_GET['id'];
					$p = new Planejaementa();
					$p->setIdTurma($idTurma);
					$planeja = $p->retornaPlanejamentoPorIdTurma();
				?>
				<table class="large-12">
					<thead>
						<th width="5%">Índice</th>
						<th width="45%">Conteúdo</th>
						<th width="25%">Data Antiga</th>
						<th width="25%">Nova Data</th>
					</thead>
					<tbody>
						<?php 
							foreach($planeja as $t){
								echo '<tr>';
									echo '<td>'.$t->getItemEmenta()->getIndice().'</td>';
									echo '<td>'.$t->getItemEmenta()->getConteudo().'</td>';
									echo '<td>'.Util::arrumaData($t->getPrevisto()).'</td>';
									echo '<td><input type="date" name="nova[]" value="'.$t->getPrevisto().'"></td>';
								echo '</tr>';
							}
						?>
					</tbody>
				</table>
				<div class="large-4 columns">
					<input type="submit" class="button large-12" value="Salvar">
				</div>
				<div class="large-4 columns end">
					<a href="planejarTurma.php?id=<?= $_GET['id']?>" class="large-12 button">Voltar</a>
				</div>
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