<?php
	require_once('../models/bootstrap.php');
	session_start();
	if(!($_SESSION['logado'])){
		header('Location: index.php');
	}
	
	if(isset($_POST['nomeTurma'])){
		$turma = new Turma();
		$turma->setIdTurma($_POST['idTurma']);
		$turma->setIdInstituicao($_POST['instituicao']);
		$turma->setIdDisciplina($_POST['disciplina']);
		$turma->setNomeTurma($_POST['nomeTurma']);
		$turma->setPeriodo($_POST['periodo']);
		$turma->setTurno($_POST['turno']);
		$turma->setCargaHoraria($_POST['cargaHoraria']);
		$turma->atualizaTurma();
	}
?>
<html>
<head>
<title>iMestre :: Listagem de Turmas - Professor <?php echo $_SESSION['nomeProfessor'];?></title>
<link rel="stylesheet" type="text/css" href="css/foundation.css">
<link rel="stylesheet" type="text/css" href="css/basic_simplemodal.css">
<script language="JScript" src="js/vendor/jquery.js"></script>
<script language="JScript" src="js/vendor/modernizr.js"></script>
<script language="JScript" src="js/foundation.min.js"></script>
<script language="JScript" src='js/jquery.simplemodal.js'></script>
<script language="JScript" src='js/imestre.js'></script>
<script language="JScript">
$(document).tooltip({
	track: true	
});
function completaEdicao(codigo){
	 var retorno;
	 var req = $.ajax({
	    url:    "wsTurma.php",
	    type:   "get",
	    dataType:"json",
	    data:   "id="+codigo,
	    async: false,

	    success: function( data ){
	        retorno = data;           
	    }
	});
	$('#legenda').html('Editar Turma '+retorno.nomeTurma);
	$("#instituicao option[value='"+retorno.idInstituicao+"']").attr('selected', true);
	$("#disciplina option[value='"+retorno.idDisciplina+"']").attr('selected', true);
	$("#periodo option[value='"+retorno.periodo+"']").attr('selected', true);
	$("#turno option[value='"+retorno.turno+"']").attr('selected', true);
	$('#nomeTurma').val(retorno.nomeTurma);
	$('#cargaHoraria').val(retorno.cargaHoraria);
	$('#idTurma').val(retorno.idTurma);
	$('#formEd').css('display','inline');
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
		<div class="large-2 columns">
			<?php include('sidebar.php');?>
		</div>
		<div class="large-10 columns" style="border-left-style: solid; border-width: 1px;">
			<h4 class="text-center">Listagem de Turmas</h4>
			<div class="large-12 columns">
				<table class="large-12">
					<thead>
						<th class="text-center" width="20%">Nome (Disciplina)</th>
						<th class="text-center" width="7%">C. Horária</th>
						<th class="text-center" width="4%">Turno</th>
						<th class="text-center" width="15%">Instituição</th>
						<th class="text-center" width="4%"><img src="img/alunos.jpg" width="25px" title="Inserir Alunos na Turma"></th>
						<th class="text-center" width="4%"><img src="img/planejar.png" width="20" title="Planejar Aulas"></th>
						<th class="text-center" width="4%"><img src="img/frequencia.png" width="20" title="Lançar Frequência"></th>
						<th class="text-center" width="4%"><img src="img/editar.png" width="20" title="Editar Turma"></th>
					</thead>
					<tbody>
						<?php 
							$t = new Turma();
							$i = new Instituicao();
							$ia = new Instituicao();
							$p = new Professor();
							$p->setIdProfessor($_SESSION['idProfessor']);
							$p = $p->retornaProfessorPorId();
							$i = $p->getInstituicao();
							$turmas = null;
							foreach($i as $i1){
								if(count($i1->getTurma()) != 0){
									$turmas[] = $i1->getTurma();
								}								
							}
							if(count($turmas) == 0){
									echo '<tr><td colspan="8" class="text-center">Nenhuma Turma Cadastrada</td></tr>';
							} else {
								foreach($turmas as $t1){
									foreach($t1 as $t){
										echo '<tr>';
										echo '<td>'.$t->getNomeTurma().' ('.$t->getDisciplina()->getNomeDisciplina().')</td>';
										echo '<td>'.$t->getCargaHoraria().' H</td>';
										$turno = $t->getTurno();
										if($turno == 0){
											$turno = 'Matutino';
										}
										if($turno == 1){
											$turno = 'Vespertino';
										}
										if($turno == 2){
											$turno = 'Noturno';
										}
										echo '<td>'.$turno.'</td>';
										$ia->setIdInstituicao($t->getIdInstituicao());
										echo '<td>'.$ia->retornaInstituicaoPorId()->getNomeInstituicao().'</td>';
										echo '<td class="text-center"><a href="alunosEmTurmas.php?id='.$t->getIdTurma().'"><img src="img/alunos.jpg" width="25px"></a></td>';
										echo '<td class="text-center"><a href="planejarTurma.php?id='.$t->getIdTurma().'"><img src="img/planejar.png" width="20"></a></td>';
										echo '<td class="text-center"><a href="lancarFrequencia.php?id='.$t->getIdTurma().'"><img src="img/frequencia.png" width="20"></a></td>';
										echo '<td class="text-center"><img src="img/editar.png" style="cursor: pointer;" onclick="completaEdicao('.$t->getIdTurma().')" width="20"></td>';
										echo '</tr>';
									}
								}	
							}
						?>
					</tbody>
				</table>
				<form method="post" action="listaTurmas.php" id="formEd" style="display: none;">
					<fieldset>
						<legend id="legenda">Editar Turma @turmas</legend>
						<div class="large-3 columns">
							<label>Instituição</label>
							<select name="instituicao" id="instituicao" required>
								<option value="0">>Selecione<</option>
								<?php 
									$p = new Professor();
									$p->setIdProfessor($_SESSION['idProfessor']);
									$p = $p->retornaProfessorPorId();
									$instituicoes = $p->getInstituicao();
									foreach($instituicoes as $i){
										echo '<option value="'.$i->getIdInstituicao().'">'.$i->getNomeInstituicao().'</option>';
									}
								?>
							</select>
						</div>
						<div class="large-3 columns">
							<label>Disciplina:</label>
							<select name="disciplina" id="disciplina" required>
								<option value="0">>Selecione<</option>
								<?php 
									$disciplinas = $p->getDisciplina();
									foreach($disciplinas as $d){
										echo '<option value="'.$d->getIdDisciplina().'">'.$d->getNomeDisciplina().'</option>';
									}
								?>
							</select>
						</div>
						<div class="large-3 columns">
							<label>Período:</label>
							<select name="periodo" id="periodo" required>
								<option value="0">1º Semestre</option>
								<option value="1">2º Semestre</option>
								<option value="2">Anual</option>
							</select>
						</div>
						<div class="large-3 columns">
							<label>Turno:</label>
							<select name="turno" id="turno" required>
								<option value="0">Matutino</option>
								<option value="1">Vespertino</option>
								<option value="2">Noturno</option>
							</select>
						</div>
						<div class="large-6 columns">
							<label>Nome da Turma:</label>
								<input type="text" name="nomeTurma" id="nomeTurma" required>
						</div>
						<div class="large-3 columns">
							<label>Carga Horária:</label>
								<input type="number" name="cargaHoraria" id="cargaHoraria" required>
						</div>					
						<div class="large-3 columns">
							<label>&nbsp;</label>
							<input type="hidden" name="idTurma" id="idTurma">
							<input type="submit" name="salvar" value="Atualizar" class="button tiny large-12">
						</div>
					</fieldset>
				</form>
			</div>
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