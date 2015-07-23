<?php
	require_once('../models/bootstrap.php');
	session_start();
	if(!($_SESSION['logado'])){
		header('Location: index.php');
	}
	$p = new Professor();
	$p->setIdProfessor($_SESSION['idProfessor']);
	$professor = $p->retornaProfessorPorId();
	$nome = explode(" ",$professor->getNomeProfessor());
	
	if(isset($_POST['conteudoChamado'])){
		$a = new Chamado();
		$a->setDataChamado(date('Y-m-d'));
		$a->setConteudo($_POST['conteudoChamado']);
		$a->setIdProfessor($_SESSION['idProfessor']);
		$a->setStatus('A');
		$a->inserirChamado();
	}
	
	
	$c = new Chamado();
	$abertos = $c->retornarChamadosAbertos();
	$fechados = $c->retornarChamadosFechados();
?>

<html>
<head>
<title>iMestre :: Início - Professor <?php echo $professor->getNomeProfessor();?></title>
<link rel="stylesheet" type="text/css" href="css/foundation.css">
<script language="JScript" src="js/vendor/jquery.js"></script>
<script language="JScript" src="js/vendor/modernizr.js"></script>
<script language="JScript" src="js/foundation.min.js"></script>
<script language="JScript" src='js/jquery.simplemodal.js'></script>
<script language="JScript">
	$(document).ready(function (){
		$('#aberto').click(function (){
			$('#tbAberto').css('display','inline');
			$('#tbFechado').css('display','none');
			$('#titulo').html('Chamados do Sistema - Abertos');
		});
		$('#fechado').click(function (){
			$('#tbAberto').css('display','none');
			$('#tbFechado').css('display','inline');
			$('#titulo').html('Chamados do Sistema - Fechados');
		});
		$('#btNovoChamado').click(function (){
			$('#novoChamado').css('display','inline');
		});
		$('#fecharVisu').click(function (){
			$('#verChamado').css('display','none');
		});
	});

	function verChamado(id){
		var req = $.ajax({
		    url:    "wsChamado.php",
		    type:   "get",
		    dataType:"json",
		    data:   "id="+id,
		    async: false,

		    success: function( data ){
		        $('#nChamado').html(data.idChamado); 
		        dt = new Date(data.dataChamado);
		        $('#dataChamado').html(dt.getDate()+"/"+(dt.getMonth()+1)+"/"+dt.getFullYear());
		        var status = "";
		        switch(data.status){
		        	case 'A':
						status = "Aberto";
			        	break;
		        	case 'E':
						status = "Em Análise";
			        	break;
		        	case 'R':
						status = "Respondido";
			        	break;
		        	case 'F':
						status = "Encerrado";
			        	break;
		        }
		        $('#status').html(status);
		        $('#conteudo').html(data.conteudo);
		        $('#resposta').html(data.resposta);  
		        $('#verChamado').css('display','inline');        
		    }
		});
	}
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
			<h4 class="text-center" id="titulo">Chamados do Sistema - Abertos</h4>
			<div class="large-12 columns">
				<div class="large-3 columns">
					<a href="#" id="aberto" class="tiny button large-12">Abertos</a>
				</div>
				<div class="large-3 columns end">
					<a href="#" id="fechado" class="tiny button large-12">Encerrados</a>
				</div>
			</div>
			<div class="large-12 columns" id="tbAberto">
				<table class="large-12">
					<thead>
						<th width="15%">Data</th>
						<th>Conteúdo</th>
						<th width="10%">Status</th>
					</thead>
					<tbody>
					<?php 
						foreach($abertos as $a){
							echo '<tr>';
								echo '<td>'.Util::arrumaData($a->getDataChamado()).'</td>';
								echo '<td><a href="#verChamado" onclick="verChamado('."'".$a->getIdChamado()."'".')">'.$a->getConteudo().'</a></td>';
								echo '<td>'.Util::retornarStatusChamado($a->getStatus()).'</td>';
							echo '</tr>';
						}
					?>
					</tbody>
				</table>
			</div>
			<div class="large-12 columns" id="tbFechado" style="display: none">
				<table class="large-12">
					<thead>
						<th width="15%">Data</th>
						<th>Conteúdo</th>
						<th width="10%">Status</th>
					</thead>
					<tbody>
					<?php 
						foreach($fechados as $a){
							echo '<tr>';
								echo '<td>'.Util::arrumaData($a->getDataChamado()).'</td>';
								echo '<td><a href="#verChamado" onclick="verChamado('."'".$a->getIdChamado()."'".')">'.$a->getConteudo().'</a></td>';
								echo '<td>'.Util::retornarStatusChamado($a->getStatus()).'</td>';
							echo '</tr>';
						}
					?>
					</tbody>
				</table>
			</div>
			<div class="large-12 columns">
				<a href="#novoChamado" class="large-4 button" id="btNovoChamado">Novo Chamado</a>
			</div>
			<div class="large-12 columns" id="novoChamado" style="display: none">
				<form method="post">
					<fieldset>
						<legend>Novo Chamado</legend>
						<div class="large-12 columns">
							<label>Conteúdo do Chamado</label>
							<textarea name="conteudoChamado" rows="4"></textarea>
						</div>
						<div class="large-12 columns text-right">
							<input type="submit" class="large-4 button" value="Salvar">
						</div>
					</fieldset>					
				</form>
			</div>
			<div class="large-12 columns" id="verChamado" style="display: none">
				<fieldset>
					<legend>Visualizar Chamado</legend>
					<div class="large-3 columns">
						<label>Número:</label>
						<p id="nChamado"></p>
					</div>
					<div class="large-5 columns">
						<label>Data do Chamado:</label>
						<p id="dataChamado"></p>
					</div>
					<div class="large-4 columns">
						<label>Status:</label>
						<p id="status"></p>
					</div>
					<div class="large-12 columns">
						<fieldset>
							<legend>Conteúdo:</legend>
							<div id="conteudo"></div>
						</fieldset>
					</div>
					<div class="large-12 columns">
						<fieldset>
							<legend>Resposta:</legend>
							<div id="resposta"></div>
						</fieldset>
					</div>
					<div class="large-12 columns text-right">
						<a href="#" id="fecharVisu" class="large-4 button">Fechar</a>
					</div>
				</fieldset>
			</div>
		</div>
		<div class="large-12 columns">
		<hr>
			<?php include('footer.php')?>
		</div>		
	</div>
</body>
<script>
  $(document).foundation();
</script>
</html>