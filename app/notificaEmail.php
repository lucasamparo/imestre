<?php 
	require_once('../models/bootstrap.php');
	session_start();
	
	$para = $_SESSION['email'];
	$nome = $_SESSION['nomeCadastro'];
	if(!(isset($_SESSION['novoId']))){
		$_SESSION['novoId'] = 2;
	}
	if(!(isset($_SESSION['codigo']))){
		$_SESSION['codigo'] = 'E29E2DA975C06AF48ACE';
	}
	$assunto = "Novo Cadastro no iMestre";
	
	//Conteúdo do email
	$mensagem = "Parabéns, Professor ".$nome."<br>";
	$mensagem .= 'Clique <a href="http://www.imestre.com/validarCadastro.php?id='.$_SESSION['novoId'].'&v='.$_SESSION['codigo'].'>Aqui</a> para validar seu cadastro!<br>';
	$mensagem .= '<br><br>Equipe iMestre.';
	
	//Cabeçalho do email
	$headers = "Content-Type:text/html; charset=UTF-8\n";
	$headers .= "From: imestre.com<no-reply@imestre.com>\n"; 
	$headers .= "X-Sender: <no-reply@imestre.com>\n"; 
	$headers .= "X-Mailer: PHP v".phpversion()."\n";
	$headers .= "X-IP: ".$_SERVER['REMOTE_ADDR']."\n";
	$headers .= "Return-Path: <contato@imestre.com>\n";
	$headers .= "MIME-Version: 1.0\n";
	
	mail($para, $assunto, $mensagem, $headers);
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
		<p class="text-center">Parabéns, <?= $_SESSION['nomeCadastro']?>! Agora falta pouco para utilizar o iMestre!</p>
		<p class="text-center">Verifique em seu e-Mail (<?= $_SESSION['email']?>) os próximos passos para validar o seu cadastro!</p>
		<p class="text-center"><a href="http://<?= explode("@", $_SESSION['email'])[1]?>" target="_blank">ACESSAR EMAIL!</a></p>
		<div class="large-12 columns">
		<hr>
			<?php include('footer.php')?>
		</div>
	</div>
</body>
</html>