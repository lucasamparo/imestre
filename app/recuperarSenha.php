<?php 
	require_once('../models/bootstrap.php');
	session_start();
	$mensagem = "";
	$enviado = "";
	
?>
<html>
<head>
<title>iMestre :: Recuperando Acesso ao Sistema</title>
<link rel="stylesheet" type="text/css" href="css/foundation.css">
<script language="JScript" src="js/vendor/jquery.js"></script>
<script language="JScript" src="js/imestre.js"></script>
<script type="text/javascript">
	
</script>
</head>
<body>
	<div class="row collapse">
		<div class="large-12 columns">
			<center><a href="index.php"><img src="./img/logo.png" width="400"></a></center>
			<hr>
		</div>
		<h3 class="large-12 columns text-center">Recuperando acesso ao sistema</h3>
		<h5 class="large-12 columns text-center"><?= $mensagem?></h5> 
		<div class="large-12 columns">
			<form method="post" action="recuperarSenha.php">
				<div class="large-2 columns">&nbsp;</div>
				<div class="large-8 columns">
					<div class="large-9 columns">
						<label>Login:</label>
						<input type="text" name="usuario" required>
					</div>
					<div class="large-3 columns">
						<label>&nbsp;</label>
						<input type="submit" value="Recuperar" class="button tiny large-12">
					</div>
				</div>				
				<div class="large-2 columns">&nbsp;</div>
			</form>
		</div>
		
		<?php 
			if(isset($_POST['usuario'])){
				$p = new Professor();
				$p->setLogin($_POST['usuario']);
				if($p->validaLogin()){
					$prof = $p->retornarProfessorPorLogin();
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
					
					$assunto = "Recuperando Acesso ao iMestre";
					
					//Conteúdo do email
					$mensagem = " Professor ".$prof->getNomeProfessor()."<br>";
					$mensagem .= 'Clique <a href="http://imestre-lucasamparo.rhcloud.com/app/recuperarAcesso.php?id='.$prof->getIdProfessor().'">aqui</a> para cadastrar uma nova senha';
					$mensagem .= '<br><br>Equipe iMestre.';
					
					
					$mail->From = "no-reply@imestre.com";
					$mail->FromName = "Equipe iMestre";
					$mail->addAddress($prof->getEmail());
					$mail->Subject = $assunto;
					$mail->msgHTML($mensagem);
					
					$email = explode("@",$prof->getEmail());
					
					echo '<p class="text-center">Email para recuperação enviado para ***@'.$email[1].'</p>';
					echo '<p class="text-center"><a href="http://'.$email[1].'" target="_blank">Acessar Email</a></p>';
					if(!$mail->Send()){
						echo "Erro: ".$mail->ErrorInfo;
					}
				} else {
					echo '<p class="text-center">Usuário não cadastrado!</p>';
				}
			}
		?>
		
		<div class="large-12 columns">
		<hr>
			<?php include('footer.php')?>
		</div>
	</div>
</body>
</html>