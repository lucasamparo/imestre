<?php
	require_once('../models/bootstrap.php');
	session_start();
	if(!($_SESSION['logado'])){
		header('Location: index.php');
	}	
	
	if(isset($_POST['nomeInstituicao'])){
		$inst = new Instituicao();
		$inst->setNomeInstituicao($_POST['nomeInstituicao']);
		$media = $_POST['media'];
		$inst->setMedia($media);
		$inst->setLogradouro($_POST['logradouro']);
		$inst->setNumero($_POST['numero']);
		$inst->setBairro($_POST['bairro']);
		$inst->setCidade($_POST['cidade']);
		$inst->setTelContato($_POST['telContato']);
		$inst->inserirInstituicao();
	}
?>
<html>
<head>
<title>iMestre :: Cadastro de Instituição - Professor <?php echo $_SESSION['nomeProfessor'];?></title>
<link rel="stylesheet" type="text/css" href="css/foundation.css">
<link rel="stylesheet" type="text/css" href="css/basic_simplemodal.css">
<script language="JScript" src="js/vendor/jquery.js"></script>
<script language="JScript" src="js/vendor/modernizr.js"></script>
<script language="JScript" src="js/foundation.min.js"></script>
<script language="JScript" src='js/jquery.simplemodal.js'></script>
<script language="JScript" src='js/imestre.js'></script>
</head>
<body onload="arrumaMenu('cadInstituicao')">
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
			<h4 class="text-center">Cadastro de Instituição</h4>
			<form method="post">
				<fieldset>
					<div class="large-10 columns">
						<label>Nome da Instituição:</label>
							<input type="text" name="nomeInstituicao" >
					</div>
					<div class="large-2 columns">
						<label>Média:</label>
							<input type="text" name="media">
					</div>
					<div class="large-10 columns">
						<label>Logradouro:</label>
							<input type="text" name="logradouro" >
					</div>
					<div class="large-2 columns">
						<label>Número:</label>
							<input type="text" name="numero">
					</div>
					<div class="large-4 columns">
						<label>Bairro:</label>
							<input type="text" name="bairro">
					</div>
					<div class="large-4 columns">
						<label>Cidade:</label>
							<input type="text" name="cidade">
					</div>
					<div class="large-4 columns">
						<label>Tel. Contato:</label>
							<input type="tel" name="telContato">
					</div>
					<div class="large-8 columns">&nbsp;</div>
					<div class="large-4 columns">
						<input type="submit" class="button large-12" value="Salvar">
					</div>
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