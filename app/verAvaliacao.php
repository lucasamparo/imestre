<?php
	require_once('../models/bootstrap.php');
	require_once '../libs/fpdf/fpdf.php';
	
	$idAvaliacao = $_GET['id'];
	$a = new Avaliacao();
	$a->setIdAvaliacao($idAvaliacao);
	$aval = $a->retornarAvaliacaoPorId();
	
	function montarQuestao(FPDF $pdf, Itemavaliacao $p){
		if($pdf->GetY() > 240){
			$pdf->AddPage();
			$pdf->SetY(20);
		}
		$pdf->SetFont("Arial","B",10);
		$pdf->Cell(0,10,$p->getIndice().") ".$p->getQuestao()->getEnunciado(),0,1,"L");
		$pdf->SetFont("Arial","",10);
		$letras = array('a','b','c','d','e','f','g','h','i','j');
		switch ($p->getQuestao()->getTipo()){
			case '0':
				//Dissertativa
				$pdf->Ln();
				$pdf->Ln();
				//$pdf->Ln();
				break;
			case '1':
				//Múltipla Escolha
				$a = $p->getQuestao()->getAlternativas();
				$a = trim($a);
				if($a[strlen($a)-1] == ";"){
					$a = substr($a, 0, (strlen($a)-1));
				}
				$alt = explode(";", $a);
				shuffle($alt);
				$i = 0;
				foreach($alt as $a){
					$pdf->Cell(70,5,$letras[$i].") ".trim($a),0,0,"L");
					$i++;
					if(($i % 3) == 0){
						$pdf->Cell(70,5,"",0,1,"L");
					}
				}
				$pdf->Ln();
				break;
			case '2':
				//Associativa
				$json = $p->getQuestao()->getAlternativas();
				$json = Util::limparJson($json);
				$obj = json_decode(utf8_encode($json));
				$c1 = $obj->C1;
				$c2 = $obj->C2;
				if($c1[strlen($c1)-1] == ";"){
					$c1 = substr($c1, 0, (strlen($c1)-1));
				}
				if($c2[strlen($c2)-1] == ";"){
					$c2 = substr($c2, 0, (strlen($c2)-1));
				}
				$c1 = explode(";", $c1);
				$c2 = explode(";", $c2);
				shuffle($c1);
				shuffle($c2);
				for($i = 0; $i < count($c1); $i++){
					$pdf->Cell(105,5,$letras[$i].") ".utf8_decode(trim($c1[$i])),0,0,"L");
					$pdf->Cell(105,5,"(   ) ".utf8_decode(trim($c2[$i])),0,0,"L");
					$pdf->Ln();
				}
				$pdf->Ln();
				break;
		}
	}
	
	
	//Criando Impressão
	$pdf = new FPDF("P","mm","A4");
	$pdf->SetMargins(5, 5, 5);
	$pdf->AddPage();
	//Inserindo o cabeçalho da instituição
	$idInstituicao = $aval->getTurma()->getInstituicao()->getIdInstituicao();
	$pdf->Image("cabecalho/header_".$idInstituicao.".png",0,0,210,30);
	$pdf->SetY(30);
	$pdf->SetFont("Arial","B",20);
	$disc = $aval->getTurma()->getDisciplina()->getNomeDisciplina();
	$pdf->Cell(0,10,"Avaliação de ".$disc,0,1,'C');
	$pdf->SetFont("Arial","B",10);
	$pdf->Cell(0,0,"_________________________________________________________________________________________",0,1,'C');
	$pdf->Ln(2);
	foreach($aval->retornarItemsOrdenados() as $p){
		montarQuestao($pdf, $p);
	}
	
	//Finalização da Prova
	$pdf->setY(266);
	$pdf->SetFont("Arial","B",10);
	$pdf->Cell(0,10,"Boa Sorte!!",0,1,'C');
	$pdf->Cell(0,0,"_________________________________________________________________________________________",0,1,'C');
	
	$pdf->Output();
?>