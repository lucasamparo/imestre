<?php 
	require_once('../models/bootstrap.php');
		
	if(isset($_POST['login'])){
		$mensagem = "";
		$p = new Professor();
		$ret = $p->validarAcesso($_POST['login'], $_POST['senha']);
		echo "bla";
		if($ret){
			header('Location: inicio.php');
		} else {
			$mensagem = "Usuário ou Senha Inválidos!!";
		}
	}
?>
<html>
<head>
<title>iMestre :: Login</title>
<link rel="stylesheet" type="text/css" href="css/foundation.css">
</head>
<body>
<div class="row">
	<div class="row collapse">
		<br><br>
		<div class="large-2 medium-2 small-1 columns">&nbsp;</div>
		<div class="large-8 medium-8 small-10 columns">
			<div class="large-12 columns">
				<center><img src="./img/logo.png" width="400"></center>
			</div>
			<div class="large-2 columns">&nbsp;</div>
			<div class="large-8 columns end">
				<form method="post" action="index.php">
					<fieldset>
						<legend>Acesso ao iMestre</legend>
						<div class="large-12 columns">
							<label>Login:</label>
								<input type="text" name="login" maxlength="20" />
						</div>
						<div class="large-12 columns">
							<label>Senha:</label>
								<input type="password" name="senha" />
						</div>
						<div class="large-6 columns">
							<input type="submit" name="logar" value="Conectar" class="large-12 button"/>
						</div>
						<div class="large-12 columns text-center">
							<?php 
								echo $mensagem;
							?>
						</div>
					</fieldset>
				</form>
			</div>
		</div>
		<div class="large-2 medium-2 small-1 columns">&nbsp;</div>
	</div>
</div>
</body>
<script>
  $(document).foundation();
</script>
</html>