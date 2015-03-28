<?php
	require_once('../models/bootstrap.php');
	session_start();
	if(!($_SESSION['logado'])){
		header('Location: index.php');
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
}
</script>
</head>
<body onload="arrumaMenu('listaTurma')">
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
		<div class="large-4 columns">
			<?php include('sidebar.php');?>
		</div>
		<div class="large-8 columns" style="border-left-style: solid; border-width: 1px;">
			<?php 
				if(!isset($_POST['turma'])){
					?>
					<form method="post">
						<fieldset>
							<legend>Selecione a Turma:</legend>
								<div class="large-9 columns">
									<select name="turma">
										<?php 
											$t = new Turma();
											$turmas = $t->retornaTodasTurmas();
											foreach($turmas as $t){
												echo '<option value="'.$t->getIdTurma().'">'.$t->getNomeTurma().'</option>';	
											}
										?>
									</select>
								</div>
								<div class="large-1 columns">&nbsp;</div>
								<div class="large-2 columns">
									<input type="submit" value="Selecionar" class="button tiny">
								</div>
						</fieldset>
					</form>
					<?php
				} else {
					$t = new Turma();
					$t->setIdTurma($_POST['turma']);
					$turma = $t->retornaTurmaPorId();
					$alunos = $t->retornaAlunosDaTurma();
					?>
					<fieldset>
						<span>Turma: </span><span><?php echo $turma->getNomeTurma()?></span><br>
						<span>Alunos (<?php echo count($alunos);?>)</span>
						<table class="large-12">
							<thead>
								<th>Nome</th>
							</thead>
							<tbody id="corpoAlunos">
								<?php 
									foreach($alunos as $a){
										echo '<tr>';
											echo '<td>'.$a->getNomeAluno().'</td>';
										echo '</tr>';
									}
								?>
							</tbody>
						</table>
						<div class="row collapse">
							<div class="large-4 columns">
								<a href="#" class="button large-12" onclick="abrirJanela('escolheAluno.php','500','600','55','0')">+ Aluno</a>
							</div>
							<div class="large-4 columns">&nbsp;</div>
							<div class="large-4 columns">
								<form method="post" id="formTurma">
									<input type="hidden" name="idTurma" value="<?php echo $_POST['turma'];?>">
									<input type="submit" class="button large-12" value="Salvar">
								</form>
							</div>
						</div>												
					</fieldset>
					<?php
				}
			?>
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