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
		if(isset($_POST['mesesEd'])){
			$aulas = $turma->retornaAulasPorMes($_POST['mesesEd']);
		} else {
			$mes = date('m');
			$aulas = $turma->retornaAulasPorMes($mes);
		}
		$qtd_alunos = count($alunos);
		$qtd_aulas = count($aulas);
		
		if(isset($_POST['valida'])){
			for($i = 0; $i < $qtd_alunos; $i++){
				for($x = 0; $x < $qtd_aulas; $x++){
					$f = new Frequencia();
					$a = $alunos[$i]->getAluno()->getIdAluno();
					$b = $aulas[$x]->getIdPlanejaementa();
					$f->setIdAluno($a);
					$f->setIdPlanejamento($b);
					$presenca = 'NULL';
					if(isset($_POST['presenca'.$a.$b])){
						$presenca = 'P';
					} else {
						$presenca = 'A';
					}
					$f->setPresenca($presenca);
					$f->lancarFrequencia();
				}
			}
			header('Location: lancarFrequencia.php?id='.$_GET['id']);	
		}		
	}
?>
<html>
<head>
<title>iMestre :: Lançamento de Frequências - Professor <?php echo $_SESSION['nomeProfessor'];?></title>
<link rel="stylesheet" type="text/css" href="css/foundation.css">
<link rel="stylesheet" type="text/css" href="css/basic_simplemodal.css">
<script language="JScript" src="js/vendor/jquery.js"></script>
<script language="JScript" src="js/vendor/modernizr.js"></script>
<script language="JScript" src="js/foundation.min.js"></script>
<script language="JScript" src='js/jquery.simplemodal.js'></script>
<script language="JScript" src='js/imestre.js'></script>
<script language="JScript">
	$(document).ready(function(){
		$('#meses').change(function (){
			$('#mesesEd').val($('#meses').val());
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
			<h4 class="text-center">Lançamento de Frequência - Turma <?= $turma->getNomeTurma();?></h4>
			<div class="large-12 columns">
				<h5>Alunos: <?= $qtd_alunos;?> - Aulas: <?= count($aulas);?></h5>
				<form method="post" id="formMes">
					<div class="row collapse">
						<select name="meses" id="meses" class="large-2 columns">
							<?php 
								for($i = 1; $i < 13; $i++){
									$selected = '';
									if($mes[0] == '0'){
										$mes = trim($mes[strlen($mes)-1]);
									}
									echo $mes;
									if(isset($_POST['meses'])){
										$mes = $_POST['meses'];
									}
									if($i == $mes){
										$selected = 'selected';
									}
									echo '<option value="'.$i.'" '.$selected.'>'.Util::retornaNomeMes($i).'</option>';
								}
							?>
						</select>
						<input type="submit" value="Selecionar" class="large-2 columns button tiny end">
					</div>	
				</form>
				<form method="post" id="formAulas">			
				<table class="large-12">
					<thead>
						<th>Aluno</th>
						<?php
							$planos = array();
							if(isset($_POST['meses'])){
								$aulas = $turma->retornaAulasPorMes($_POST['meses']);
							} else {
								$mes = date('m');
								$aulas = $turma->retornaAulasPorMes($mes);
							}
							foreach($aulas as $a){
								$planos[] = $a->getIdPlanejaEmenta();
								$data = explode("-",$a->getPrevisto());
								echo '<th>'.$data[2].'/'.$data[1].'</th>';
							}
							$qtd_aulas = count($aulas);
						?>
					</thead>
					<tbody>
						<?php 
							$j = 0;
							foreach($alunos as $a){
								echo '<tr>';
									$idAluno = $a->getAluno()->getIdAluno();
									echo '<td>'.$a->getAluno()->getNomeAluno().'</td>';
									for($i = 0; $i < $qtd_aulas; $i++){
										$idPlan = $planos[$i];
										$checked = '';
										if(Frequencia::verificarFrequencia($a->getAluno()->getIdAluno(), $aulas[$i]->getIdPlanejaEmenta()) == 'P'){
											$checked = 'checked';
										}
										echo '<td><input type="checkbox" '.$checked.' name="presenca'.$idAluno.$idPlan.'"></td>';					
									}
								echo '</tr>';
								$j++;
							}
						?>
					</tbody>
				</table>
					<input type="hidden" name="valida" value="0">
					<?php 
						$mes = date('m');
						if(isset($_POST['meses'])){
							$mes = $_POST['meses'];
						}
					?>
					<input type="hidden" name="mesesEd" id="mesesEd" value="<?= $mes?>">
					<input type="submit" value="Salvar" class="large-3 button">
					<a href="imprimirFrequencia.php?id=<?= $_GET['id']?>" target="_blank" class="large-3 button">Imprimir</a>
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