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
<title>iMestre :: Áreas de Atuação - Professor <?php echo $professor->getNomeProfessor();?></title>
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
		areasMenores[0] = new Array("Matemática","Probabilidade e Estatística","Ciência da Computação","Astronomia","Física","Química","Geociências","Oceanografia");
		areasMenores[1] = new Array("Biologia Geral","Genética","Botânica","Zoologia","Ecologia","Morfologia","Fisiologia","Bioquímica","Biofísica","Farmacologia","Imunologia","Microbiologia","Parasitologia");
		areasMenores[2] = new Array("Engenharia Civil","Engenharia de Minas","Engenharia de Materiais e Metalúrgica","Engenharia Elétrica","Engenharia Mecânica","Engenharia Química","Engenharia Sanitária","Engenharia de Produção","Engenharia Nuclear","Engenharia de Transportes","Engenharia Naval e Oceânica","Engenharia Aeroespacial","Engenharia Biomédica");
		areasMenores[3] = new Array("Medicina","Odontologia","Farmácia","Enfermagem","Nutrição","Saúde Coletiva","Fonoaudiologia","Fisioterapia e Terapia Ocupacional","Educação Física");
		areasMenores[4] = new Array("Agronomia","Recursos Florestais e Engenharia Florestal","Engenharia Agrícola","Zootecnia","Medicina Veterinária","Recursos Pesqueiros e Engenharia de Pesca","Ciência e Tecnologia de Alimentos");
		areasMenores[5] = new Array("Direito","Administração","Economia","Arquitetura e Urbanismo","Planejamento Urbano e Regional","Demografia","Ciência da Informação","Museologia","Comunicação","Serviço Social","Economia Doméstica","Desenho Industrial","Turismo");
		areasMenores[6] = new Array("Filosofia","Sociologia","Antropologia","Arqueologia","História","Geografia","Psicologia","Educação","Ciência Política","Teologia");
		areasMenores[7] = new Array("Lingüística","Letras","Artes");
		areasMenores[8] = new Array("Bioética","Ciências Ambientais");
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
			<h3 class="text-center">Áreas de Atuação</h3>
			<form method="post">
				<div class="large-12 columns">
					<div class="large-9 columns">
						<select name="areaMaior" id="areaMaior">
							<option value="0">Ciências Exatas e da Terra</option>
							<option value="1">Ciências Biológicas</option>
							<option value="2">Engenharias</option>
							<option value="3">Ciências da Saúde</option>
							<option value="4">Ciências Agrárias</option>
							<option value="5">Ciências Sociais Aplicadas</option>
							<option value="6">Ciências Humanas</option>
							<option value="7">Linguística, Letras e Artes</option>
							<option value="8">Outros</option>
						</select>
					</div>
					<div class="large-2 columns">
						<a href="#" class="button tiny" id="selec">Selecionar</a>
					</div>
					<div class="large-1 columns">&nbsp;</div>
					<div class="large-12 columns">
						<span data-tooltip aria-haspopup="true" class="has-tip" title="Use a tecla 'shift' para selecionar mais de uma área">
							<select id="areaMenor" style="display: none" class="large-9" size="1" multiple></select>
						</span><br>
						<span>Sua Área não está ai? Entre em Contato!</span>
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