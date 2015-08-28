<?php
	require_once('../models/bootstrap.php');
	require_once("../libs/phpmailer/class.phpmailer.php");
	session_start();
	if(!($_SESSION['logado'])){
		header('Location: index.php');
	}
	
	if(isset($_GET['id'])){
		$t = new Turma();
		$t->setIdTurma($_GET['id']);
		$turma = $t->retornaTurmaPorId();
	}
?>
<html>
<head>
<title>iMestre :: Controle de e-Mails</title>
<link rel="stylesheet" type="text/css" href="css/foundation.css">
<link rel="stylesheet" type="text/css" href="css/basic_simplemodal.css">
<script language="JScript" src="js/vendor/jquery.js"></script>
<script language="JScript" src="js/vendor/modernizr.js"></script>
<script language="JScript" src="js/foundation.min.js"></script>
<script language="JScript" src='js/jquery.simplemodal.js'></script>
<script language="JScript" src='js/imestre.js'></script>
</head>
<body onload="arrumaMenu('email')">
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
			<h4 class="text-center">Listagem de Avaliações - Turma <?= $turma->getNomeTurma()?></h4>
			<div class="large-12 columns">
				<table class="large-12">
					<thead>
						<th width="50%">Data</th>
						<th width="30%">Peso</th>
						<th width="20%">Lançar Notas</th>
					</thead>
					<tbody>
						<?php 
							$aval = $turma->getAvaliacao();
							foreach($aval as $a){
								echo '<tr>';
									echo '<td>'.Util::arrumaData($a->getDataAvaliacao()).'</td>';
									echo '<td>'.$a->getPeso().'</td>';
									echo '<td><a href="lancaNota.php?id='.$a->getIdAvaliacao().'">Lançar Notas</a></td>';
								echo '</tr>';
							}
						?>
					</tbody>
				</table>
		</div>
		<div class="large-12 columns">
			<a href="listaTurmas.php" class="large-4 button">Voltar</a>
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
