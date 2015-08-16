<?php
	require_once('../models/bootstrap.php');
	session_start();
	if(!($_SESSION['logado'])){
		header('Location: index.php');
	}
	$p = new Professor();
	$p->setIdProfessor($_SESSION['idProfessor']);
	$professor = $p->retornaProfessorPorId();
	
	if(isset($_POST['json'])){
		$json = $_POST['json'];
		$json = str_replace("'", '"', $json);
		$array = explode("#$#",$json);
		$a = array();
		for($i = 0; $i < (count($array)-1); $i++){
			$a[] = $array[$i];
		}
		$stringJson = json_encode($a);
		$professor->setHorarios($stringJson);
		$professor->alterarHorarios();
	}
	
	$t = new Turma();
	$turmas = $t->retornarTurmasDeProfessor($professor->getIdProfessor());
?>

<html>
<head>
<title>iMestre :: Horários de Aulas - Professor <?php echo $professor->getNomeProfessor();?></title>
<link rel="stylesheet" type="text/css" href="css/foundation.css">
<script language="JScript" src="js/vendor/jquery.js"></script>
<script language="JScript" src="js/vendor/modernizr.js"></script>
<script language="JScript" src="js/foundation.min.js"></script>
<script language="JScript" src='js/jquery.simplemodal.js'></script>
<script language="JScript" src='js/imestre.js'></script>
<link rel="stylesheet" href="js/fullcalendar/fullcalendar.css" />
<script src='js/fullcalendar/lib/moment.min.js' charset="utf-8"></script>
<script src='js/fullcalendar/fullcalendar.js' charset="utf-8"></script>
<script src='js/fullcalendar/lang/pt-br.js'></script>
	<script language="Javascript">
		$(document).ready(function() {
			$('#imprimir').click(function (){
				val = $('#json').val();
				$('#valores').val(val);
			});
			$('#inserirEvento').click(function (){
				var event = new Object();	
				event.title = $('#slTurma').val();
				var horaInicio = new Date($('#data').val()+' '+$('#horaInicio').val()+':00');
				event.start = horaInicio;
				if(horaInicio.getHours() > 18){
					minutos = 40*60*1000;
				} else {
					minutos = 50*60*1000;
				}
				tempo = horaInicio.getTime()+($('#ch').val()*minutos);
				var horaFinal = new Date(tempo);
				event.end = horaFinal;
				//json = JSON.stringify(event);
				json = '{"title":"'+event.title+'","dow":"'+horaInicio.getDay()+'","start":"'+arrumaDataFullCalendar(event.start)+'","end":"'+arrumaDataFullCalendar(event.end)+'"}';
				val = $('#json').val();
				val = val + json + "#$#";
				$('#json').val(val);
				if(horaInicio.getHours() > 18){
					$('#noite').fullCalendar('renderEvent',event);
				} else{
					if(horaInicio.getHours() > 13){
						$('#tarde').fullCalendar('renderEvent',event);
					} else {
						$('#manha').fullCalendar('renderEvent',event);
					}
				}
			});
			$('#btManha').click(function (){
				$('#warpManha').css('display','inline');
				$('#warpTarde').css('display','none');
				$('#warpNoite').css('display','none');
				$('#turno').attr('checked',true);
				$('#turno').val('manha');
			});
			$('#btTarde').click(function (){
				$('#warpManha').css('display','none');
				$('#warpTarde').css('display','inline');
				$('#warpNoite').css('display','none');
				$('#turno').attr('checked',true);
				$('#turno').val('tarde');
			});
			$('#btNoite').click(function (){
				$('#warpManha').css('display','none');
				$('#warpTarde').css('display','none');
				$('#warpNoite').css('display','inline');
				$('#turno').attr('checked',true);
				$('#turno').val('noite');
			});
			$('#manha').fullCalendar({
				header: {
					//Configura o cabeçalho do calendário, com os botões "antes", "depois", "hoje" e Habilita
					//A seleção da visão que irá aparecer na agenda
					left: 'prev,next today',
					center: 'title',
					right: 'agendaWeek,agendaDay'
				},
				defaultView: 'agendaWeek',
				eventLimit: true,
				events: [
					//Aqui é onde você irá inserir os dados que irão aparecer no caledário
					<?php 
						$horarios = $professor->getHorarios();
						$horarios = json_decode($horarios);
						$count = count($horarios);
						for($i = 0; $i < $count; $i++){
							$x = json_decode($horarios[$i]);
							$data = date('Y-m-d');
							$d = explode("-", $data);
							$diaAtual = date('w',mktime(0,0,0,$d[1],$d[2],$d[0]));
							$tStamp = strtotime($data);
							$diaAlvo = date('Y-m-d',strtotime(($x->dow - $diaAtual).' day',$tStamp));
							$tmp = explode("T", $x->start);
							$dataAlvo = $diaAlvo."T".$tmp[1];
							if($i == ($count - 1)){
								echo "{ title: '".$x->title."', start: '".$dataAlvo."', end: '".$x->end."'}";
							} else {
								echo "{ title: '".$x->title."', start: '".$dataAlvo."', end: '".$x->end."'},";
							}							
						}
					?>
				],
				//Aqui habilita a edição em tempo de execução, com Drag&Drop.
				editable: false,
				eventDurationEditable: false,
				eventDrop: function (event) {
					//Evendo disparado quando solta o horário
				},
				//Aqui configura o horário que o calendário "funcionará"
				businessHours: {
					start: "07:00:00",
					end: "12:30:00",
					dow: "0123456"
				},
				eventClick: function (e){
					
				},
				dayClick: function (e){
					
				},
				//Aqui configura a divisão de espaços do calendário
				slotDuration: '00:20:00',
				//Aqui configura o primeiro horário que aparecerá no calendário
				minTime: "07:00:00",
				//Aqui configura o último horário que aparecerá no calendário
				maxTime: "12:30:00",
				contentHeight: 450
			});
			$('#tarde').fullCalendar({
				header: {
					//Configura o cabeçalho do calendário, com os botões "antes", "depois", "hoje" e Habilita
					//A seleção da visão que irá aparecer na agenda
					left: 'prev,next today',
					center: 'title',
					right: 'agendaWeek,agendaDay'
				},
				defaultView: 'agendaWeek',
				eventLimit: true,
				events:  [
					//Aqui é onde você irá inserir os dados que irão aparecer no caledário
					<?php 
						$horarios = $professor->getHorarios();
						$horarios = json_decode($horarios);
						$count = count($horarios);
						for($i = 0; $i < $count; $i++){
							$x = json_decode($horarios[$i]);
							if($i == ($count - 1)){
								echo "{ title: '".$x->title."', start: '".$x->start."', end: '".$x->end."'}";
							} else {
								echo "{ title: '".$x->title."', start: '".$x->start."', end: '".$x->end."'},";
							}							
						}
					?>
				],
				//Aqui habilita a edição em tempo de execução, com Drag&Drop.
				editable: true,
				eventDurationEditable: false,
				eventDrop: function (event) {
					//Evendo disparado quando solta o horário
				},
				//Aqui configura o horário que o calendário "funcionará"
				businessHours: {
					start: "13:00:00",
					end: "18:30:00",
					dow: "0123456"
				},
				eventClick: function (e){
					
				},
				dayClick: function (e){
					
				},
				//Aqui configura a divisão de espaços do calendário
				slotDuration: '00:20:00',
				//Aqui configura o primeiro horário que aparecerá no calendário
				minTime: '13:00',
				//Aqui configura o último horário que aparecerá no calendário
				maxTime: '18:00',
				contentHeight: 450
			});
			$('#noite').fullCalendar({
				header: {
					//Configura o cabeçalho do calendário, com os botões "antes", "depois", "hoje" e Habilita
					//A seleção da visão que irá aparecer na agenda
					left: 'prev,next today',
					center: 'title',
					right: 'agendaWeek,agendaDay'
				},
				defaultView: 'agendaWeek',
				eventLimit: true,
				events:  [
					//Aqui é onde você irá inserir os dados que irão aparecer no caledário
					<?php 
						$horarios = $professor->getHorarios();
						$horarios = json_decode($horarios);
						$count = count($horarios);
						for($i = 0; $i < $count; $i++){
							$x = json_decode($horarios[$i]);
							if($i == ($count - 1)){
								echo "{ title: '".$x->title."', start: '".$x->start."', end: '".$x->end."'}";
							} else {
								echo "{ title: '".$x->title."', start: '".$x->start."', end: '".$x->end."'},";
							}							
						}
					?>
				],
				//Aqui habilita a edição em tempo de execução, com Drag&Drop.
				editable: true,
				eventDurationEditable: false,
				eventDrop: function (event) {
					//Evendo disparado quando solta o horário
				},
				//Aqui configura o horário que o calendário "funcionará"
				businessHours: {
					start: "18:00:00",
					end: "22:00:00",
					dow: "0123456"
				},
				eventClick: function (e){
					
				},
				dayClick: function (e){
					
				},
				//Aqui configura a divisão de espaços do calendário
				slotDuration: '00:20:00',
				//Aqui configura o primeiro horário que aparecerá no calendário
				minTime: '18:00',
				//Aqui configura o último horário que aparecerá no calendário
				maxTime: '22:00',
				contentHeight: 400
			})
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
		<div class="large-12 columns">
			<h3 class="text-center">Horários</h3>
			<div class="row collapse">
				<div class="large-3 columns">
					<a href="#warpManha" class="tiny button large-10" id="btManha">Manhã</a>
				</div>
				<div class="large-3 columns">
					<a href="#warpTarde" class="tiny button large-10" id="btTarde">Tarde</a>
				</div>
				<div class="large-3 columns end">
					<a href="#warpNoite" class="tiny button large-10" id="btNoite">Noite</a>
				</div>
			</div>
		</div>
		<div class="large-12 columns">
			<br><br>
		</div>
		<div class="large-12 columns" id="horarios">
			<div id="warpManha"><div id="manha"></div></div>
			<div id="warpTarde"><div id="tarde"></div></div>
			<div id="warpNoite"><div id="noite"></div></div>
			<fieldset>
				<?php 
					//Criando conteúdo da persistência;
					$h = json_decode($professor->getHorarios());
					$paraJson = "";
					if(!is_null($h)){
						foreach($h as $a){
							$paraJson .= $a."#$#";
						}
						$paraJson = str_replace('"', "'", $paraJson);
					}					
				?>
				<legend>Configurações</legend>
				<form method="post" action="horarios.php">
					<input type="hidden" name="json" id="json" value="<?= $paraJson?>">
					<div class="large-4 columns">
						<input type="submit" name="persistir" value="Persistir Horários" id="persistir" class="tiny button large-6">
					</div>
				</form>
				<form method="post" action="imprimirHorario.php">
					<div class="large-4 columns">
						<input type="radio" name="modo" value="completo" id="completo" checked><label for="completo">Imprimir Horário Completo</label>
					</div>
					<div class="large-3 columns">
						<input type="radio" name="modo" id="turno"><label for="completo">Imprimir Turno Atual</label>
					</div>
					<div class="large-1 columns">
						<input type="hidden" name="valores" id="valores">
						<input type="submit" value="Imprimir" class="tiny button" id="imprimir">
					</div>
				</form>
			</fieldset>
			<fieldset>
				<legend>Novo Evento</legend>
				<div class="large-3 columns">
					<label>Turma:</label>
					<select name="turmas" id="slTurma">
						<?php 
							$s = true;
							$selected = '';
							foreach($turmas as $t){
								if($s){
									$selected = 'selected';
									$s = !$s;
								}
								echo '<option value="'.$t->getNomeTurma().'" '.$selected.'>'.$t->getNomeTurma().'</option>';
							}
						?>
					</select>
				</div>
				<div class="large-3 columns">
					<label>Data:</label>
					<input type="date" name="data" value="<?= date('Y-m-d')?>" id="data">
				</div>
				<div class="large-2 columns">
					<label>Hora de Início:</label>
					<input type="time" name="horaInicio" value="06:00" id="horaInicio">
				</div>
				<div class="large-2 columns">
					<label>C. Horária:</label>
					<select name="ch" id="ch">
						<option value="1">1 Hora/Aula</option>
						<option value="2">2 Horas/Aulas</option>
						<option value="3">3 Horas/Aulas</option>
						<option value="4">4 Horas/Aulas</option>
					</select>
				</div>
				<div class="large-2 columns">
					<label>&nbsp;</label>
					<a href="#horarios" class="large-12 button tiny" id="inserirEvento">Inserir</a>
				</div>
			</fieldset>
		</div>
		<div class="large-12 columns">
			<?php include('footer.php')?>
		</div>		
	</div>
</body>
<script>
  $(document).foundation();
</script>
</html>