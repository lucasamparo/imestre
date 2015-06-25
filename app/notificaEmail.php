<?php 
	require_once('../models/bootstrap.php');
	session_start();
	
	if(!(isset($_SESSION['novoId']))){
		$_SESSION['novoId'] = 2;
	}
	if(!(isset($_SESSION['codigo']))){
		$_SESSION['codigo'] = 'E29E2DA975C06AF48ACE';
	}
	if(!(isset($_SESSION['email']))){
		$_SESSION['email'] = 'lucasamparo.ti@gmail.com';
	}
	if(!(isset($_SESSION['nomeCadastro']))){
		$_SESSION['nomeCadastro'] = 'Lucas Amparo Barbosa';
	}
	
	$para = $_SESSION['email'];
	$nome = $_SESSION['nomeCadastro'];
	
	//Enviado email com PHPMailer
	require_once('../libs/phpmailer/class.phpmailer.php');
	
	$mail = new PHPMailer();
	$mail->isSMTP();
	
	//configurando o Gmail
	$mail->Port = '465';
	$mail->Host = 'beta-hospedandosites.com.br';
	$mail->isHTML(true);
	$mail->Mailer = 'smtp';
	$mail->SMTPSecure = 'ssl';
	$mail->SMTPAuth = true; 
	$mail->Username = 'no-reply@imestre.com';
	$mail->Password = 'n0r3ply';
	$mail->SingleTo = true;
	
	$assunto = "Novo Cadastro no iMestre";
	
	//Conteúdo do email
	$mensagem = "Parabéns, Professor ".$nome."<br>";
	$mensagem .= 'Clique <a href="http://www.imestre.com/validarCadastro.php?id='.$_SESSION['novoId'].'&v='.$_SESSION['codigo'].'">Aqui</a> para validar seu cadastro!<br>';
	$mensagem .= '<br><br>Equipe iMestre.';
	
	
	$mail->From = "no-reply@imestre.com";
	$mail->FromName = "Equipe iMestre";
	$mail->addAddress($para);
	$mail->Subject = $assunto;
	$mail->msgHTML($mensagem);
	
	if(!$mail->Send()){
		echo "Erro: ".$mail->ErrorInfo;
	}
	//mail($para, $assunto, $mensagem, $headers);
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
		<p class="text-center"><a href="http://<?= explode("@", $_SESSION['email'])[1]?>" target="_blank" class="large-4 button">ACESSAR EMAIL!</a></p>
		<div class="large-12 columns">
		<hr>
			<?php include('footer.php')?>
		</div>
	</div>
</body>
</html>