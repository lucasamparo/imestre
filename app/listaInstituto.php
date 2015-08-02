<?php
	require_once('../models/bootstrap.php');
	session_start();
	if(!($_SESSION['logado'])){
		header('Location: index.php');
	}
	
	if(isset($_POST['nomeInstituicao'])){
		$inst = new Instituicao();
		$inst->setNomeInstituicao($_POST['nomeInstituicao']);
		$media = $_POST['media'];
		$inst->setMedia($media);
		$inst->setLogradouro($_POST['logradouro']);
		$inst->setNumero($_POST['numero']);
		$inst->setBairro($_POST['bairro']);
		$inst->setCidade($_POST['cidade']);
		$inst->setTelContato($_POST['telContato']);
		$inst->setIdInstituicao($_POST['idInstituicao']);
		//Funcionamento
		$obj = new stdClass();
		$obj->manhaEntrada = $_POST['entradaManhaHora'].":".$_POST['entradaManhaMinuto'];
		$obj->manhaSaida = $_POST['saidaManhaHora'].":".$_POST['saidaManhaMinuto'];
		$obj->tardeEntrada = $_POST['entradaTardeHora'].":".$_POST['entradaTardeMinuto'];
		$obj->tardeSaida = $_POST['saidaTardeHora'].":".$_POST['saidaTardeMinuto'];
		$obj->noiteEntrada = $_POST['entradaNoiteHora'].":".$_POST['entradaNoiteMinuto'];
		$obj->noiteSaida = $_POST['saidaNoiteHora'].":".$_POST['saidaNoiteMinuto'];
		$json = json_encode($obj);
		$inst->setFuncionamento($json);
		//Dias de funcionamento
		$dias = "0000000";
		foreach($_POST['dias'] as $dia){
			if($dia == 'dom'){
				$dias[0] = '1';
			}
			if($dia == 'seg'){
				$dias[1] = '1';
			}
			if($dia == 'ter'){
				$dias[2] = '1';
			}
			if($dia == 'qua'){
				$dias[3] = '1';
			}
			if($dia == 'qui'){
				$dias[4] = '1';
			}
			if($dia == 'sex'){
				$dias[5] = '1';
			}
			if($dia == 'sab'){
				$dias[6] = '1';
			}
		}
		$inst->setDias($dias);
		$inst->atualizarInstituicao();
		
		if($_FILES['cabeca']['error'] != 4 ){
			unlink('cabecalho/header_'.$inst->getIdInstituicao().'.png');
			
			$destino = 'cabecalho/header_'.$inst->getIdInstituicao().'.png';
			$tmp = $_FILES['cabeca']['tmp_name'];
			move_uploaded_file($tmp, $destino);
		}		
		
		//header('Location: listaInstituto.php');
	}
?>
<html>
<head>
<title>iMestre :: Listagem de Instituições - Professor <?php echo $_SESSION['nomeProfessor'];?></title>
<link rel="stylesheet" type="text/css" href="css/foundation.css">
<link rel="stylesheet" type="text/css" href="css/basic_simplemodal.css">
<script language="JScript" src="js/vendor/jquery.js"></script>
<script language="JScript" src="js/vendor/modernizr.js"></script>
<script language="JScript" src="js/foundation.min.js"></script>
<script language="JScript" src='js/jquery.simplemodal.js'></script>
<script language="JScript" src='js/imestre.js'></script>
<script language="JScript">
function completaEdicao(codigo){
	$('#edicao').css('display','inline');
	 var retorno;
	 var req = $.ajax({
	    url:    "wsInstituicao.php",
	    type:   "get",
	    dataType:"json",
	    data:   "id="+codigo,
	    async: false,

	    success: function( data ){
	        retorno = data;           
	    }
	});
	$('#nomeInstituicao').val(retorno.nomeInstituicao);
	$('#media').val(retorno.media);
	$('#logradouro').val(retorno.logradouro);
	$('#numero').val(retorno.numero);
	$('#bairro').val(retorno.bairro);
	$('#cidade').val(retorno.cidade);
	$('#telContato').val(retorno.telContato);
	$('#idInstituicao').val(retorno.idInstituicao);
	//Mostrando os horários
	var hora = JSON.parse(retorno.funcionamento);
	$('#entradaManhaHora').val(hora.manhaEntrada.substring(0,2));
	$('#entradaManhaMinuto').val(hora.manhaEntrada.substring(3,5));
	$('#entradaTardeHora').val(hora.tardeEntrada.substring(0,2));
	$('#entradaTardeMinuto').val(hora.tardeEntrada.substring(3,5));
	$('#entradaNoiteHora').val(hora.noiteEntrada.substring(0,2));
	$('#entradaNoiteMinuto').val(hora.noiteEntrada.substring(3,5));
	$('#saidaManhaHora').val(hora.manhaSaida.substring(0,2));
	$('#saidaManhaMinuto').val(hora.manhaSaida.substring(3,5));
	$('#saidaTardeHora').val(hora.tardeSaida.substring(0,2));
	$('#saidaTardeMinuto').val(hora.tardeSaida.substring(3,5));
	$('#saidaNoiteHora').val(hora.noiteSaida.substring(0,2));
	$('#saidaNoiteMinuto').val(hora.noiteSaida.substring(3,5));
	//Mostrando Dias de funcionamento
	if(retorno.dias[0] == 1){
		$('#dom').prop('checked',true);
	}
	if(retorno.dias[1] == 1){
		$('#seg').prop('checked',true);
	}
	if(retorno.dias[2] == 1){
		$('#ter').prop('checked',true);
	}
	if(retorno.dias[3] == 1){
		$('#qua').prop('checked',true);
	}
	if(retorno.dias[4] == 1){
		$('#qui').prop('checked',true);
	}
	if(retorno.dias[5] == 1){
		$('#sex').prop('checked',true);
	}
	if(retorno.dias[6] == 1){
		$('#sab').prop('checked',true);
	}
}

$(document).ready(function (){
	$('#cabecaInstituto').click(function (){
		abrirJanela('cabecalho/header_'+$('#idInstituicao').val()+'.png');
	});
});
</script>
</head>
<body onload="arrumaMenu('listaInstituicao')">
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
				$p = new Professor();
				$p->setIdProfessor($_SESSION['idProfessor']);
				$p = $p->retornaProfessorPorId();
				$instituicoes = $p->getInstituicao();
			?>
			<table class="large-12">
				<thead>
					<th width="60%" class="text-center">Instituição</th>
					<th width="20%" class="text-center">Telefone</th>
					<th width="10%" class="text-center">Média</th>
					<th width="10%" class="text-center"><img src="img/editar.png" width="20"></th>
				</thead>
				<tbody>
					<?php 
						if(count($instituicoes) == 0){
							echo '<td colspan="4" class="text-center">Nenhuma Instituição Cadastrada!</td>';
						} else {
							foreach($instituicoes as $it){
								echo '<tr>';
									echo '<td>'.$it->getNomeInstituicao().'</td>';
									echo '<td>'.$it->getTelContato().'</td>';
									echo '<td>'.$it->getMedia().'</td>';
									echo '<td class="text-center"><a href="#edicao"><img src="img/editar.png" width="20" style="cursor: pointer;" onclick="completaEdicao('.$it->getIdInstituicao().')"></a></td>';
								echo '</tr>';
							}
						}						
					?>
				</tbody>
			</table>
			<div style="display: none" id="edicao">
				<h4 class="text-center" id="tituloEdicao">Editando Insituição</h4>
				<form method="post" enctype="multipart/form-data">
					<fieldset>
						<div class="large-9 columns">
							<label>Nome da Instituição:</label>
								<input type="text" name="nomeInstituicao" id="nomeInstituicao">
						</div>
						<div class="large-3 columns">
							<label>Média (Aprovação):</label>
								<input type="text" name="media" id="media">
						</div>
						<div class="large-9 columns">
							<label>Logradouro:</label>
								<input type="text" name="logradouro" id="logradouro">
						</div>
						<div class="large-3 columns">
							<label>Número:</label>
								<input type="text" name="numero" id="numero">
						</div>
						<div class="large-4 columns">
							<label>Bairro:</label>
								<input type="text" name="bairro" id="bairro">
						</div>
						<div class="large-4 columns">
							<label>Cidade:</label>
								<input type="text" name="cidade" id="cidade">
						</div>
						<div class="large-4 columns">
							<label>Tel. Contato:</label>
								<input type="tel" name="telContato" id="telContato">
						</div>
						<div class="large-12 columns">
							<label>Horários de Funcionamento:</label>
							<div class="row collapse">
								<table>
									<thead>
										<th width="10%">&nbsp;</th>
										<th width="30%" class="text-center">Manhã</th>
										<th width="30%" class="text-center">Tarde</th>
										<th width="30%" class="text-center">Noite</th>
									</thead>
									<tbody>
										<tr>
											<td><b>Entrada</b></td>
											<td>
												<select class="large-5 columns" name="entradaManhaHora" id="entradaManhaHora">
													<option value="06">06</option>
													<option value="07">07</option>
													<option value="08">08</option>
													<option value="09">09</option>
													<option value="10">10</option>
													<option value="11">11</option>
													<option value="12">12</option>
												</select>
												<p class="large-2 columns"><b>:</b></p>
												<select class="large-5 columns" name="entradaManhaMinuto" id="entradaManhaMinuto">
													<option value="00">00</option>
													<option value="05">05</option>
													<?php 
														for($i = 2; $i < 12; $i++){
															echo '<option value="'.($i*5).'">'.($i*5).'</option>';
														}
													?>
												</select>
											</td>
											<td>
												<select class="large-5 columns" name="entradaTardeHora" id="entradaTardeHora">
													<option value="13">13</option>
													<option value="14">14</option>
													<option value="15">15</option>
													<option value="16">16</option>
													<option value="17">17</option>
													<option value="18">18</option>
												</select>
												<p class="large-2 columns"><b>:</b></p>
												<select class="large-5 columns" name="entradaTardeMinuto" id="entradaTardeMinuto">
													<option value="00">00</option>
													<option value="05">05</option>
													<?php 
														for($i = 2; $i < 12; $i++){
															echo '<option value="'.($i*5).'">'.($i*5).'</option>';
														}
													?>
												</select>
											</td>
											<td>
												<select class="large-5 columns" name="entradaNoiteHora" id="entradaNoiteHora">
													<option value="18">18</option>
													<option value="19">19</option>
													<option value="20">20</option>
													<option value="21">21</option>
													<option value="22">22</option>
												</select>
												<p class="large-2 columns"><b>:</b></p>
												<select class="large-5 columns" name="entradaNoiteMinuto" id="entradaNoiteMinuto">
													<option value="00">00</option>
													<option value="05">05</option>
													<?php 
														for($i = 2; $i < 12; $i++){
															echo '<option value="'.($i*5).'">'.($i*5).'</option>';
														}
													?>
												</select>
											</td>
										</tr>
										<tr>
											<td><b>Saída</b></td>
											<td>
												<select class="large-5 columns" name="saidaManhaHora" id="saidaManhaHora">
													<option value="06">06</option>
													<option value="07">07</option>
													<option value="08">08</option>
													<option value="09">09</option>
													<option value="10">10</option>
													<option value="11">11</option>
													<option value="12">12</option>
												</select>
												<p class="large-2 columns"><b>:</b></p>
												<select class="large-5 columns" name="saidaManhaMinuto" id="saidaManhaMinuto">
													<option value="00">00</option>
													<option value="05">05</option>
													<?php 
														for($i = 2; $i < 12; $i++){
															echo '<option value="'.($i*5).'">'.($i*5).'</option>';
														}
													?>
												</select>
											</td>
											<td>
												<select class="large-5 columns" name="saidaTardeHora" id="saidaTardeHora">
													<option value="13">13</option>
													<option value="14">14</option>
													<option value="15">15</option>
													<option value="16">16</option>
													<option value="17">17</option>
													<option value="18">18</option>
												</select>
												<p class="large-2 columns"><b>:</b></p>
												<select class="large-5 columns" name="saidaTardeMinuto" id="saidaTardeMinuto">
													<option value="00">00</option>
													<option value="05">05</option>
													<?php 
														for($i = 2; $i < 12; $i++){
															echo '<option value="'.($i*5).'">'.($i*5).'</option>';
														}
													?>
												</select>
											</td>
											<td>
												<select class="large-5 columns" name="saidaNoiteHora" id="saidaNoiteHora">
													<option value="18">18</option>
													<option value="19">19</option>
													<option value="20">20</option>
													<option value="21">21</option>
													<option value="22">22</option>
												</select>
												<p class="large-2 columns"><b>:</b></p>
												<select class="large-5 columns" name="saidaNoiteMinuto" id="saidaNoiteMinuto">
													<option value="00">00</option>
													<option value="05">05</option>
													<?php 
														for($i = 2; $i < 12; $i++){
															echo '<option value="'.($i*5).'">'.($i*5).'</option>';
														}
													?>
												</select>
											</td>
										</tr>
									</tbody>								
								</table>	
							</div>
						</div>
						<div class="large-12 columns">
						<label>Dias de funcionamento:</label>
							<div class="row collapse">
								<div class="large-3 columns">
									<input type="checkbox" value="dom" id="dom" name="dias[]"><label for="dom">Domingo</label>
								</div>
								<div class="large-3 columns">
									<input type="checkbox" value="seg" id="seg" name="dias[]"><label for="seg">Segunda</label>
								</div>
								<div class="large-3 columns">
									<input type="checkbox" value="ter" id="ter" name="dias[]"><label for="ter">Terça</label>
								</div>
								<div class="large-3 columns">
									<input type="checkbox" value="qua" id="qua" name="dias[]"><label for="qua">Quarta</label>
								</div>
								<div class="large-3 columns">
									<input type="checkbox" value="qui" id="qui" name="dias[]"><label for="qui">Quinta</label>
								</div>
								<div class="large-3 columns">
									<input type="checkbox" value="sex" id="sex" name="dias[]"><label for="sex">Sexta</label>
								</div>
								<div class="large-3 columns end">
									<input type="checkbox" value="sab" id="sab" name="dias[]"><label for="sab">Sábado</label>
								</div>
							</div>
						</div>
						<div class="large-6 columns">
							<label>Cabeçalho: <small>(Dimensões: 210mm X 30mm)</small></label>
							<input type="file" name="cabeca">
						</div>
						<div class="large-2 columns">
							<label>&nbsp;</label>
							<a href="#" id="cabecaInstituto">Ver Atual</a>
						</div>
						<div class="large-4 columns">
							<input type="hidden" id="idInstituicao" name="idInstituicao">
							<input type="submit" class="button large-12" value="Atualizar">
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