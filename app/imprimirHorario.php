<?php
if(isset($_POST)){
	require_once('../models/bootstrap.php');
	require_once '../libs/fpdf/fpdf.php';
	session_start();
	$completo = false;
	
	$p = new Professor();
	$p->setIdProfessor($_SESSION['idProfessor']);
	$prof = $p->retornaProfessorPorId();
	$inicio = 0;
	$fim = 0;
	
	if($_POST['modo'] == 'completo'){
		$inicio = 6;
		$fim = 22;
	}
	if($_POST['modo'] == 'manha'){
		$inicio = 6;
		$fim = 13;
	}
	if($_POST['modo'] == 'tarde'){
		$inicio = 13;
		$fim = 19;
	}
	if($_POST['modo'] == 'noite'){
		$inicio = 18;
		$fim = 22;
	}
	
	//Criando o array com os valores de aulas
	$json = str_replace("'", '"', $_POST['valores']);
	$array = explode("#$#", $json);
	$val = array();
	$c = 0;
	foreach($array as $a){
		if(strlen($a)>0){
			$b = json_decode($a);
			$val[$c]["texto"] = $b->title;
			$val[$c]["dia"] = explode("T", $b->start)[0];
			$val[$c]["inicio"] = str_replace("Z", "", explode("T", $b->start)[1]);
			$val[$c]["final"] = str_replace("Z", "", explode("T", $b->end)[1]);
			$c++;
		}
	}
		
	//Criando Impressão
	$pdf = new FPDF("L","mm","A4");
	$pdf->SetMargins(5, 5, 5);
	$pdf->AddPage();
	$pdf->SetY(10);
	$pdf->SetFont("Arial","",16);
	$pdf->Cell(0,0,"Professor ".$prof->getNomeProfessor(),0,1,"L");
	if($completo){
		$pdf->Cell(0,12,"Horários",0,1,"L");
	} else {
		$pdf->Cell(0,12,"Horário - Turno ".$_POST['modo'],0,1,"L");
	}
	$pdf->SetFont("Arial","B",10);
	//Cabeçalho
	$pdf->Cell(20,6,"Hora",1,0,'C');
	$d = array('Domingo','Segunda','Terça','Quarta','Quinta','Sexta','Sábado');
	foreach($d as $t){
		$pdf->Cell(38,6,$t,1,0,'C');
	}
	$pdf->ln();
	//Horas
	for($i = $inicio; $i < $fim; $i++){
		if($i < 10){
			$hr = '0'.$i;
		} else {
			$hr = $i;
		}
		for($j = 0; $j < 3; $j++){
			$min = 20*$j;
			if($min < 20){
				$min = "0".$min;
			}
			$pdf->Cell(20,3.3,$hr.":".$min,1,0,'C');
			for($k = 0; $k < 7; $k++){
				if($k == 6){
					if(($i == ($fim - 1))&&($j == 2)){
						$pdf->Cell(38,3.3,"","RB",1,'C');
					} else {
						$pdf->Cell(38,3.3,"","R",1,'C');
					}
				} else {
					if(($i == ($fim - 1))&&($j == 2)){
						$pdf->Cell(38,3.3,"","RB",0,'C');
					} else {
						$pdf->Cell(38,3.3,"","R",0,'C');
					}					
				}				
			}
		}	
	}
	//Imprimindo as aulas
	foreach($val as $v){
		$data = explode("-", $v['dia']);
		$dia = date('w',mktime(0,0,0,$data[1],$data[2],$data[0]));
		//Linha do início da aula
		$hinicio = explode(":", $v['inicio']);
		$horaInicio = $hinicio[0];
		$minutoInicio = $hinicio[1];
		$hinicio = explode(":", $v['final']);
		$horaFim = $hinicio[0];
		$minutoFim = $hinicio[1];
		if(($horaInicio >= $inicio)&&($horaFim < $fim)){
			$y = (28+(($horaInicio-$inicio)*9.9)+(0.165*$minutoInicio));
			$pdf->Line(((38*$dia)+25), $y, ((38*($dia+1))+25), $y);
			//Linha de final da aula
			$y1 = (28+(($horaFim-$inicio)*9.9)+(0.165*$minutoFim));
			$pdf->Line(((38*$dia)+25), $y1, ((38*($dia+1))+25), $y1);
			//Turma da Aula
			$pdf->Text(((38*$dia)+30), ($y + (($y1 - $y)/2)), $v['texto']);
		}		
	}
	$pdf->Output();
} else {
	header('Location: horarios.php');
}
