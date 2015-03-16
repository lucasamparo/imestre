<?php 
	require_once('../models/bootstrap.php');
	session_start();
	$_SESSION['logado'] = false;
	
	if(isset($_POST['login'])){
		$mensagem = "";
		$p = new Professor();
		//echo $_POST['login']." | ".md5($_POST['senha']).PHP_EOL;
		$ret = $p->validarAcesso($_POST['login'], $_POST['senha']);
		if($ret){
			$_SESSION['idProfessor'] = $ret->getIdProfessor();
			$_SESSION['nomeProfessor'] = $ret->getNome();
			$_SESSION['logado'] = true;
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
		<br>
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
						<div class="large-3 columns">&nbsp;</div>
						<div class="large-6 columns end">
							<input type="submit" name="logar" value="Conectar" class="large-12 button"/>
						</div>
						<div class="large-12 columns text-center" style="color: red">
							<?php 
								echo $mensagem;
							?>
						</div>
					</fieldset>
				</form>
			</div>
			<div class="large-12 columns">
				<center><a href="cadProfessor.php"><img src="./img/cadProfessor.png"></a></center>
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