<?php
	require_once('../models/bootstrap.php');
	session_start();
	if(!($_SESSION['logado'])){
		header('Location: index.php');
	}
	
	if(isset($_POST['enunciado'])){
		$questao = new Questao();
		$questao->setPrivacidade($_POST['privacidade']);
		$questao->setIdDisciplina($_POST['disciplina']);
		$questao->setEnunciado($_POST['enunciado']);
		$tipo = $_POST['tipo'];
		$questao->setTipo($tipo);
		switch ($tipo){
			case 0:
				$questao->setAlternativas(null);
				$questao->setResposta($_POST['resposta']);
				break;
			case 1:
				$questao->setAlternativas($_POST['alternativas']);
				$questao->setResposta($_POST['resposta']);
				break;
			case 2:
				$questao->setAlternativas('C1:{'.$_POST['coluna1'].'};C2:{'.$_POST['coluna2'].'}');
				$questao->setResposta(null);
				break;
		}
		$questao->inserirQuestao();
	}
?>
<html>
<head>
<title>iMestre :: Cadastro de Questões - Professor <?php echo $_SESSION['nomeProfessor'];?></title>
<link rel="stylesheet" type="text/css" href="css/foundation.css">
<link rel="stylesheet" type="text/css" href="css/basic_simplemodal.css">
<script language="JScript" src="js/vendor/jquery.js"></script>
<script language="JScript" src="js/vendor/modernizr.js"></script>
<script language="JScript" src="js/foundation.min.js"></script>
<script language="JScript" src='js/jquery.simplemodal.js'></script>
<script language="JScript" src='js/imestre.js'></script>
<script language="JScript">
function carregaRespostas(tipo){
	html = "";
	switch(tipo){
		case 0:
			//Resposta Dissertativa
			html = '<label>Resposta</label>'+
					'<textarea name="resposta" rows="3"></textarea>';
			break;
		case 1:
			//Resposta Múltipla Escolha
			html = '<div class="row collapse">'+
						'<label>Alternativas</label>'+
						'<input type="text" name="alternativas" class="large-12">'+
						'<p><small>Separe as alternativas com ";"</small></p>'+
					'</div>'+
					'<div class="row collapse">'+
						'<label>Resposta</label>'+
						'<input type="text" name="resposta" class="large-12">'+
					'</div>';
			break;
		case 2:
			//Resposta associativa
			html = '<div class="row collapse">'+
					'<div class="large-5 columns">'+
						'<label>Coluna 1</label>'+
						'<textarea name="coluna1" rows="5"></textarea>'+
					'</div>'+
					'<div class="large-2 columns">&nbsp;</div>'+
					'<div class="large-5 columns">'+
						'<label>Coluna 2</label>'+
						'<textarea name="coluna2" rows="5"></textarea>'+
					'</div>'+
					'<div class="large-12 columns">'+
						'<p><small>Uma alternativa por linha, separados por ";"</small></p>'+
					'</div>'+
					'</div>';
			break;
	}
	$('#respostas').html(html);
}
</script>
</head>
<body onload="arrumaMenu('cadQuestao')">
	<div class="row"><!-- Linha do header -->
		<?php include('header.php');?>
	</div>
	<div class="row"><!-- Linha do Menu -->
		<div class="large-12 columns">
			<?php include('menu.php')?>
		</div>
		<div class="large-12 columns">
			<hr>
		</div>
	</div>
	<div class="row"><!-- Linha do Content -->
		<div class="large-2 columns">
			<?php include('sidebar.php');?>
		</div>
		<div class="large-10 columns" style="border-left-style: solid; border-width: 1px;">
			<h4 class="text-center">Cadastro de Questões</h4>
			<form method="post">
				<fieldset>
					<legend>Nova Questão</legend>
					<div class="large-6 columns">
						<label>Privacidade:</label>
						<div class="row collapse">
							<div class="large-6 columns">
								<input type="radio" name="privacidade" value="0" id="priv0"><label for="priv0">Pública</label>
							</div>
							<div class="large-6 columns">
								<input type="radio" name="privacidade" value="1" id="priv1"><label for="priv1">Privada</label>
							</div>
						</div>
					</div>
					<div class="large-6 columns">
						<select name="disciplina">
							<?php 
								$d = new Disciplina();
								$disciplina = $d->retornaTodasDisciplinas();
								foreach($disciplina as $d){
									echo '<option value="'.$d->getIdDisciplina().'">'.$d->getNomeDisciplina().'</option>';
								}
							?>
						</select>
					</div>
					<div class="large-12 columns">
						<label>Enunciado:</label>
							<input type="text" name="enunciado">
					</div>
					<div class="large-12 columns">
						<label>Tipo de Resposta</label>
						<div class="row collapse">
							<div class="large-4 columns">
								<input type="radio" name="tipo" value="0" id="tipo0" onclick="carregaRespostas(0)"><label for="tipo0">Dissertativa</label>
							</div>
							<div class="large-4 columns">
								<input type="radio" name="tipo" value="1" id="tipo1" onclick="carregaRespostas(1)"><label for="tipo1">Múltipla Escolha</label>
							</div>
							<div class="large-4 columns">
								<input type="radio" name="tipo" value="2" id="tipo2" onclick="carregaRespostas(2)"><label for="tipo2">Associativa</label>
							</div>							
						</div>
					</div>
					<div class="large-12 columns" id="respostas"></div>
					<div class="large-8 columns">&nbsp;</div>
					<div class="large-4 columns">
						<input type="submit" name="salvar" value="Salvar" class="button large-12">
					</div>
				</fieldset>
			</form>
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