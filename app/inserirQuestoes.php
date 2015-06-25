<?php
	require_once('../models/bootstrap.php');
	session_start();
	if(!($_SESSION['logado'])){
		header('Location: index.php');
	}
	
	if(isset($_GET['id'])){
		$a = new Avaliacao();
		$a->setIdAvaliacao($_GET['id']);
				
		if(isset($_GET['q'])){
			$i = new Itemavaliacao();
			$i->setIdAvaliacao($_GET['id']);
			$i->setIdQuestao($_GET['q']);
			$i->excluirQuestao();
			$x = new Itemavaliacao();
			$x->setIdAvaliacao($_GET['id']);
			$x->reorganizarItens();
			header('Location: inserirQuestoes.php?id='.$_GET['id']);
		}
		
		//Inserindo questoes
		if(isset($_POST['questoes'])){
			$x = $_POST['indice']+1;
			foreach($_POST['questoes'] as $q){
				$i = new Itemavaliacao();
				$i->setIdAvaliacao($_GET['id']);
				$i->setIdQuestao($q);
				$i->setIndice($x);
				$i->inserirItemAvaliacao();
				$x++;
			}
		}
		
		$aval = $a->retornarAvaliacaoPorId();
		$questoesAnt = $aval->retornarItemsOrdenados();
		$assuntos = $aval->getTurma()->getDisciplina()->getAssunto();
	} else {
		header('Location: listaAvaliações.php');
	}
?>
<html>
<head>
<title>iMestre :: Inserção de Questões em Avaliação - Professor <?php echo $_SESSION['nomeProfessor'];?></title>
<link rel="stylesheet" type="text/css" href="css/foundation.css">
<link rel="stylesheet" type="text/css" href="css/basic_simplemodal.css">
<script language="JScript" src="js/vendor/jquery.js"></script>
<script language="JScript" src="js/vendor/modernizr.js"></script>
<script language="JScript" src="js/foundation.min.js"></script>
<script language="JScript" src='js/jquery.simplemodal.js'></script>
<script language="JScript" src='js/imestre.js'></script>
<script language="JScript">
function adicionarQuestao(id,enunciado){
	html = '<tr><td>'+($('#tbAval tr').length + 1)+'</td><td>'+enunciado+'</td><td class="text-center"><img src="img/menos.png" width="20"></td></tr>';
	$('#tbAval').append(html);
	hidden = '<input type="hidden" name="questoes[]" value="'+id+'">';
	$('#formQuestoes').append(hidden);
}

$(document).ready(function (){
	$('#assuntos').change(function (){
		 var retorno;
		 var codigo = $('#assuntos').val();
		 var req = $.ajax({
		    url:    "wsQuestao.php",
		    type:   "get",
		    dataType:"json",
		    data:   "id="+codigo,
		    async: false,

		    success: function( data ){
		        $('#tbQuestoes').html("");
		        for(i = 0; i<data.length; i++){
			        var tipo;
			        switch(data[i].tipo){
			        	case '0':
							tipo = 'Dissertativa';
				        	break;
			        	case '1':
							tipo = 'Múltipla Escolha';
				        	break;
			        	case '2':
				        	tipo = 'Associativa';
				        	break;
			        }
			        html = '<tr><td>'+data[i].enunciado+'</td><td>'+tipo+'</td><td class="text-center"><img src="img/mais.png" width="20" onclick="adicionarQuestao('+"'"+data[i].id+"','"+data[i].enunciado+"'"+')"></td></tr>';
					$('#tbQuestoes').append(html);
		        }         
		    }
		});
	});
});
</script>
</head>
<body>
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
			<h4 class="text-center">Questões - Avaliação "<?= $aval->getTurma()->getDisciplina()->getNomeDisciplina()." - ".Util::arrumaData($aval->getDataAvaliacao())?>"</h4>
			<fieldset>
				<legend>Banco de Questões:</legend>
				<div class="large-12 columns">
					<select name="assuntos" id="assuntos" class="large-8">
						<option value="0">Escolha um Assunto</option>
						<?php 
							foreach($assuntos as $a){
								echo '<option value="'.$a->getIdAssunto().'">'.$a->getNomeAssunto().'</option>';
							}
						?>
					</selecT>
				</div>
				<div class="large-12 columns">
					<table class="large-12">
						<thead>
							<th width="70%">Enunciado</th>
							<th width="20%">Tipo</th>
							<th width="10%" class="text-center"><img src="img/mais.png" width="20"></th>
						</thead>
						<tbody id="tbQuestoes">
						</tbody>
					</table>
				</div>
			</fieldset>
			<fieldset>
				<legend>Questões da Avaliação</legend>
				<div class="large-12 columns">
					<table class="large-12">
						<thead>
							<th width="20%">Índice</th>
							<th width="70%">Enunciado</th>
							<th width="10%" class="text-center"><img src="img/menos.png" width="20"></th>
						</thead>
						<tbody id="tbAval">
							<?php 
								foreach($questoesAnt as $q1){
									$q = $q1->getQuestao();
									echo '<tr>';
										echo '<td>'.$q1->getIndice().'</td>';
										echo '<td>'.$q->getEnunciado().'</td>';
										echo '<td class="text-center"><a href="?q='.$q1->getIdQuestao().'&id='.$q1->getIdAvaliacao().'"><img src="img/menos.png" width="20"></a></td>';
									echo '</tr>';
								}
							?>
						</tbody>
					</table>
				</div>
				<div class="large-12 columns">
					<form method="post" id="formQuestoes">
						<input type="submit" value="Salvar Questões" class="large-4 button">
						<input type="hidden" value="<?= count($questoesAnt)?>" name="indice">
					</form>			
				</div>
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