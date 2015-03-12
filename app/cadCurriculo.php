<?php
	require_once('../models/bootstrap.php');
	session_start();
	if(!($_SESSION['logado'])){
		header('Location: index.php');
	}
	$p = new Professor();
	$item = new Itemcurriculo();
	$p->setIdProfessor($_SESSION['idProfessor']);
	$professor = $p->retornaProfessorPorId();
	$nome = explode(" ",$professor->getNome());
	
	if($_POST['titulo']){
		$itemSalvo = new Itemcurriculo();
		$itemSalvo->setTitulo($_POST['titulo']);
		$itemSalvo->setConteudo($_POST['conteudo']);
		$itemSalvo->setAno($_POST['ano']);
		$itemSalvo->setProfessor($_SESSION['idProfessor']);
		$itemSalvo->save();
	}
?>
<html>
<head>
<title>iMestre :: Currículo - Professor <?php echo $professor->getNome();?></title>
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
		<div class="large-4 columns">
			<ul class="side-nav" role="navigation" title="Link List">
			   <li role="menuitem"><a href="#">Link 1</a></li>
			   <li role="menuitem"><a href="#">Link 2</a></li>
			   <li role="menuitem"><a href="#">Link 3</a></li>
			   <li role="menuitem"><a href="#">Link 4</a></li>
			 </ul>
		</div>
		<div class="large-8 columns" style="border-left-style: solid; border-width: 1px;">
			<h3 class="text-center">Currículo - Professor <?php echo $professor->getNome();?></h3>
			<form method="post" action="cadCurriculo.php">
				<fieldset>
					<legend>Novo Item do Currículo</legend>
					<div class="large-9 columns">
						<label>Título:</label>
							<input type="text" name="titulo" required>
					</div>
					<div class="large-3 columns">
						<label>Ano:</label>
							<input type="text" name="ano" required>
					</div>
					<div class="large-12 columns">
						<textarea name="conteudo" rows="4" cols="50" required></textarea>
					</div>
					<div class="large-4 columns">&nbsp;</div>
					<div class="large-4 columns">&nbsp;</div>
					<div class="large-4 columns">
						<input type="submit" name="submeter" value="Salvar" class="button large-12">
					</div>					
				</fieldset>
			</form>
			<form>
				<fieldset>
					<legend>Prévia</legend>
					<table class="large-12">
						<thead>
							<th class="text-center" width="30%">Título</th>
							<th class="text-center" width="55%">Conteúdo</th>
							<th class="text-center" width="15%">Ano</th>
						</thead>
						<tbody>
							<?php
								$items = $item->retornaTodosItensPorIdProfessor($professor->getIdProfessor());
								foreach($items as $it){
									echo '<tr>';
										echo '<td>'.$it->getTitulo().'</td>';
										echo '<td>'.$it->getConteudo().'</td>';
										echo '<td>'.$it->getAno().'</td>';
									echo '</tr>'.PHP_EOL;
								}
							?>
						</tbody>
					</table>
				</fieldset>
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