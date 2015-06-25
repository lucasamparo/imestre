<?php
require_once('../models/bootstrap.php');
session_start();
if(!($_SESSION['logado'])){
	header('Location: index.php');
}
?>
<html>
<head>
<title>iMestre :: Banco Privado de Questões - Professor <?php echo $_SESSION['nomeProfessor'];?></title>
<link rel="stylesheet" type="text/css" href="css/foundation.css">
<link rel="stylesheet" type="text/css" href="css/basic_simplemodal.css">
<script language="JScript" src="js/vendor/jquery.js"></script>
<script language="JScript" src="js/vendor/modernizr.js"></script>
<script language="JScript" src="js/foundation.min.js"></script>
<script language="JScript" src='js/jquery.simplemodal.js'></script>
<script language="JScript" src='js/imestre.js'></script>
</head>
<body onload="arrumaMenu('privado')">
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
			<h4 class="text-center">Banco Público de Questões</h4>
			<table class="large-12">
				<thead>
					<th>Enunciado</th>
					<th>Tipo</th>
					<th>Grau</th>
					<th class="text-center"><img src="img/visualizar.png" width="20px"></th>
				</thead>
				<tbody>
					<?php 
						$q = new Questao();
						$questoes = $q->retornaQuestaoPrivada();
						foreach($questoes as $q){
							echo '<tr>';
								echo '<td>'.$q->getEnunciado().'</td>';
								echo '<td>'.Util::retornaTipoQuestao($q->getTipo()).'</td>';
								echo '<td>Grau</td>';
								echo '<td class="text-center"><img src="img/visualizar.png" width="20px" style="cursor: pointer;" onclick="'."abrirJanela('verQuestao.php?id=".$q->getIdQuestao()."','400','350','50')".'"></td>';
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