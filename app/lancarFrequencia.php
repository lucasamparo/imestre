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
		
		$alunos = $turma->getAlunoTurma();
		$aulas = $turma->getPlanejaementa();
		$qtd_alunos = count($alunos);
		$qtd_aulas = count($aulas);
		
		for($i = 0; $i < $qtd_alunos; $i++){
			$j = 0;
			for($x = 0; $x < $qtd_aulas; $x++){
				$f = new Frequencia();
				$f->setIdAluno($alunos[$i]->getAluno()->getIdAluno());
				$f->setIdPlanejamento($aulas[$j]->getIdPlanejaementa());
				$presenca = 'NULL';
				if(isset($_POST['presenca'.$alunos[$i]->getAluno()->getIdAluno()][$x])){
					$presenca = 'P';	
				} else {
					$presenca = 'A';
				}
				$f->setPresenca($presenca);
				echo 'lançando presença da aula '.$aulas[$j]->getPrevisto().' para o aluno '.$alunos[$i]->getAluno()->getNomeAluno().' ('.$presenca.')<br>';
				//$f->lancarFrequencia();
				$j++;
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
			<h4 class="text-center">Lançamento de Frequência - Turma <?= $turma->getNomeTurma();?></h4>
			<div class="large-12 columns">
				<h5>Alunos: <?= $qtd_alunos;?> - Aulas: <?= count($aulas);?></h5>
				<form method="post">
				<table class="large-12">
					<thead>
						<th>Aluno</th>
						<?php 
							foreach($aulas as $a){
								$data = explode("-",$a->getPrevisto());
								echo '<th>'.$data[2].'/'.$data[1].'</th>';
							}
						?>
					</thead>
					<tbody>
						<?php 
							foreach($alunos as $a){
								echo '<tr>';
									echo '<td>'.$a->getAluno()->getNomeAluno().'</td>';
									for($i = 0; $i < $qtd_alunos; $i++){
										echo '<td><input type="checkbox" name="presenca'.$a->getAluno()->getIdAluno().'[]"></td>';
									}
								echo '</tr>';
							}
						?>
					</tbody>
				</table>
					<input type="submit" value="Salvar" class="large-4 button">
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