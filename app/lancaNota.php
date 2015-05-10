<?php
	require_once('../models/bootstrap.php');
	session_start();
	if(!($_SESSION['logado'])){
		header('Location: index.php');
	}
	
	if(isset($_GET['id'])){
		$a = new Avaliacao();
		$a->setIdAvaliacao($_GET['id']);
		$aval = $a->retornarAvaliacaoPorId();
		$conceitos = NULL;
		
		if(isset($_POST['notas'])){
			$i = 0;
			foreach($aval->getTurma()->getAlunoTurma() as $a){
				$c = new Responde();
				$c->setIdAluno($a->getAluno()->getIdAluno());
				$c->setIdAvaliacao($_GET['id']);
				$c->setConceito($_POST['notas'][$i]);
				$c->inserirNota();
				$i++;
			}
		}
		
		if(count($aval->getResponde()) > 0){
			$conceitos = $aval->getResponde();
		}
	}
?>
<html>
<head>
<title>iMestre :: Lançamento de Notas - Professor <?php echo $_SESSION['nomeProfessor'];?></title>
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
			<h4 class="text-center">Notas de Avaliação - Turma: <?= $aval->getTurma()->getNomeTurma()?>, Data: <?= Util::arrumaData($aval->getDataAvaliacao())?></h4>
			<form method="post">
				<table class="large-12">
					<thead>
						<th width="80%">Aluno</th>
						<th width="20%">Nota</th>
					</thead>
					<tbody>
						<? 
							$turma = $aval->getTurma();
							foreach($turma->getAlunoTurma() as $a){
								echo "<tr>";
									echo '<td>'.$a->getAluno()->getNomeAluno().'</td>';
									$conceito = '0.00';
									if(!is_null($conceitos)){
										foreach($conceitos as $c){
											if($c->getAluno()->getIdAluno() == $a->getAluno()->getIdAluno()){
												$conceito = $c->getConceito();
											}
										}
									}
									echo '<td><input type="number" step="0.01" name="notas[]" value="'.$conceito.'"></td>';
								echo "</tr>";
							}
						?>
					</tbody>
				</table>
				<div class="large-12 columns text-right">
					<input type="submit" value="Salvar" class="button large-4">
				</div>
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