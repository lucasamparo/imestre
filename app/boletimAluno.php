<?php
	require_once('../models/bootstrap.php');
	require_once '../libs/fpdf/fpdf.php';
	$idAluno = $_GET['id'];
	
	function exibirTurma($indice, FPDF $pdf, Turma $turma, $notas){
		//$notas é um array [][] onde o primeiro campo é o nome da prova
		//e o segundo é a nota da respectiva prova
		$pdf->SetFillColor(255,0,0);
		$pdf->SetTextColor(255);
		$pdf->SetDrawColor(128,0,0);
		$pdf->SetLineWidth(.3);
		$pdf->SetFont('','B');
		// Header
		$i = $indice % 3;
		$j = floor($indice/3);
		$pX = ($i*90)+(5*($i+1));
		$pY = 15+($j*58);
		$pdf->setY($pY);
		$pdf->SetX($pX);
		$pdf->Cell(90,7,$turma->getNomeTurma()." -  Nº de Avaliações: ".count($turma->getAvaliacao()),1,0,'C',true);
		$pdf->Ln();
		// Color and font restoration
		$pdf->SetFillColor(224,235,255);
		$pdf->SetTextColor(0);
		$pdf->SetFont('');
		// Data
		$fill = false;
		foreach($notas as $row){
			for($i=0;$i<count($row);$i++){
				if($i==0){
					$pdf->SetX($pX);
				}
				$pdf->Cell(45,6,$row[$i],'LR',0,'L',$fill);
			}
			$pdf->Ln();
			$fill = !$fill;
		}
		// Closing line
		$pdf->SetX($pX);
		$pdf->Cell(90,0,'','T');
	}
	
	//Criando Impressão
	$pdf = new FPDF("L","mm","A4");
	$pdf->SetMargins(5, 5, 5);
	$pdf->AddPage();
	$pdf->SetY(10);
	$pdf->SetFont("Arial","",16);
	
	//Pegar o aluno
	$a = new Aluno();
	$a->setIdAluno($idAluno);
	$a = $a->retornaAlunoPorId();
	
	//Pegar Turmas do Aluno
	$at = $a->getAlunoturma();
	
	$pdf->Cell(0,0,$a->getNomeAluno()." - Nº de Turmas: ".count($at),0,1,"L");
	$pdf->Ln(4);
	$pdf->Cell(0,0,"",1,1,"L");
	$count = 0;
	foreach($at as $a1){
		//Pega avaliações e notas dessa turma
		$pdf->Ln(10);
		$turma = $a1->getTurma();
		$aval = $turma->getAvaliacao();
		$array = array();
		foreach($aval as $a2){
			$x[0] = Util::arrumaData($a2->getDataAvaliacao());
			$resp = $a->getResponde();
			$x[1] = "Não Realizada";
			foreach($resp as $r){
				if($r->getIdAvaliacao() == $a2->getIdAvaliacao()){
					$x[1] = $r->getConceito();
				}
			}
			$array[] = $x;
		}
		exibirTurma($count, $pdf, $turma, $array);
		$count++;
	}
	$pdf->Output();
?>