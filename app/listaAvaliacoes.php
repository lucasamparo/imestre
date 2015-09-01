<?php
	require_once('../models/bootstrap.php');
	session_start();
	if(!($_SESSION['logado'])){
		header('Location: index.php');
	}
?>
<html>
<head>
<title>iMestre :: Listagem de Avaliações - Professor <?php echo $_SESSION['nomeProfessor'];?></title>
<link rel="stylesheet" type="text/css" href="css/foundation.css">
<link rel="stylesheet" type="text/css" href="css/basic_simplemodal.css">
<script language="JScript" src="js/vendor/jquery.js"></script>
<script language="JScript" src="js/vendor/modernizr.js"></script>
<script language="JScript" src="js/foundation.min.js"></script>
<script language="JScript" src='js/jquery.simplemodal.js'></script>
<script language="JScript" src='js/imestre.js'></script>
<script language="JScript">
$(document).ready(function(){
	$('#btPassadas').click(function(){
		$('#passadas').css('display','inline');
		$('#futuras').css('display','none');
	});
	$('#btFuturas').click(function(){
		$('#passadas').css('display','none');
		$('#futuras').css('display','inline');
	});
});
</script>
</head>
<body onload="arrumaMenu('listaAvaliacoes')">
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
			<h4 class="text-center">Avaliações Cadastradas</h4>
			<div class="large-12 columns">
				<div class="large-3 columns">
					<a href="#" class="large-12 button tiny" id="btPassadas">Passadas</a>
				</div>
				<div class="large-3 columns end">
					<a href="#" class="large-12 button tiny" id="btFuturas">Futuras</a>
				</div>
			</div>
			<table class="large-12" id="passadas" style="display: none">
				<thead>
					<th width="15%">Data</th>
					<th width="15%">Turma</th>
					<th width="20%">Nº Questões</th>
					<th width="10%" class="text-center"><img src="img/visualizar.png" width="20px"></th>
					<th width="10%" class="text-center"><img src="img/avaliacao.png" width="30px"></th>
				</thead>
				<tbody>
					<?php 
						$a = new Avaliacao();
						$avaliacoes = $a->retornarTodasAvaliacoes(date('Y-m-d'),'<=');
						foreach($avaliacoes as $a){
							if($a->getTurma()->getInstituicao()->getProfessor()->getIdProfessor() != $_SESSION['idProfessor']){
								echo '<tr>';
									echo '<td>'.Util::arrumaData($a->getDataAvaliacao()).'</td>';
									echo '<td>'.$a->getTurma()->getNomeTurma().'</td>';
									echo '<td>'.count($a->getItemAvaliacao()).' Questões</td>';
									echo '<td class="text-center"><a href="verAvaliacao.php?id='.$a->getIdAvaliacao().'" target="_blank"><img src="img/visualizar.png" width="20px"></a></td>';
									echo '<td class="text-center"><a href="lancaNota.php?id='.$a->getIdAvaliacao().'"><img src="img/avaliacao.png" width="30px"></a></td>';
								echo '</tr>';
							}							
						}
					?>
				</tbody>
			</table>
			<table class="large-12" id="futuras">
				<thead>
					<th width="15%">Data</th>
					<th width="15%">Turma</th>
					<th width="20%">Nº Questões</th>
					<th width="10%" class="text-center"><img src="img/questoes.jpg" width="20px"></th>
					<th width="10%" class="text-center"><img src="img/visualizar.png" width="20px"></th>
				</thead>
				<tbody>
					<?php 
						$a = new Avaliacao();
						$avaliacoes = $a->retornarTodasAvaliacoes(date('Y-m-d'),'>=');
						foreach($avaliacoes as $a){
							if($a->getTurma()->getInstituicao()->getProfessor()->getIdProfessor() != $_SESSION['idProfessor']){
								echo '<tr>';
									echo '<td>'.Util::arrumaData($a->getDataAvaliacao()).'</td>';
									echo '<td>'.$a->getTurma()->getNomeTurma().'</td>';
									echo '<td>'.count($a->getItemAvaliacao()).' Questões</td>';
									echo '<td class="text-center"><a href="inserirQuestoes.php?id='.$a->getIdAvaliacao().'"><img src="img/questoes.jpg" width="20px"></a></td>';
									echo '<td class="text-center"><a href="verAvaliacao.php?id='.$a->getIdAvaliacao().'" target="_blank"><img src="img/visualizar.png" width="20px"></a></td>';
								echo '</tr>';
							}							
						}
					?>
				</tbody>
			</table>
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