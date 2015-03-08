<?php 
	session_start();
	if(!($_SESSION['cadastrado'])){
		header('Location: index.php');
	}
?>
<html>
<head>
<title>iMestre :: Cadastro Concluído</title>
<link rel="stylesheet" type="text/css" href="css/foundation.css">
</head>
<body>
	<div class="row collapse">
		<div class="large-12 columns">
			<center><img src="./img/logo.png" width="400"></center>
			<hr>
		</div>
		<h2 class="large-12 columns text-center">Parabéns!!</h2>
		<div class="large-12 columns text-center">
			<p>Cadastro Realizado com sucesso!</p>
			<p>Bem Vindo Professor <?php echo $_SESSION['nomeCadastro'];?></p>
			<p><a href="index.php">Clique aqui para acessar o iMestre</a></p>
		</div>
		<div class="large-12 columns">
			<hr>
			<?php include 'footer.php';?>
		</div>
	</div>
</body>
</html>