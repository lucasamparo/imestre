<?php 
	require_once('../models/bootstrap.php');
	session_start();
?>
<html>
<head>
<title>iMestre :: Cadastro de Novo Usu�rio</title>
<link rel="stylesheet" type="text/css" href="css/foundation.css">
</head>
<body>
	<div class="row collapse">
		<div class="large-12 columns">
			<center><a href="index.php"><img src="./img/logo.png" width="400"></a></center>
			<hr>
		</div>
		<h3 class="large-12 columns text-center">Confirma��o de Novo Usu�rio</h3>
		<div class="large-1 columns">&nbsp;</div>
		<?php 
			$v = $_GET['v'];
			$idProfessor = $_GET['id'];
			$u = new Professor();
			$u->setIdProfessor($idProfessor);
			$prof = $u->retornaProfessorPorId();
			if($prof->getValidador() == $v){
				echo '<div class="large-12 columns text-center">';
					echo '<p>Parab�ns, Professor '.$prof->getNomeProfessor().'.</p>';
					echo '<p>Agora voc� faz parte da Comunidade iMestre. J� pode come�ar a utilizar o seu sistema!</p>';
					echo '<p><small>Clique no logotipo do sistema para acessar a �rea de login</small></p>';
				echo '</div>';
				$prof->validarCadastro();
			} else {
				echo '<div class="large-12 columns text-center">';
					echo '<p>O c�digo de valida��o n�o � valido!</p>';
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