<?php 
	require_once('../models/bootstrap.php');
	session_start();
	$mensagem = "";
	
	if(isset($_POST['nome'])){
		$p = new Professor();
		$p->setAreaAtuacao($_POST['area']);
		$p->setBairro($_POST['bairro']);
		$cep = $_POST['cep'];
		$cep = str_replace("-", "", $cep);
		$p->setCep($cep);
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
		$p->setLattes($_POST['lattes']);
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
<script language="JScript" src="js/vendor/jquery.js"></script>
<script language="JScript" src="js/imestre.js"></script>
<script type="text/javascript">
	$(document).ready(function(){
		$('#email').blur(function(){
			var email = $('#email').val();
			//Validando o email
			if(!validaEmail(email)){
				$('#msgEmail').html('Email inválido!');
				$('#email').css('border-color','red');
				$('#btSalvar').bind('click',false);
				$('#btSalvar').css('color','darkgrey');
				return;	
			}
			//Validando se não tem na base
			$.ajax({
				 url:    "validaEmail.php",
				 type:   "get",
				 dataType:"json",
				 data:   "e="+email,
				 async: false,
				 success: function(data){
					if(data == 'usado'){
						//alert('já está cadastrado');
						$('#email').css('border-color','red');
						$('#btSalvar').bind('click',false);
						$('#btSalvar').css('color','darkgrey');
						$('#btSalvar').css('cursor','url(img/proibido.png),default');
						$('#msgEmail').html('Email já em uso!');
					} else {
						$('#msgEmail').html('Email válido e livre para uso!');
						$('#btSalvar').bind('click',true);
						$('#btSalvar').css('color','white');
						$('#email').css('border-color','green');
					}
				 },
				 error: function(XMLHttpRequest, textStatus, errorThrown){
					 console.log(errorThrown);
				 }
			});
		});

		$('#cep').blur(function(){
			var cep = $('#cep').val();
			$.ajax({
				 url:    "http://viacep.com.br/ws/"+cep+"/json/",
				 type:   "get",
				 dataType:"json",
				 async: false,
				 success: function(data){
					if(data != null){
						$('#logradouro').val(data.logradouro);
						$('#cidade').val(data.localidade);
						$('#bairro').val(data.bairro);
						$('#pais').val('Brasil');
						$('#estado').val(data.uf);
						$('#numero').focus();
					}					
				 },
				 error: function(XMLHttpRequest, textStatus, errorThrown){
					 console.log(errorThrown);
				 }
			});
		});

		$('#login').blur(function (){
			var login = $('#login').val();
			//Validando se não tem na base
			$.ajax({
				 url:    "verificaLogin.php",
				 type:   "get",
				 dataType:"json",
				 data:   "l="+login,
				 async: false,
				 success: function(data){
					if(data == 'usado'){
						//alert('já está cadastrado');
						$('#login').css('border-color','red');
						$('#btSalvar').bind('click',false);
						$('#btSalvar').css('color','darkgrey');
						$('#msgLogin').html('Login já em uso!');
					} else {
						$('#msgLogin').html('Login válido e livre para uso!');
						$('#btSalvar').bind('click',true);
						$('#btSalvar').css('color','white');
						$('#login').css('border-color','green');
					}
				 }
			});
		});
	});
</script>
</head>
<body>
	<div class="row collapse">
		<div class="large-12 columns">
			<center><a href="index.php"><img src="./img/logo.png" width="400"></a></center>
			<hr>
		</div>
		<h3 class="large-12 columns text-center">Cadastro de Novo Usuário</h3>
		<h5 class="large-12 columns text-center"><?= $mensagem?></h5> 
		<div class="large-1 columns">&nbsp;</div>
		<form method="post" action="cadProfessor.php" class="large-10 columns end" novalidate>
			<fieldset>
				<legend>Dados Pessoais</legend>
				<div class="large-9 columns">
					<label>Nome Completo:</label>
						<input type="text" name="nome" required>
				</div>
				<div class="large-3 columns">
					<label>Id Lattes:</label>
						<input type="text" name="lattes">
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
						<input type="email" name="email" id="email" required>
						<small id="msgEmail"></small>
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
						<select name="estado" id="estado" required>
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
						<input type="text" name="pais" id="pais" placeholder="Brasil" required>
				</div>
				<div class="large-10 columns">
					<label>Logradouro:</label>
						<input type="text" name="logradouro" id="logradouro" required>
				</div>
				<div class="large-2 columns">
					<label>Número:</label>
						<input type="text" name="numero" id="numero" required>
				</div>
				<div class="large-6 columns">
					<label>Bairro:</label>
						<input type="text" name="bairro" id="bairro" required>
				</div>
				<div class="large-6 columns">
					<label>Cidade:</label>
						<input type="text" name="cidade" id="cidade" required>
				</div>
			</fieldset>
			<fieldset>
				<legend>Acesso ao Sistema</legend>
				<div class="large-6 columns">
					<label>Login:</label>
						<input type="text" name="login" id="login" required>
						<small id="msgLogin"></small>
				</div>
				<div class="large-6 columns">
					<label>Senha:</label>
						<input type="password" pattern="[a-zA-Z0-9]+" name="senha" required>
						<small id="msgSenha">Mínimo de 6 caracteres alfanuméricos</small>
				</div>
			</fieldset>
			<div class="row collapse">
				<div class="large-12 columns">
					<center><input type="submit" name="salvar" value="Cadastrar!" class="large-4 medium-6 small-8 button success" id="btSalvar"></center>
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