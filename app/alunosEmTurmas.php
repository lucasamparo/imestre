<?php
	require_once('../models/bootstrap.php');
	session_start();
	if(!($_SESSION['logado'])){
		header('Location: index.php');
	}
	
	if(isset($_POST['alunos'])){
		foreach($_POST['alunos'] as $a){
			$at = new Alunoturma();
			$at->setIdAluno($a);
			$at->setIdTurma($_GET['id']);
			$at->setAno(date('Y'));
			$at->inserirAlunoEmTurma();
		}
		header('Location: alunosEmTurmas.php?id='.$_GET['id']);
	}
	
	if(isset($_GET['e'])){
		$at = new Alunoturma();
		$at->setIdAlunoTurma($_GET['e']);
		$at->deletarAlunoEmTurma();
	}
?>
<html>
<head>
<title>iMestre :: Gestão de Alunos em Turmas - Professor <?php echo $_SESSION['nomeProfessor'];?></title>
<link rel="stylesheet" type="text/css" href="css/foundation.css">
<link rel="stylesheet" type="text/css" href="css/basic_simplemodal.css">
<script language="JScript" src="js/vendor/jquery.js"></script>
<script language="JScript" src="js/vendor/modernizr.js"></script>
<script language="JScript" src="js/foundation.min.js"></script>
<script language="JScript" src='js/jquery.simplemodal.js'></script>
<script language="JScript" src='js/imestre.js'></script>
<script language="JScript">
function insereAluno(codigo){
	var retorno;
	var req = $.ajax({
	    url:    "wsAluno.php",
	    type:   "get",
	    dataType:"json",
	    data:   "id="+codigo,
	    async: false,

	    success: function( data ){
	        retorno = data;           
	    }
	});
	$('#corpoAlunos').append('<tr><td>'+retorno.nomeAluno+'</td></tr>');
	html = $('#formAlunos').html();
	html += '<input type="hidden" value="'+retorno.idAluno+'" name="alunos[]">';
	$('#formAlunos').html(html);
}

function abreEscolheAluno(){
	abrirJanela('escolheAluno.php','500','300','100','0');
}
</script>
</head>
<body onload="arrumaMenu()">
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
			<?php 
				$id = $_GET['id'];
				$t = new Turma();
				$t->setIdTurma($id);
				$turma = $t->retornaTurmaPorId();
				echo '<h5 class="text-center">Alunos da Turma "'.$turma->getNomeTurma().'"</h5>';
				echo '<table class="large-12" id="corpoAlunos">';
					echo '<th>Nome do Aluno</th>';
					echo '<th class="text-center" width="40px"><img src="img/deletar.png" style="cursor: pointer"></th>';
					foreach($turma->getAlunoturma() as $alunos){
						echo '<tr>';
							echo '<td>'.$alunos->getAluno()->getNomeAluno().'</td>';
							echo '<td class="text-center" width="40px"><a href="?id='.$id.'&e='.$alunos->getIdAlunoTurma().'"><img src="img/deletar.png" style="cursor: pointer"></a></td>';
						echo '</tr>';
					}
				echo '</table>';
			?>
			<div class="large-4 columns">
				<a href="#" class="button large-12" onclick="abreEscolheAluno()">+ Aluno</a>
			</div>
			<div class="large-4 columns">
				<a href="boletimTurma.php?id=<?= $_GET['id'];?>" target="_blank" class="button large-12">Boletim</a>
			</div>
			<form method="post" id="formAlunos" class="large-4 columns">
				<input type="submit" class="button large-12" value="Salvar">
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