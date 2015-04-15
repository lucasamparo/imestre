<?php
	require_once('../models/bootstrap.php');
	session_start();
	if(!($_SESSION['logado'])){
		header('Location: index.php');
	}
	$p = new Professor();
	$item = new Itemcurriculo();
	$p->setIdProfessor($_SESSION['idProfessor']);
	$professor = $p->retornaProfessorPorId();
	$nome = explode(" ",$professor->getNomeProfessor());
?>
<html>
<head>
<title>iMestre :: �reas de Atua��o - Professor <?php echo $professor->getNomeProfessor();?></title>
<link rel="stylesheet" type="text/css" href="css/foundation.css">
<script language="JScript" src="js/vendor/jquery.js"></script>
<script language="JScript" src="js/vendor/modernizr.js"></script>
<script language="JScript" src="js/foundation.min.js"></script>
<script language="JScript" src='js/jquery.simplemodal.js'></script>
<script language="JScript" src='js/imestre.js'></script>
<script language="JScript">
jQuery(function ($) {
	$('#selec').click(function (e){
		areasMenores = new Array()
		areasMenores[0] = new Array("Matem�tica","Probabilidade e Estat�stica","Ci�ncia da Computa��o","Astronomia","F�sica","Qu�mica","Geoci�ncias","Oceanografia");
		areasMenores[1] = new Array("Biologia Geral","Gen�tica","Bot�nica","Zoologia","Ecologia","Morfologia","Fisiologia","Bioqu�mica","Biof�sica","Farmacologia","Imunologia","Microbiologia","Parasitologia");
		areasMenores[2] = new Array("Engenharia Civil","Engenharia de Minas","Engenharia de Materiais e Metal�rgica","Engenharia El�trica","Engenharia Mec�nica","Engenharia Qu�mica","Engenharia Sanit�ria","Engenharia de Produ��o","Engenharia Nuclear","Engenharia de Transportes","Engenharia Naval e Oce�nica","Engenharia Aeroespacial","Engenharia Biom�dica");
		areasMenores[3] = new Array("Medicina","Odontologia","Farm�cia","Enfermagem","Nutri��o","Sa�de Coletiva","Fonoaudiologia","Fisioterapia e Terapia Ocupacional","Educa��o F�sica");
		areasMenores[4] = new Array("Agronomia","Recursos Florestais e Engenharia Florestal","Engenharia Agr�cola","Zootecnia","Medicina Veterin�ria","Recursos Pesqueiros e Engenharia de Pesca","Ci�ncia e Tecnologia de Alimentos");
		areasMenores[5] = new Array("Direito","Administra��o","Economia","Arquitetura e Urbanismo","Planejamento Urbano e Regional","Demografia","Ci�ncia da Informa��o","Museologia","Comunica��o","Servi�o Social","Economia Dom�stica","Desenho Industrial","Turismo");
		areasMenores[6] = new Array("Filosofia","Sociologia","Antropologia","Arqueologia","Hist�ria","Geografia","Psicologia","Educa��o","Ci�ncia Pol�tica","Teologia");
		areasMenores[7] = new Array("Ling��stica","Letras","Artes");
		areasMenores[8] = new Array("Bio�tica","Ci�ncias Ambientais");
		var v = $('#areaMaior').val();
		$('#areaMenor').html("");
		for(i = 0; i < areasMenores[v].length; i++){
			$('#areaMenor').append(new Option(areasMenores[v][i],i));
		}
		$('#areaMenor').attr('size',areasMenores[v].length);
		$('#areaMenor').css('display','inline');
		$('#areaMenor').css('height','auto');
	});
});
</script>
</head>
<body onload="arrumaMenu('areas')">
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
			<h3 class="text-center">�reas de Atua��o</h3>
			<form method="post">
				<div class="large-12 columns">
					<div class="large-9 columns">
						<select name="areaMaior" id="areaMaior">
							<option value="0">Ci�ncias Exatas e da Terra</option>
							<option value="1">Ci�ncias Biol�gicas</option>
							<option value="2">Engenharias</option>
							<option value="3">Ci�ncias da Sa�de</option>
							<option value="4">Ci�ncias Agr�rias</option>
							<option value="5">Ci�ncias Sociais Aplicadas</option>
							<option value="6">Ci�ncias Humanas</option>
							<option value="7">Lingu�stica, Letras e Artes</option>
							<option value="8">Outros</option>
						</select>
					</div>
					<div class="large-2 columns">
						<a href="#" class="button tiny" id="selec">Selecionar</a>
					</div>
					<div class="large-1 columns">&nbsp;</div>
					<div class="large-12 columns">
						<span data-tooltip aria-haspopup="true" class="has-tip" title="Use a tecla 'shift' para selecionar mais de uma �rea">
							<select id="areaMenor" style="display: none" class="large-9" size="1" multiple></select>
						</span><br>
						<span>Sua �rea n�o est� ai? Entre em Contato!</span>
					</div>
				</div>
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