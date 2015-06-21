<?php
	require_once('../models/bootstrap.php');
	require_once '../libs/fpdf/fpdf.php';
	
	$idAvaliacao = $_GET['id'];
	$a = new Avaliacao();
	$a->setIdAvaliacao($idAvaliacao);
	$aval = $a->retornarAvaliacaoPorId();
	
	function montarQuestao(FPDF $pdf, Itemavaliacao $p){
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
				$alt = explode(";", $a);
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
				$json = str_replace("\r", "", $json);
				$json = str_replace("\n", "", $json);
				$json = str_replace("\t", "", $json);
				$obj = json_decode(utf8_encode($json));
				$c1 = explode(";", $obj->C1);
				$c2 = explode(";", $obj->C2);
				unset($c1[count($c1)-1]);
				unset($c2[count($c2)-1]);
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
	$pdf->SetFont("Arial","B",20);
	$pdf->Cell(0,10,"Avaliação de Teste",0,1,'C');
	$pdf->SetFont("Arial","B",10);
	$pdf->Cell(0,0,"_________________________________________________________________________________________",0,1,'C');
	$pdf->Ln(2);
	foreach($aval->retornarItemsOrdenados() as $p){
		montarQuestao($pdf, $p);
	}
	$pdf->SetFont("Arial","B",10);
	$pdf->Cell(0,10,"Boa Sorte!!",0,1,'C');
	$pdf->Cell(0,0,"_________________________________________________________________________________________",0,1,'C');
	
	$pdf->Output();
?>