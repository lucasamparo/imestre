<?php 
	require_once('../models/bootstrap.php');
	session_start();
	
	if(isset($_POST['nome'])){
		$p = new Professor();
		$p->setAreaAtuacao($_POST['area']);
		$p->setBairro($_POST['bairro']);
		$p->setCep($_POST['cep']);
		$string = date('YmdHis');
		$string = $string + 123456;
		$string = $string . "ABCDEF";
		$validador = md5($string);
		$validador = strtoupper($validador);
		$validador = substr($validador, 0, 20); 
		$p->setValidador($validador);
		$p->setCidade($_POST['cidade']);
		$p->setEmail($_POST['email']);
		$p->setEstado($_POST['estado']);
		$p->setLogin($_POST['login']);
		$p->setLogradouro($_POST['logradouro']);
		$p->setNascimento($_POST['nascimento']);
		$p->setNivelAtuacao($_POST['nivel']);
		$p->setNomeProfessor($_POST['nome']);
		$p->setNumero($_POST['numero']);
		$p->setPais($_POST['pais']);
		$p->setSenha(md5($_POST['senha']));
		$p->setTelCel($_POST['telCel']);
		$p->setTituloMax($_POST['titulo']);
		$r = $p->inserirProfessor();
		if($r){
			$_SESSION['cadastrado'] = true;
			$_SESSION['nomeCadastro'] = $_POST['nome'];
			$_SESSION['email'] = $_POST['email'];
			$_SESSION['codigo'] = $validador;
			$_SESSION['novoId'] = $p->getIdProfessor();
			header('Location: notificaEmail.php');
		}
	}
?>
<html>
<head>
<title>iMestre :: Cadastro de Novo Usuário</title>
<link rel="stylesheet" type="text/css" href="css/foundation.css">
</head>
<body>
	<div class="row collapse">
		<div class="large-12 columns">
			<center><a href="index.php"><img src="./img/logo.png" width="400"></a></center>
			<hr>
		</div>
		<h3 class="large-12 columns text-center">Cadastro de Novo Usuário</h3>
		<div class="large-1 columns">&nbsp;</div>
		<form method="post" action="cadProfessor.php" class="large-10 columns end">
			<fieldset>
				<legend>Dados Pessoais</legend>
				<div class="large-12 columns">
					<label>Nome Completo:</label>
						<input type="text" name="nome" required>
				</div>
				<div class="large-3 columns">
					<label>Nascimento:</label>
						<input type="date" name="nascimento" required>
				</div>
				<div class="large-3 columns">
					<label>Título Máximo:</label>
						<select name="titulo" required>
							<option value="0">Técnico</option>
							<option value="1">Graduação</option>
							<option value="2">Especialização</option>
							<option value="3">Mestrado</option>
							<option value="4">Doutorado</option>
							<option value="5">Pós-Doutorado</option>
							<option value="6">Livre Docência</option>
						</select>
				</div>
				<div class="large-3 columns">
					<label>Área de Atuação:</label>
						<input type="text" name="area" required>
				</div>
				<div class="large-3 columns">
					<label>Nível de Atuação:</label>
						<select name="nivel" required>
							<option value="0">Infantil</option>
							<option value="1">Fundamental</option>
							<option value="2">Médio</option>
							<option value="3">Técnico</option>
							<option value="4">Superior</option>
							<option value="5">Pós-graduação</option>
						</select>
				</div>
			</fieldset>
			<fieldset>
				<legend>Contato</legend>
				<div class="large-6 columns">
					<label>Email:</label>
						<input type="email" name="email" required>
				</div>
				<div class="large-6 columns">
					<label>Tel. Celular:</label>
						<input type="tel" name="telCel" required>
				</div>
			</fieldset>
			<fieldset>
				<legend>Endereço</legend>
				<div class="large-4 columns">
					<label>CEP:</label>
						<input type="text" name="cep" id="cep" required>
				</div>
				<div class="large-4 columns">
					<label>Estado:</label>
						<select name="estado" required>
							<option value="">Selecione</option>
							<option value="AC">Acre</option>
							<option value="AL">Alagoas</option>
							<option value="AP">Amapá</option>
							<option value="AM">Amazonas</option>
							<option value="BA">Bahia</option>
							<option value="CE">Ceará</option>
							<option value="DF">Distrito Federal</option>
							<option value="ES">Espirito Santo</option>
							<option value="GO">Goiás</option>
							<option value="MA">Maranhão</option>
							<option value="MS">Mato Grosso do Sul</option>
							<option value="MT">Mato Grosso</option>
							<option value="MG">Minas Gerais</option>
							<option value="PA">Pará</option>
							<option value="PB">Paraíba</option>
							<option value="PR">Paraná</option>
							<option value="PE">Pernambuco</option>
							<option value="PI">Piauí</option>
							<option value="RJ">Rio de Janeiro</option>
							<option value="RN">Rio Grande do Norte</option>
							<option value="RS">Rio Grande do Sul</option>
							<option value="RO">Rondônia</option>
							<option value="RR">Roraima</option>
							<option value="SC">Santa Catarina</option>
							<option value="SP">São Paulo</option>
							<option value="SE">Sergipe</option>
							<option value="TO">Tocantins</option>
						</select>
				</div>
				<div class="large-4 columns">
					<label>País:</label>
						<input type="text" name="pais" placeholder="Brasil" required>
				</div>
				<div class="large-10 columns">
					<label>Logradouro:</label>
						<input type="text" name="logradouro" required>
				</div>
				<div class="large-2 columns">
					<label>Número:</label>
						<input type="text" name="numero" required>
				</div>
				<div class="large-6 columns">
					<label>Bairro:</label>
						<input type="text" name="bairro" required>
				</div>
				<div class="large-6 columns">
					<label>Cidade:</label>
						<input type="text" name="cidade" required>
				</div>
			</fieldset>
			<fieldset>
				<legend>Acesso ao Sistema</legend>
				<div class="large-6 columns">
					<label>Login:</label>
						<input type="text" name="login" required>
				</div>
				<div class="large-6 columns">
					<label>Senha:</label>
						<input type="password" name="senha" required>
				</div>
			</fieldset>
			<div class="row collapse">
				<div class="large-12 columns">
					<center><input type="submit" name="salvar" value="Cadastrar!" class="large-4 medium-6 small-8 button success"></center>
				</div>
			</div>
		</form>
		<div class="large-12 columns">
		<hr>
			<?php include('footer.php')?>
		</div>
	</div>
</body>
</html>