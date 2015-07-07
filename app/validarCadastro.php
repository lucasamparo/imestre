<?php 
	require_once('../models/bootstrap.php');
	session_start();
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
		<h3 class="large-12 columns text-center">Confirmação de Novo Usuário</h3>
		<div class="large-1 columns">&nbsp;</div>
		<?php 
			$v = $_GET['v'];
			$idProfessor = $_GET['id'];
			$u = new Professor();
			$u->setIdProfessor($idProfessor);
			$prof = $u->retornaProfessorPorId();
			if($prof->getValidador() == $v){
				echo '<div class="large-12 columns text-center">';
					echo '<p>Parabéns, Professor '.$prof->getNomeProfessor().'.</p>';
					echo '<p>Agora você faz parte da Comunidade iMestre. Já pode começar a utilizar o seu sistema!</p>';
					echo '<p><small>Clique no logotipo do sistema para acessar a área de login</small></p>';
				echo '</div>';
				$prof->validarCadastro();
			} else {
				echo '<div class="large-12 columns text-center">';
					echo '<p>O código de validação não é valido!</p>';
					echo '<p>Por favor, entre em contato com a <a href="mailto:suporte@imestre.com">Equipe de Suporte</a>.</p>';
				echo '</div>';
			}
		?>
		<hr>
			<?php include('footer.php')?>
		</div>
	</div>
</body>
</html>