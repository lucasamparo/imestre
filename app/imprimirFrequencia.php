<?php
require_once('../models/bootstrap.php');
require_once '../libs/fpdf/fpdf.php';
session_start();

$idTurma = $_GET['id'];
$t = new Turma();
$t->setIdTurma($idTurma);
$aulas = $t->retornarAulasPlanejadas();
$turma = $t->retornaTurmaPorId();

//Criando Impressão
$pdf = new FPDF("L","mm","A4");
$pdf->SetMargins(5, 5, 5);
$pdf->AddPage();
$pdf->SetY(10);
$pdf->SetFont("Arial","",16);
$pdf->Cell(0,0,"Frequência - Turma ".$turma->getNomeTurma(),0,1,"L");
$pdf->Line(5, $pdf->getY()+5, 292, $pdf->getY()+5);

//Imprimindo Cabeçalho
$pdf->SetXY(5, 16);
$pdf->SetFont("Arial","",10);
$pdf->Cell(70,6,"Aluno",1,0,'C');
foreach($aulas as $a){
	$data = explode("-",$a->getPrevisto());
	$pdf->Cell(10,6,$data[2]."/".$data[1],1,0,'C');
}
$pdf->Ln();

//Imprimindo alunos e suas presenças
$alunos = $turma->retornarAlunosEmOrdem();
foreach($alunos as $a){
	$pdf->Cell(70,6,$a->getAluno()->getNomeAluno(),1,0,'C');
	$presencas = $a->getAluno()->retornarPresencasEmTurma($turma->getIdTurma());
	foreach($presencas as $p){
		if($p->getPresenca() == 'P'){
			$pdf->Cell(10,6,"P",1,0,'C');
		} else {
			$pdf->Cell(10,6,"*",1,0,'C');
		}
	}
	$pdf->Ln();
}

$pdf->Output();