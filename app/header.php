<?php
	echo '<div class="large-4 columns">
			<a href="inicio.php"><img src="./img/logo.png" width="250"></a>
		</div>
		<div class="large-5 columns">
			<div class="large-12">&nbsp;</div>
				<div class="large-12">
					&nbsp;
					<!-- futuro ad -->
				</div>
			</div>
		<div class="large-3 columns">
			<div class="row collapse">
				<div class="large-12 columns">
					<label class="text-right">Bem Vindo Professor '.explode(" ",$_SESSION['nomeProfessor'])[1].'</label>
				</div>
				<div class="large-12 columns">
					<label class="text-right"><a href="chamados.php">Chamados</a></label>
				</div>
				<div class="large-12 columns">
					<label class="text-right"><a href="logout.php">Logout</a></label>
				</div>
			</div>
		</div>
		<div class="large-12 columns">
			<hr>
		</div>';
?>