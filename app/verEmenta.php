<?php
	require_once('../models/bootstrap.php');
	session_start();
	if(!($_SESSION['logado'])){
		header('Location: index.php');
	}
	
	if(isset($_GET['id'])){
		$idEmenta = $_GET['id'];
		$d = new Ementa();
		$d->setIdEmenta($idEmenta);
		$ementa = $d->retornaEmentaPorId();
		
		if(isset($_GET['e'])){
			$idItemEmenta = $_GET['e'];
			$i = new Itemementa();
			$i->setIdItemEmenta($idItemEmenta);
			$i->excluirItemEmenta();
			
			$ementa->reorganizarItens();
		}
	}
?>
<html>
<head>
<title>iMestre :: Visualização de Ementas - Professor <?php echo $_SESSION['nomeProfessor'];?></title>
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
			<h4 class="text-center">Visualização de Ementas - Ano <?= $ementa->getAno();?> - Disciplina <?= $ementa->getDisciplina()->getNomeDisciplina();?></h4>
			<fieldset>
				<table class="large-12">
					<thead>
						<th width="10%">Índice</th>
						<th width="80%">Conteúdo</th>
						<th width="10%" class="text-center"><img src="img/deletar.png" width="20px"></th>
					</thead>
					<tbody>
						<?php 
							$itens = $ementa->getItemementa();
							foreach($itens as $i){
								echo '<tr>';
									echo '<td>'.$i->getIndice().'</td>';
									echo '<td>'.$i->getConteudo().'</td>';
									echo '<td width="10%" class="text-center"><a href="verEmenta.php?id='.$_GET['id'].'&e='.$i->getIdItemementa().'"><img src="img/deletar.png" width="20px"></a></td>';
								echo '</tr>';
							}
						?>
					</tbody>
				</table>
				<a href="ementas.php?id=<?= $ementa->getDisciplina()->getIdDisciplina();?>" class="large-4 button">Voltar</a>
			</fieldset>
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