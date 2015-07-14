<?php
	require_once('../models/bootstrap.php');
	require_once '../libs/fpdf/fpdf.php';
	$idAluno = $_GET['id'];
	
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
	
	foreach($at as $a1){
		//Pega avaliações e notas dessa turma
		$pdf->Ln(10);
		$turma = $a1->getTurma();
		$pdf->SetFont("Arial","",14);
		$aval = $turma->getAvaliacao();
		$pdf->SetX(10);
		$pdf->Cell(0,0,"> ".$turma->getNomeTurma()." - Nº de Avaliações: ".count($aval),0,1,"L");
		$pdf->Ln(4);
		$pdf->Cell(0,0,"",1,0,"L");
		foreach($aval as $a2){
			$pdf->Ln(5);
			$pdf->SetFont("Arial","",12);
			$pdf->SetX(20);
			$pdf->Cell(0,0,"> ".Util::arrumaData($a2->getDataAvaliacao())." - Peso: ".$a2->getPeso(),0,1,"L");
			$pdf->Ln(4);
			$respostas = $a2->getResponde();
			$nota = "Não executada";
			foreach($respostas as $r){
				if($r->getIdAluno() == $idAluno){
					$nota = $r->getConceito();
				}
			}
			$pdf->SetX(25);
			$pdf->Cell(0,0,"Nota: ".$nota,0,1,"L");
		}
	}
	
	
	$pdf->Output();
?>