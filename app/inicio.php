<?php
	require_once('../models/bootstrap.php');
	session_start();
	if(!($_SESSION['logado'])){
		header('Location: index.php');
	}
	$p = new Professor();
	$p->setIdProfessor($_SESSION['idProfessor']);
	$professor = $p->retornaProfessorPorId();
	$nome = explode(" ",$professor->getNomeProfessor());
	
	if(isset($_GET['e'])){
		$l = new Lembrete();
		$l->setIdLembrete($_GET['e']);
		$l->excluirLembrete();
		header('Location: inicio.php');
	}
?>

<html>
<head>
<title>iMestre :: Início - Professor <?php echo $professor->getNomeProfessor();?></title>
<link rel="stylesheet" type="text/css" href="css/foundation.css">
<script language="JScript" src="js/vendor/jquery.js"></script>
<script language="JScript" src="js/vendor/modernizr.js"></script>
<script language="JScript" src="js/foundation.min.js"></script>
<script language="JScript" src='js/jquery.simplemodal.js'></script>
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
			<div class="large-12 columns">
				<fieldset>
					<legend class="text-center">Acesso Rápido</legend>
					<div class="large-4 columns">
						<a href="#" class="button large-12">Professor</a>
					</div>
					<div class="large-4 columns">
						<a href="#" class="button large-12">Avaliações</a>
					</div>
					<div class="large-4 columns">
						<a href="#" class="button large-12">Alunos</a>
					</div>
					<div class="large-12 columns">&nbsp;</div>
					<div class="large-4 columns">
						<a href="#" class="button large-12">Disco Virtual</a>
					</div>
					<div class="large-4 columns">
						<a href="#" class="button large-12">Questões</a>
					</div>
					<div class="large-4 columns">
						<a href="#" class="button large-12">Horários</a>
					</div>
				</fieldset>
			</div>
			<div class="large-4 columns">
				<fieldset>
					<legend>Próximas Avaliações</legend>
					<table class="large-12">
						<thead>
							<th>Data</th>
							<th>Turma</th>
						</thead>
						<tbody>
							<?php 
								$a = new Avaliacao();
								$aval = $a->retornarTodasAvaliacoes(date('Y-m-d'), '>');
								foreach($aval as $a){
									if($a->getTurma()->getInstituicao()->getProfessor()->getIdProfessor() == $professor->getIdProfessor()){
										echo '<tr>';
											echo '<td>'.Util::arrumaData($a->getDataAvaliacao()).'</td>';
											echo '<td>'.$a->getTurma()->getNomeTurma().'</td>';
										echo '</tr>';
									}									
								}
							?>
						</tbody>
					</table>
				</fieldset>
			</div>
			<div class="large-8 columns">
				<fieldset>
					<legend>Lembretes</legend>
					<table class="large-12">
						<thead>
							<th width="25%">Data</th>
							<th>Conteúdo</th>
							<th width="10%" class="text-center"><img src="img/deletar.png" width="20px"></th>
						</thead>
						<tbody>
						<?php 
							$l = new Lembrete();
							$lemb = $l->retornarTodosLembretes();
							foreach($lemb as $l){
								if($l->getIdProfessor() == $professor->getIdProfessor()){
									echo '<tr>';
										echo '<td>'.Util::arrumaData($l->getDataLembrete()).'</td>';
										echo '<td>'.$l->getConteudo().'</td>';
										echo '<td width="10%" class="text-center"><a href="?e='.$l->getIdLembrete().'"><img src="img/deletar.png" width="20px"></a></td>';
									echo '</tr>';
								}
							}
						?>
						</tbody>
					</table>
					<a href="cadLembrete.php" class="large-3 button tiny">Novo</a>
				</fieldset>
			</div>
		</div>
		<div class="large-12 columns">
		<hr>
			<?php include('footer.php')?>
		</div>		
	</div>
</body>
<script>
  $(document).foundation();
</script>
</html>