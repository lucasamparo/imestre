<?php
	require_once('../models/bootstrap.php');
	session_start();
	if(!($_SESSION['logado'])){
		header('Location: index.php');
	}
	
	if(isset($_GET['id'])){
		$q = new Questao();
		$q->setIdQuestao($_GET['id']);
		$questao = $q->retornaQuestaoPorId();
		$tipo = $questao->getTipo();
	}
?>
<html>
<head>
<title>iMestre :: Prévia de Questão - Professor <?php echo $_SESSION['nomeProfessor'];?></title>
<link rel="stylesheet" type="text/css" href="css/foundation.css">
<link rel="stylesheet" type="text/css" href="css/basic_simplemodal.css">
<script language="JScript" src="js/vendor/jquery.js"></script>
<script language="JScript" src="js/vendor/modernizr.js"></script>
<script language="JScript" src="js/foundation.min.js"></script>
<script language="JScript" src='js/jquery.simplemodal.js'></script>
<script language="JScript" src='js/imestre.js'></script>
</head>
<body>
	<div class="row"><!-- Linha do Content -->
		<div class="large-12 columns">
			<h4 class="text-center">Prévia de Questão</h4>
			<fieldset>
				<b>Enunciado:<br></b>
				<?= $questao->getEnunciado()?><br><br>
				
				<b>Tipo de Questão:</b><br>
				<?= Util::retornaTipoQuestao($tipo)?><br><br>
				
				<?php 
					switch ($tipo){
						case 0:
							//Dissertativa
							echo '<b>Resposta:</b><br>';
							echo $questao->getResposta();
							break;
						case 1:
							//Múltipla Escolha
							$tmp = $questao->getAlternativas();
							$alt = explode(";", ltrim($tmp));
							echo '<b>Alternativas (Resposta em verde):</b><br>';
							$letras = range('a','e');
							for($i = 0; $i < 5; $i++){
								if($alt[$i] == $questao->getResposta()){
									echo '<div style="color: green"><b>'.$letras[$i].') '.$alt[$i].'</b><br></div>';
								} else {
									echo $letras[$i].') '.$alt[$i].'<br>';
								}
							}
							break;
						case 2:
							//Associativa
							$tmp = utf8_encode($questao->getAlternativas());
							$c = get_object_vars(json_decode($tmp));
							echo '<div class="large-6 columns">';
								echo '<h5>Coluna 1</h5>';
								$c1 = $c['1'];
								$c1 = explode(";",$c1);
								foreach($c1 as $x){
									echo utf8_decode($x)."<br>";
								}
							echo '</div>';
							echo '<div class="large-6 columns">';
								echo '<h5>Coluna 2</h5>';
								$c2 = $c['2'];
								$c2 = explode(";",$c2);
								foreach($c2 as $x){
									echo utf8_decode($x)."<br>";
								}
							echo '</div>';
							break;
					}
				?>			
			</fieldset>
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