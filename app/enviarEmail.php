<?php
	require_once('../models/bootstrap.php');
	require_once("../libs/phpmailer/class.phpmailer.php");
	session_start();
	if(!($_SESSION['logado'])){
		header('Location: index.php');
	}
	
	if(isset($_POST['email'])){
		$mail = new PHPMailer();
		$mail->IsSMTP();
		$mail->SMTPAuth = true;
		$mail->Username = "lucasamparo.ti@gmail.com";
		$mail->Password = "Lucas1993";
		$mail->Host = "smtp.gmail.com";
		$mail->Port = 465;
		$mail->From = "lucasamparo.ti@gmail.com";
		$mail->SMTPSecure = "ssl";
		$mail->FromName = "Lucas Amparo";
		$mail->AddAddress($_POST['email']);
		$mail->IsHTML(true);
		$mail->Subject = "Teste de Envio";
		$mail->Body = $_POST['conteudo'];
		
		$enviado = $mail->Send();
		
		if($enviado){
			echo "Email Enviado";
		} else {
			echo "Não foi possível enviar o email<br>";
			echo "Informações: ".$mail->ErrorInfo;
		}
	}
?>
<html>
<head>
<title>iMestre :: Controle de Emails - Professor <?php echo $_SESSION['nomeProfessor'];?></title>
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
		<div class="large-4 columns">
			<?php include('sidebar.php');?>
		</div>
		<div class="large-8 columns" style="border-left-style: solid; border-width: 1px;">
			<h4 class="text-class">Mensagens Enviadas</h4>
			<form method="post">
				<fieldset>
					<div class="large-12 columns">
						<label>Destinatário</label>
							<input type="email" name="email">
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
