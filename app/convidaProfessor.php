<?php 
	require_once('../models/bootstrap.php');
	session_start();
	$mensagem = "";
	
	if(isset($_POST['convidado'])){
		//Enviado email com PHPMailer
		require_once('../libs/phpmailer/class.phpmailer.php');
		$para = $_POST['convidado'];
		
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
		
		$assunto = "Convite para o iMestre";
		
		//Conteúdo do email
		$mensagem = "Olá. Você recebeu um convite para usar o iMestre!<br>";
		$mensagem .= 'Clique <a href="imestre-lucasamparo.rhcloud.com/app/cadProfessor.php">Aqui</a> e aproveite!<br>';
		$mensagem .= '<br><br>Equipe iMestre.';
		
		
		$mail->From = "no-reply@imestre.com";
		$mail->FromName = "Equipe iMestre";
		$mail->addAddress($para);
		$mail->Subject = $assunto;
		$mail->msgHTML($mensagem);
		
		if(!$mail->Send()){
			echo "Erro: ".$mail->ErrorInfo;
			$mensagem = "Falha no envio do Convite";
		} else {
			$mensagem = "Convite Enviado";
		}
	}	
	//mail($para, $assunto, $mensagem, $headers);
?>
<html>
<head>
<title>iMestre :: Convidar Novo Usuário</title>
<link rel="stylesheet" type="text/css" href="css/foundation.css">
<link rel="stylesheet" type="text/css" href="css/basic_simplemodal.css">
<script language="JScript" src="js/vendor/jquery.js"></script>
<script language="JScript" src="js/vendor/modernizr.js"></script>
<script language="JScript" src="js/foundation.min.js"></script>
<script language="JScript" src='js/jquery.simplemodal.js'></script>
<script language="JScript" src='js/jquery.dataTables.js'></script>
<script language="JScript" src='js/imestre.js'></script>
</head>
<body>
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
			<h3 class="large-12 columns text-center">Convidar Novo Usuário</h3>
			<p><?= $mensagem?></p>
		<div class="large-1 columns">&nbsp;</div>
		<div class="large-12 columns">
			<form method="post" action="convidaProfessor.php">
				<div class="large-8 columns">
					<label>E-Mail a ser convidado:</label>
					<input type="email" name="convidado">
				</div>
				<div class="large-2 columns">
					<label>&nbsp;</label>
					<input type="submit" value="Convidar" class="tiny button large-12">
				</div>
				<div class="large-2 columns">&nbsp;</div>
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