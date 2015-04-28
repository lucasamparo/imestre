<?php
	require_once('../models/bootstrap.php');
	session_start();
	if(!($_SESSION['logado'])){
		header('Location: index.php');
	}
?>
<html>
<head>
<title>iMestre :: Listagem de Avalia��es - Professor <?php echo $_SESSION['nomeProfessor'];?></title>
<link rel="stylesheet" type="text/css" href="css/foundation.css">
<link rel="stylesheet" type="text/css" href="css/basic_simplemodal.css">
<script language="JScript" src="js/vendor/jquery.js"></script>
<script language="JScript" src="js/vendor/modernizr.js"></script>
<script language="JScript" src="js/foundation.min.js"></script>
<script language="JScript" src='js/jquery.simplemodal.js'></script>
<script language="JScript" src='js/imestre.js'></script>
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
			<h4 class="text-center">Avalia��es Pendentes</h4>
			<table class="large-12">
				<thead>
					<th width="15%">Data</th>
					<th width="15%">Turma</th>
					<th width="20%">N� Quest�es</th>
					<th width="10%" class="text-center"><img src="img/questoes.jpg" width="20px"></th>
					<th width="10%" class="text-center"><img src="img/visualizar.png" width="20px"></th>
				</thead>
				<tbody>
					<?php 
						$a = new Avaliacao();
						$avaliacoes = $a->retornarTodasAvaliacoes(date('Y-m-d'));
						foreach($avaliacoes as $a){
							echo '<tr>';
								echo '<td>'.$a->getDataAvaliacao().'</td>';
								echo '<td>'.$a->getTurma()->getNomeTurma().'</td>';
								echo '<td>'.count($a->getItemAvaliacao()).' Quest�es</td>';
								echo '<th width="10%" class="text-center"><img src="img/questoes.jpg" width="20px"></th>';
								echo '<th width="10%" class="text-center"><img src="img/visualizar.png" width="20px"></th>';
							echo '</tr>';
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