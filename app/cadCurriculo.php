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
	
	if(isset($_POST['titulo'])){
		if($_POST['titulo']){
			$itemSalvo = new Itemcurriculo();
			$itemSalvo->setTitulo($_POST['titulo']);
			$itemSalvo->setConteudo($_POST['conteudo']);
			$itemSalvo->setAno($_POST['ano']);
			$itemSalvo->setIdProfessor($_SESSION['idProfessor']);
			$itemSalvo->save();
		}	
	}
	if(isset($_POST['tituloEd'])){
		if($_POST['tituloEd']){
			$itemEditado = new Itemcurriculo();
			$itemEditado->setTitulo($_POST['tituloEd']);
			$itemEditado->setConteudo($_POST['conteudoEd']);
			$itemEditado->setAno($_POST['anoEd']);
			$itemEditado->setIdItemCurriculo($_POST['idItem']);
			$itemEditado->atualizaItemCurriculo();
		}
	}
	
	
	$items = $item->retornaTodosItensPorIdProfessor($professor->getIdProfessor());
?>
<html>
<head>
<title>iMestre :: Currículo - Professor <?php echo $_SESSION['nomeProfessor'];?></title>
<link rel="stylesheet" type="text/css" href="css/foundation.css">
<link rel="stylesheet" type="text/css" href="css/basic_simplemodal.css">
<script language="JScript" src="js/vendor/jquery.js"></script>
<script language="JScript" src="js/vendor/modernizr.js"></script>
<script language="JScript" src="js/foundation.min.js"></script>
<script language="JScript" src='js/jquery.simplemodal.js'></script>
<script language="JScript" src='js/imestre.js'></script>
<script language="JScript">
function abrir_modal(linha,codigo){
	$('#modal_editar').modal();
	i = 0;
	$('#tb_previa tr').each(function (){
		if(i == linha){
			$('#tituloEd').val($(this).children("td:nth-child(1)").text());
			$('#conteudoEd').val($(this).children("td:nth-child(2)").text());
			$('#anoEd').val($(this).children("td:nth-child(3)").text());
			$('#idItem').val(codigo);
		}
		i++;
	});
	return false;
}
</script>
</head>
<body onload="arrumaMenu('curriculo')">
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
			<h3 class="text-center">Currículo - Professor <?php echo $_SESSION['nomeProfessor'];?></h3>
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
						<label>Conteúdo:</label>
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
							<th class="text-center" width="25%">Título</th>
							<th class="text-center" width="50%">Conteúdo</th>
							<th class="text-center" width="15%">Ano</th>
							<th class="text-center" width="10%"><img src="img/editar.png" width="20px"></th>
						</thead>
						<tbody id="tb_previa">
							<?php
								$i = 0;
								foreach($items as $it){
									echo '<tr>';
										echo '<td>'.$it->getTitulo().'</td>';
										echo '<td>'.$it->getConteudo().'</td>';
										echo '<td>'.$it->getAno().'</td>';
										echo '<td class="text-center"><a href="#" onclick="abrir_modal('.$i.','.$it->getIdItemCurriculo().')"><img src="img/editar.png" width="20px"></a></td>';
									echo '</tr>'.PHP_EOL;
									$i++;
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
	<div id="modal_editar" style="display: none;">
		<form method="post" action="cadCurriculo.php">
			<fieldset>
				<legend style="color: black;">Editando Item do Currículo</legend>
				<div class="large-9 columns">
					<label>Título:</label>
						<input type="text" name="tituloEd" id="tituloEd" required>
				</div>
				<div class="large-3 columns">
					<label>Ano:</label>
						<input type="text" name="anoEd" id="anoEd" required>
				</div>
				<input type="hidden" name="idItem" id="idItem">
				<div class="large-12 columns">
					<label>Conteúdo:</label>
					<textarea name="conteudoEd" rows="4" cols="50" id="conteudoEd" required></textarea>
				</div>
				<div class="large-4 columns">&nbsp;</div>
				<div class="large-4 columns">&nbsp;</div>
				<div class="large-4 columns">
					<input type="submit" name="submeterEd" value="Salvar" class="button large-12">
				</div>					
			</fieldset>
		</form>
	</div>
</body>
<script>
  $(document).foundation();
</script>
</html>