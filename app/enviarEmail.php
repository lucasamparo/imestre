<?php
	require_once('../models/bootstrap.php');
	require_once("../libs/phpmailer/class.phpmailer.php");
	session_start();
	if(!($_SESSION['logado'])){
		header('Location: index.php');
	}
	$mensagem = "";
	
	if(isset($_POST['email'])){
		$mail = new PHPMailer();
		$mail->IsSMTP();
		$mail->Port = '465';
		$mail->Host = 'beta-hospedandosites.com.br';
		$mail->isHTML(true);
		$mail->Mailer = 'smtp';
		$mail->SMTPSecure = 'ssl';
		$mail->SMTPAuth = true;
		$mail->Username = 'no-reply@imestre.com';
		$mail->Password = 'n0r3ply';
		$mail->SingleTo = true;
		
		$assunto = $_POST['titulo'];
		
		//Conteúdo do email
		$mensagem = $_POST['conteudo'];
			
		
		$prof = new Professor();
		$prof->setIdProfessor($_SESSION['idProfessor']);
		$prof = $prof->retornaProfessorPorId();
		$mail->From = $prof->getEmail();
		$mail->FromName = $prof->getNomeProfessor();
		$emails = explode(",", $_POST['email']);
		foreach($emails as $e){
			$mail->addAddress($e);
		}
		$mail->Subject = $assunto;
		$mail->msgHTML($mensagem);
		
		if(!$mail->Send()){
			$mensagem = "Não foi possível enviar o email<br>";
			$mensagem .= "Informações: ".$mail->ErrorInfo;
		} else {
			$mensagem = "Email Enviado";
		}			
	}
?>
<html>
<head>
<title>iMestre :: Controle de e-Mails</title>
<link rel="stylesheet" type="text/css" href="css/foundation.css">
<link rel="stylesheet" type="text/css" href="css/basic_simplemodal.css">
<script language="JScript" src="js/vendor/jquery.js"></script>
<script language="JScript" src="js/vendor/modernizr.js"></script>
<script language="JScript" src="js/foundation.min.js"></script>
<script language="JScript" src='js/jquery.simplemodal.js'></script>
<script language="JScript" src='js/imestre.js'></script>
</head>
<body onload="arrumaMenu('email')">
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
			<h4 class="text-center">Mensagens</h4>
			<h5><?= $mensagem?></h5>
			<form method="post">
				<fieldset>
					<div class="large-12 columns">
						<label>Título</label>
							<input type="text" name="titulo">
					</div>
					<div class="large-12 columns">
						<label>Destinatário(s)<small>&nbsp;&nbsp;Use vírgulas para separar os e-mails</small></label>
							<input type="text" name="email">
					</div>
					<div class="large-12 columns">
						<label>Conteúdo</label>
							<textarea name="conteudo" rows="10"></textarea>
					</div>
					<div class="large-8 columns">&nbsp;</div>
					<div class="large-4 columns">
						<input type="submit" name="enviar" value="Enviar Email" class="large-12 button">
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
