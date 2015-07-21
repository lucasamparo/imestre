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
	
	if(isset($_GET['id'])){
		$i = new Instituicao();
		$i->setIdInstituicao($_GET['id']);
		$i = $i->retornaInstituicaoPorId();
		$turmas = $i->getTurma();
	} else {
		header('Location: inicio.php');
	}
?>

<html>
<head>
<title>iMestre :: Horários de Aulas - Professor <?php echo $professor->getNomeProfessor();?></title>
<link rel="stylesheet" type="text/css" href="css/foundation.css">
<script language="JScript" src="js/vendor/jquery.js"></script>
<script language="JScript" src="js/vendor/modernizr.js"></script>
<script language="JScript" src="js/foundation.min.js"></script>
<script language="JScript" src='js/jquery.simplemodal.js'></script>
<link rel="stylesheet" href="js/fullcalendar/fullcalendar.css" />
<script src='js/fullcalendar/lib/moment.min.js' charset="utf-8"></script>
<script src='js/fullcalendar/fullcalendar.js' charset="utf-8"></script>
<script src='js/fullcalendar/lang/pt-br.js'></script>
	<script language="Javascript">
		$(document).ready(function() {
			var codigo = <?= $_GET['id']?>; 
			var retorno;
			var horas;
			var DoW = [];
			 var req = $.ajax({
			    url:    "wsInstituicao.php",
			    type:   "get",
			    dataType:"json",
			    data:   "id="+codigo,
			    async: false,

			    success: function( data ){
			        retorno = data;
			        horas = JSON.parse(data.funcionamento);
			        for(i = 0; i < 7; i++){
						if(data.dias[i] == 1){
							DoW.push(i);
						}
			        }    
			    }
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
			});
			$('#btTarde').click(function (){
				$('#warpManha').css('display','none');
				$('#warpTarde').css('display','inline');
				$('#warpNoite').css('display','none');
			});
			$('#btNoite').click(function (){
				$('#warpManha').css('display','none');
				$('#warpTarde').css('display','none');
				$('#warpNoite').css('display','inline');
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
				events: {
					//Aqui é onde você irá inserir os dados que irão aparecer no caledário
					//Nesse caso, ele importa um json que vem da página json.php
				},
				//Aqui habilita a edição em tempo de execução, com Drag&Drop.
				editable: true,
				eventDurationEditable: false,
				eventDrop: function (event) {
					//Evendo disparado quando solta o horário
				},
				//Aqui configura o horário que o calendário "funcionará"
				businessHours: {
					start: horas.manhaEntrada,
					end: horas.manhaSaida,
					dow: DoW
				},
				eventClick: function (e){
					
				},
				dayClick: function (e){
					
				},
				//Aqui configura a divisão de espaços do calendário
				slotDuration: '00:20:00',
				//Aqui configura o primeiro horário que aparecerá no calendário
				minTime: horas.manhaEntrada,
				//Aqui configura o último horário que aparecerá no calendário
				maxTime: horas.manhaSaida,
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
				events: {
					//Aqui é onde você irá inserir os dados que irão aparecer no caledário
					//Nesse caso, ele importa um json que vem da página json.php
				},
				//Aqui habilita a edição em tempo de execução, com Drag&Drop.
				editable: true,
				eventDurationEditable: false,
				eventDrop: function (event) {
					//Evendo disparado quando solta o horário
				},
				//Aqui configura o horário que o calendário "funcionará"
				businessHours: {
					start: horas.tardeEntrada,
					end: horas.tardeSaida,
					dow: DoW
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
				events: {
					//Aqui é onde você irá inserir os dados que irão aparecer no caledário
					//Nesse caso, ele importa um json que vem da página json.php
				},
				//Aqui habilita a edição em tempo de execução, com Drag&Drop.
				editable: true,
				eventDurationEditable: false,
				eventDrop: function (event) {
					//Evendo disparado quando solta o horário
				},
				//Aqui configura o horário que o calendário "funcionará"
				businessHours: {
					start: horas.noiteEntrada,
					end: horas.noiteSaida,
					dow: DoW
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