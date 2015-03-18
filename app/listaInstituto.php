<?php
	require_once('../models/bootstrap.php');
	session_start();
	if(!($_SESSION['logado'])){
		header('Location: index.php');
	}
?>
<html>
<head>
<title>iMestre :: Listagem de Instituições - Professor <?php echo $_SESSION['nomeProfessor'];?></title>
<link rel="stylesheet" type="text/css" href="css/foundation.css">
<link rel="stylesheet" type="text/css" href="css/basic_simplemodal.css">
<script language="JScript" src="js/vendor/jquery.js"></script>
<script language="JScript" src="js/vendor/modernizr.js"></script>
<script language="JScript" src="js/foundation.min.js"></script>
<script language="JScript" src='js/jquery.simplemodal.js'></script>
<script language="JScript" src='js/imestre.js'></script>
<script language="JScript">
function completaEdicao(codigo){
	$('#edicao').css('display','inline');
	retorno = wsGeral('wsInstituicao.php?id='+codigo);
	alert(retorno);
}
</script>
</head>
<body onload="arrumaMenu('listaInstituicao')">
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
			<?php include('sidebar.php');?>
		</div>
		<div class="large-8 columns" style="border-left-style: solid; border-width: 1px;">
			<?php 
				$inst = new Instituicao();
				$instituicoes = $inst->retornaTodasInstituicoes();
			?>
			<table class="large-12">
				<thead>
					<th width="60%" class="text-center">Instituição</th>
					<th width="20%" class="text-center">Telefone</th>
					<th width="10%" class="text-center">Média</th>
					<th width="10%" class="text-center"><img src="img/editar.png" width="20"></th>
				</thead>
				<tbody>
					<?php 
						if(count($instituicoes) == 0){
							echo '<td colspan="4" class="text-center">Nenhuma Instituição Cadastrada!</td>';
						} else {
							foreach($instituicoes as $it){
								echo '<tr>';
									echo '<td>'.$it->getNomeInstituicao().'</td>';
									echo '<td>'.$it->getTelContato().'</td>';
									echo '<td>'.$it->getMedia().'</td>';
									echo '<td class="text-center"><img src="img/editar.png" width="20" style="cursor: pointer;" onclick="completaEdicao('.$it->getIdInstituicao().')"></td>';
								echo '</tr>';
							}
						}						
					?>
				</tbody>
			</table>
			<div style="display: none" id="edicao">
				<h4 class="text-center" id="tituloEdicao">Editando Insituição</h4>
				<form method="post">
					<fieldset>
						<div class="large-10 columns">
							<label>Nome da Instituição:</label>
								<input type="text" name="nomeInstituicao" id="nomeInsituicao">
						</div>
						<div class="large-2 columns">
							<label>Média:</label>
								<input type="text" name="media" id="media">
						</div>
						<div class="large-10 columns">
							<label>Logradouro:</label>
								<input type="text" name="logradouro" id="logradouro">
						</div>
						<div class="large-2 columns">
							<label>Número:</label>
								<input type="text" name="numero" id="numero">
						</div>
						<div class="large-4 columns">
							<label>Bairro:</label>
								<input type="text" name="bairro" id="bairro">
						</div>
						<div class="large-4 columns">
							<label>Cidade:</label>
								<input type="text" name="cidade" id="cidade">
						</div>
						<div class="large-4 columns">
							<label>Tel. Contato:</label>
								<input type="tel" name="telContato" id="telContato">
						</div>
						<div class="large-8 columns">&nbsp;</div>
						<div class="large-4 columns">
							<input type="submit" class="button large-12" value="Atualizar">
						</div>
					</fieldset>
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