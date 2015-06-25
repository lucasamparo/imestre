<?php
require_once('../models/bootstrap.php');

$idQuestao = $_GET['id'];

$q = new Questao();
$q->setIdQuestao($idQuestao);
$q = $q->retornaQuestaoPorId();
$tipo = $q->getTipo();
?>
<html>
<head>
<title>Visualização de Questão</title>
<link rel="stylesheet" type="text/css" href="css/foundation.css">
</head>
<body>
<div class="row">
	<div class="large-12 columns">
		<label>Enunciado:</label>
		<p><?= $q->getEnunciado()?>
	</div>
	<div class="large-12 columns">
		<label>Tipo de Resposta</label>
		<p><?= Util::retornaTipoQuestao($tipo)?>
	</div>
	<div class="large-12 columns">
		<?php
			if($tipo == '0'){
				echo '<label>Resposta</label>';
				echo $q->getResposta();
			}
			if(($tipo == '1') || ($tipo == '2')){
				echo '<label>Alternativas</label>';
				
				$letras = array('a','b','c','d','e','f','g','h','i','j','k','l','m','n');				
				if($tipo == '1'){
					$alt = trim($q->getAlternativas());
					if($alt[strlen($alt)-1] == ";"){
						$alt = substr($alt, 0, (strlen($alt)-1));
					}
					$alt = explode(";",$alt);
					shuffle($alt);
					$c = count($alt);
					$i = 0;
					
					echo '<div class="row collapse">';
					foreach($alt as $a){
						if(($i+1) == $c){
							echo '<div class="large-4 columns end">';
						} else {
							echo '<div class="large-4 columns">';
						}
						if($a == $q->getResposta()){
							echo "<b>".$letras[$i].") ".$a."</b>";
						} else {
							echo $letras[$i].") ".$a;
						}						
						echo '</div>';
						$i++;
					}
				echo '</div>';
				}
				if($tipo == '2'){
					$json = $q->getAlternativas();
					$json = Util::limparJson($json);
					$obj = json_decode(utf8_encode($json));
					$c1 = trim($obj->C1);
					$c2 = trim($obj->C2);
					if($c1[strlen($c1)-1] == ";"){
						$c1 = substr($c1, 0, (strlen($c1)-1));
					}
					if($c2[strlen($c2)-1] == ";"){
						$c2 = substr($c2, 0, (strlen($c2)-1));
					}
					$c1 = explode(";",$c1);
					$c2 = explode(";",$c2);
					shuffle($c1);
					shuffle($c2);
					for($i = 0; $i < count($c1); $i++){
						echo '<div class="large-6 columns">';
							echo '('.strtoupper($letras[$i]).') '.utf8_decode($c1[$i]);
						echo '</div>';
						echo '<div class="large-6 columns">';
							echo '('.($i+1).') '.utf8_decode($c2[$i]);
						echo '</div>';
					}
					echo '</div>';
				}
			}
		?>
	</div>
</div>
</body>
</html>