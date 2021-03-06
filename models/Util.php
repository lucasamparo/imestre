<?php
class Util{
	static public function apresentaTel($tel){
		$digitos = strlen($tel);
		if($digitos == 10){
			$arrumado = "(".substr($tel, 0, 2).") ".substr($tel,2,4)."-".substr($tel,6,4);
		} else {
			$arrumado = "(".substr($tel, 0, 2).") ".substr($tel,2,5)."-".substr($tel,7,4);
		}
		return $arrumado;
	}
	
	static public function limparJson($json){
		$json = str_replace("\r", "", $json);
		$json = str_replace("\n", "", $json);
		$json = str_replace("\t", "", $json);
		
		return $json;
	}
	
	static public function retornarStatusChamado($status){
		switch ($status){
			case 'A':
				return 'Aberto';
				break;
			case 'E':
				return 'Em Análise';
				break;
			case 'R':
				return 'Respondido';
				break;
			case 'F':
				return 'Encerrado';
				break;
		}
	}
	
	static public function arrumaData($data){
		$dt = explode("-", $data);
		return $dt[2]."/".$dt[1]."/".$dt[0];
	}
	
	static public function calculaIdade($data){
		$date = new DateTime($data);
		$interval = $date->diff( new DateTime(date('Y-m-d')) ); // data definida
		
		echo $interval->format('%Y');
	}
	
	static public function retornaTipoQuestao($codigo){
		switch($codigo){
			case 0:
				return "Dissertativa";
			case 1:
				return "Múltipla Escolha";
			case 2:
				return "Associativa";
		}
	}
	
	static public function arrumaHora($hora){
		$hr = explode(":",$hora);
		return $hr[0].":".$hr[1];
	}
	
	static public function retornaNomeMes($i){
		switch ($i){
			case 1:
				return "Janeiro";
			case 2:
				return "Fevereiro";
			case 3:
				return "Março";
			case 4:
				return "Abril";
			case 5:
				return "Maio";
			case 6:
				return "Junho";
			case 7:
				return "Julho";
			case 8:
				return "Agosto";
			case 9:
				return "Setembro";
			case 10:
				return "Outubro";
			case 11:
				return "Novembro";
			case 12:
				return "Dezembro";
		}
	}
	
	static public function ordenarObjeto($objeto, $ordenador, $operador){
		//TODO
		$c = count($objeto);
		for($i = 0; $i < $c; $i++){
			for($j = 1; $j < $i; $j++){
				$tmp = null;
				switch ($operador){
					case "<":
						if($objeto[$i]->$ordenador < $objeto[$j]->$ordenador){
	
						}
						break;
					case ">":
							
						break;
				}
			}
		}
	}
}
?>