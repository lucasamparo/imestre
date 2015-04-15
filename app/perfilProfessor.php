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
	$salvo = false;
	
	if(isset($_POST['nomeCompleto'])){
		$pAtual = new Professor();
		$pAtual->setIdProfessor($_SESSION['idProfessor']);
		$pAtual->setNome($_POST['nomeCompleto']);
		$pAtual->setNascimento($_POST['nascimento']);
		$pAtual->setTituloMax($_POST['titulo']);
		$pAtual->setAreaAtuacao($_POST['area']);
		$pAtual->setNivelAtuacao($_POST['nivel']);
		$pAtual->setEmail($_POST['email']);
		$pAtual->setTelCel($_POST['telCel']);
		$pAtual->setCep($_POST['cep']);
		$pAtual->setEstado($_POST['estado']);
		$pAtual->setPais($_POST['pais']);
		$pAtual->setLogradouro($_POST['logradouro']);
		$pAtual->setNumero($_POST['numero']);
		$pAtual->setBairro($_POST['bairro']);
		$pAtual->setCidade($_POST['cidade']);
		$pAtual->atualizaProfessor();
		$salvo = true;
	}
?>
<html>
<head>
<title>iMestre :: Editar Perfil - Professor <?php echo $_SESSION['nomeProfessor'];?></title>
<link rel="stylesheet" type="text/css" href="css/foundation.css">
<script language="JScript" src="js/vendor/jquery.js"></script>
<script language="JScript" src="js/vendor/modernizr.js"></script>
<script language="JScript" src="js/foundation.min.js"></script>
<script language="JScript" src='js/jquery.simplemodal.js'></script>
<script language="JScript" src='js/imestre.js'></script>
</head>
<body onload="arrumaMenu('perfil')">
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
			<h4 class="text-center">Perfil - Professor <?php echo $_SESSION['nomeProfessor'];?></h4>
			<div class="large-12 columns">
				<?php 
					if($salvo){
						echo 'Dados Salvos com Sucesso!';
					}
				?>
			</div>
			<form method="post" action="#">
				<fieldset>
					<legend>Dados Pessoais</legend>
					<div class="large-12 columns">
						<label>Nome Completo:</label>
							<input type="text" name="nomeCompleto" value="<?php echo $professor->getNomeProfessor();?>">
					</div>
					<div class="large-6 columns">
						<label>Data Nascimento:</label>
							<input type="date" name="nascimento" value="<?php echo $professor->getNascimento();?>">
					</div>
					<div class="large-6 columns">
						<label>Título Máximo:</label>
							<select name="titulo">
								<option value="0" <?php if($professor->getTituloMax() == 0){ echo "selected";}?>>Técnico</option>
								<option value="1" <?php if($professor->getTituloMax() == 1){ echo "selected";}?>>Graduação</option>
								<option value="2" <?php if($professor->getTituloMax() == 2){ echo "selected";}?>>Especialização</option>
								<option value="3" <?php if($professor->getTituloMax() == 3){ echo "selected";}?>>Mestrado</option>
								<option value="4" <?php if($professor->getTituloMax() == 4){ echo "selected";}?>>Doutorado</option>
								<option value="5" <?php if($professor->getTituloMax() == 5){ echo "selected";}?>>Pós-Doutorado</option>
								<option value="6" <?php if($professor->getTituloMax() == 6){ echo "selected";}?>>Livre Docência</option>
							</select>
					</div>
					<div class="large-6 columns">
						<label>Área de Atuação:</label>
							<input type="text" name="area" value="<?php echo $professor->getAreaAtuacao();?>" required>
					</div>
					<div class="large-6 columns">
						<label>Nível de Atuação:</label>
							<select name="nivel" required>
								<option value="0" <?php if($professor->getNivelAtuacao() == 0){ echo "selected";}?>>Infantil</option>
								<option value="1" <?php if($professor->getNivelAtuacao() == 1){ echo "selected";}?>>Fundamental</option>
								<option value="2" <?php if($professor->getNivelAtuacao() == 2){ echo "selected";}?>>Médio</option>
								<option value="3" <?php if($professor->getNivelAtuacao() == 3){ echo "selected";}?>>Técnico</option>
								<option value="4" <?php if($professor->getNivelAtuacao() == 4){ echo "selected";}?>>Superior</option>
								<option value="5" <?php if($professor->getNivelAtuacao() == 5){ echo "selected";}?>>Pós-graduação</option>
							</select>
					</div>
				</fieldset>
				<fieldset>
					<legend>Contato</legend>
						<div class="large-6 columns">
							<label>Email:</label>
								<input type="email" name="email" value="<?php echo $professor->getEmail();?>">
						</div>
						<div class="large-6 columns">
							<label>Tel. Celular:</label>
								<input type="tel" name="telCel" value="<?php echo $professor->getTelCel();?>">
						</div>
				</fieldset>
				<fieldset>
					<legend>Endereço</legend>
					<div class="large-4 columns">
						<label>CEP:</label>
							<input type="text" name="cep" id="cep" value="<?php echo $professor->getCep();?>">
					</div>
					<div class="large-4 columns">
						<label>Estado:</label>
							<select name="estado">
								<option value="AC" <?php if($professor->getEstado() == "AC"){echo "selected";}?>>Acre</option>
								<option value="AL" <?php if($professor->getEstado() == "AL"){echo "selected";}?>>Alagoas</option>
								<option value="AP" <?php if($professor->getEstado() == "AP"){echo "selected";}?>>Amapá</option>
								<option value="AM" <?php if($professor->getEstado() == "AM"){echo "selected";}?>>Amazonas</option>
								<option value="BA" <?php if($professor->getEstado() == "BA"){echo "selected";}?>>Bahia</option>
								<option value="CE" <?php if($professor->getEstado() == "CE"){echo "selected";}?>>Ceará</option>
								<option value="DF" <?php if($professor->getEstado() == "DF"){echo "selected";}?>>Distrito Federal</option>
								<option value="ES" <?php if($professor->getEstado() == "ES"){echo "selected";}?>>Espirito Santo</option>
								<option value="GO" <?php if($professor->getEstado() == "GO"){echo "selected";}?>>Goiás</option>
								<option value="MA" <?php if($professor->getEstado() == "MA"){echo "selected";}?>>Maranhão</option>
								<option value="MS" <?php if($professor->getEstado() == "MS"){echo "selected";}?>>Mato Grosso do Sul</option>
								<option value="MT" <?php if($professor->getEstado() == "MT"){echo "selected";}?>>Mato Grosso</option>
								<option value="MG" <?php if($professor->getEstado() == "MG"){echo "selected";}?>>Minas Gerais</option>
								<option value="PA" <?php if($professor->getEstado() == "PA"){echo "selected";}?>>Pará</option>
								<option value="PB" <?php if($professor->getEstado() == "PB"){echo "selected";}?>>Paraíba</option>
								<option value="PR" <?php if($professor->getEstado() == "PR"){echo "selected";}?>>Paraná</option>
								<option value="PE" <?php if($professor->getEstado() == "PE"){echo "selected";}?>>Pernambuco</option>
								<option value="PI" <?php if($professor->getEstado() == "PI"){echo "selected";}?>>Piauí</option>
								<option value="RJ" <?php if($professor->getEstado() == "RJ"){echo "selected";}?>>Rio de Janeiro</option>
								<option value="RN" <?php if($professor->getEstado() == "RN"){echo "selected";}?>>Rio Grande do Norte</option>
								<option value="RS" <?php if($professor->getEstado() == "RS"){echo "selected";}?>>Rio Grande do Sul</option>
								<option value="RO" <?php if($professor->getEstado() == "RO"){echo "selected";}?>>Rondônia</option>
								<option value="RR" <?php if($professor->getEstado() == "RR"){echo "selected";}?>>Roraima</option>
								<option value="SC" <?php if($professor->getEstado() == "SC"){echo "selected";}?>>Santa Catarina</option>
								<option value="SP" <?php if($professor->getEstado() == "SP"){echo "selected";}?>>São Paulo</option>
								<option value="SE" <?php if($professor->getEstado() == "SE"){echo "selected";}?>>Sergipe</option>
								<option value="TO" <?php if($professor->getEstado() == "TO"){echo "selected";}?>>Tocantins</option>
							</select>
					</div>
					<div class="large-4 columns">
						<label>País:</label>
							<input type="text" name="pais" value="<?php echo $professor->getPais();?>">
					</div>
					<div class="large-10 columns">
						<label>Logradouro:</label>
							<input type="text" name="logradouro" value="<?php echo $professor->getLogradouro();?>">
					</div>
					<div class="large-2 columns">
						<label>Número:</label>
							<input type="text" name="numero" value="<?php echo $professor->getNumero();?>">
					</div>
					<div class="large-6 columns">
						<label>Bairro:</label>
							<input type="text" name="bairro" value="<?php echo $professor->getBairro();?>">
					</div>
					<div class="large-6 columns">
						<label>Cidade:</label>
							<input type="text" name="cidade" value="<?php echo $professor->getCidade();?>">
					</div>
				</fieldset>
				<div class="row collapse">
					<div class="large-4 columns">
						<a href="#" class="button large-12">Trocar Senha?</a>
					</div>
					<div class="large-4 columns">&nbsp</div>
					<div class="large-4 columns">
						<input type="submit" value="Atualizar Dados" name="submeter" class="button large-12">
					</div>
				</div>
			</form>
		</div>
	</div>
	<div class="large-12 columns">
			<?php include('footer.php')?>
	</div>
</body>
<script>
  $(document).foundation();
</script>
</html>