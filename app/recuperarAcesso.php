<?php 
	require_once('../models/bootstrap.php');
	session_start();
	$mensagem = "";
	
	if(isset($_GET['id'])){
		if(isset($_POST['novaSenha'])){
			$p = new Professor();
			$p->setIdProfessor($_GET['id']);
			$prof = $p->retornaProfessorPorId();
			$prof->setSenha(md5($_POST['novaSenha']));
			$prof->atualizaProfessor();
			header('Location: index.php');
		}	
	}	
?>
<html>
<head>
<title>iMestre :: Recuperar Acesso - Nova Senha</title>
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
		<h3 class="large-12 columns text-center">Cadastro de Novo Usuário</h3>
		<h5 class="large-12 columns text-center"><?= $mensagem?></h5> 
		<form method="post" action="recuperarAcesso.php?id=<?= $_GET['id']?>">
			<div class="large-2 columns">&nbsp;</div>
			<div class="large-8 columns">
				<div class="large-9 columns">
					<label>Nova Senha:</label>
					<input type="password" name="novaSenha">
				</div>
				<div class="large-3 columns">
					<label>&nbsp;</label>
					<input type="submit" value="Recuperar" class="button tiny large-12">
				</div>
			</div>
			<div class="large-2 columns">&nbsp;</div>
		</form>
		<div class="large-12 columns">
		<hr>
			<?php include('footer.php')?>
		</div>
	</div>
</body>
</html>