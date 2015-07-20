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
		$inst->setIdProfessor($_SESSION['idProfessor']);
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
		$inst->inserirInstituicao();
		
		
		if(!empty($_FILES['cabeca']['name'])){
			$destino = 'cabecalho/header_'.$inst->getIdInstituicao().'.png';
			$tmp = $_FILES['cabeca']['tmp_name'];
			move_uploaded_file($tmp, $destino);
		}		
	}
?>
<html>
<head>
<title>iMestre :: Cadastro de Instituição - Professor <?php echo $_SESSION['nomeProfessor'];?></title>
<link rel="stylesheet" type="text/css" href="css/foundation.css">
<link rel="stylesheet" type="text/css" href="css/basic_simplemodal.css">
<script language="JScript" src="js/vendor/jquery.js"></script>
<script language="JScript" src="js/vendor/modernizr.js"></script>
<script language="JScript" src="js/foundation.min.js"></script>
<script language="JScript" src='js/jquery.simplemodal.js'></script>
<script language="JScript" src='js/imestre.js'></script>
</head>
<body onload="arrumaMenu('cadInstituicao')">
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
			<h4 class="text-center">Cadastro de Instituição</h4>
			<form method="post" enctype="multipart/form-data">
				<fieldset>
					<div class="large-10 columns">
						<label>Nome da Instituição:</label>
							<input type="text" name="nomeInstituicao" >
					</div>
					<div class="large-2 columns">
						<label>Média:</label>
							<input type="text" name="media">
					</div>
					<div class="large-10 columns">
						<label>Logradouro:</label>
							<input type="text" name="logradouro" >
					</div>
					<div class="large-2 columns">
						<label>Número:</label>
							<input type="text" name="numero">
					</div>
					<div class="large-4 columns">
						<label>Bairro:</label>
							<input type="text" name="bairro">
					</div>
					<div class="large-4 columns">
						<label>Cidade:</label>
							<input type="text" name="cidade">
					</div>
					<div class="large-4 columns">
						<label>Tel. Contato:</label>
							<input type="tel" name="telContato">
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
											<select class="large-5 columns" name="entradaManhaHora">
												<option value="06">06</option>
												<option value="07">07</option>
												<option value="08">08</option>
												<option value="09">09</option>
												<option value="10">10</option>
												<option value="11">11</option>
												<option value="12">12</option>
											</select>
											<p class="large-2 columns"><b>:</b></p>
											<select class="large-5 columns" name="entradaManhaMinuto">
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
											<select class="large-5 columns" name="entradaTardeHora">
												<option value="13">13</option>
												<option value="14">14</option>
												<option value="15">15</option>
												<option value="16">16</option>
												<option value="17">17</option>
												<option value="18">18</option>
											</select>
											<p class="large-2 columns"><b>:</b></p>
											<select class="large-5 columns" name="entradaTardeMinuto">
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
											<select class="large-5 columns" name="entradaNoiteHora">
												<option value="18">18</option>
												<option value="19">19</option>
												<option value="20">20</option>
												<option value="21">21</option>
												<option value="22">22</option>
											</select>
											<p class="large-2 columns"><b>:</b></p>
											<select class="large-5 columns" name="entradaNoiteMinuto">
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
											<select class="large-5 columns" name="saidaManhaHora">
												<option value="06">06</option>
												<option value="07">07</option>
												<option value="08">08</option>
												<option value="09">09</option>
												<option value="10">10</option>
												<option value="11">11</option>
												<option value="12">12</option>
											</select>
											<p class="large-2 columns"><b>:</b></p>
											<select class="large-5 columns" name="saidaManhaMinuto">
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
											<select class="large-5 columns" name="saidaTardeHora">
												<option value="13">13</option>
												<option value="14">14</option>
												<option value="15">15</option>
												<option value="16">16</option>
												<option value="17">17</option>
												<option value="18">18</option>
											</select>
											<p class="large-2 columns"><b>:</b></p>
											<select class="large-5 columns" name="saidaTardeMinuto">
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
											<select class="large-5 columns" name="saidaNoiteHora">
												<option value="18">18</option>
												<option value="19">19</option>
												<option value="20">20</option>
												<option value="21">21</option>
												<option value="22">22</option>
											</select>
											<p class="large-2 columns"><b>:</b></p>
											<select class="large-5 columns" name="saidaNoiteMinuto">
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
					<div class="large-4 columns">
						<label>Cabeçalho: <small>(Dimensões: 210mm X 30mm)</small></label>
						<input name="cabeca" type="file" />
					</div>
					<div class="large-4 columns">&nbsp;</div>
					<div class="large-4 columns">
						<input type="submit" class="button large-12" value="Salvar">
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