<?php
	require_once('../models/bootstrap.php');
	require_once '../libs/fpdf/fpdf.php';
	$idTurma = $_GET['id'];
	
	//Criando Impressão
	$pdf = new FPDF("L","mm","A4");
	$pdf->SetMargins(5, 5, 5);
	$pdf->AddPage();
	$pdf->SetY(10);
	$pdf->SetFont("Arial","",16);
	
	//Pegar a Turma
	$t = new Turma();
	$t->setIdTurma($idTurma);
	$turma = $t->retornaTurmaPorId();
	$pdf->SetFont("Arial","B",16);
	$pdf->Cell(30,0,"Turma: ",0,0,"L");
	$pdf->SetFont("Arial","",16);
	$pdf->Cell(0,0,$turma->getNomeTurma(),0,1,"L");
	$pdf->Ln(7);
	$pdf->SetFont("Arial","B",14);
	$pdf->Cell(30,0,"Instituicao: ",0,0,"L");
	$pdf->SetFont("Arial","",14);
	$pdf->Cell(0,0,$turma->getInstituicao()->getNomeInstituicao(),0,1,"L");
	$pdf->Ln(5);
	$pdf->Cell(0,0,"",1,1,"L");
	
	//Pegando os alunos desta turma
	$alunos = $turma->getAlunoturma();
	$aval = $turma->getAvaliacao();
	$header = array('Alunos');
	foreach($aval as $a){
		$header[] = Util::arrumaData($a->getDataAvaliacao());
	}
	$data = array();
	foreach($alunos as $a){
		$x = array($a->getAluno()->getNomeAluno());
		for($i = 0; $i < count($aval); $i++){
			$x[] = "0.0";
		}
		$i = 1;
		foreach($aval as $a1){
			$resp = $a->getAluno()->getResponde();
			foreach($resp as $r){
				if($a1->getIdAvaliacao() == $r->getIdAvaliacao()){
					$x[$i] = $r->getConceito();
				}	
			}
			$i++;
		}
		$data[] = $x;
	}
	//Tabela Colorida
	// Colors, line width and bold font
	$pdf->Ln(10);
	$pdf->SetFillColor(255,0,0);
	$pdf->SetTextColor(255);
	$pdf->SetDrawColor(128,0,0);
	$pdf->SetLineWidth(.3);
	$pdf->SetFont('','B');
	// Header
	$w = array(100);
	for($i=0;$i<(count($header)-1);$i++){
		$w[] = 35;
	}
	for($i=0;$i<count($header);$i++){
		$pdf->Cell($w[$i],7,$header[$i],1,0,'C',true);
	}		
	$pdf->Ln();
		// Color and font restoration
	$pdf->SetFillColor(224,235,255);
	$pdf->SetTextColor(0);
	$pdf->SetFont('');
	// Data
	$fill = false;
	foreach($data as $row){
		for($i=0;$i<count($row);$i++){
			$pdf->Cell($w[$i],6,$row[$i],'LR',0,'L',$fill);
		}
		$pdf->Ln();
		$fill = !$fill;
	}
		// Closing line
	$pdf->Cell(array_sum($w),0,'','T');
	
	
	$pdf->Output();
?>