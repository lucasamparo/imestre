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
	
	static public function arrumaData($data){
		$dt = explode("-", $data);
		return $dt[2]."/".$dt[1]."/".$dt[0];
	}
	
	static public function calculaIdade($data){
		$date = new DateTime($data);
		$interval = $date->diff( new DateTime(date('Y-m-d')) ); // data definida
		
		echo $interval->format('%Y');
	}
	
	static public function retornaParentesco($codigo){
		switch ($codigo){
			case 0:
				return "Pai";
			case 1:
				return "Mãe";
			case 2:
				return "Irmã(o)";
			case 3:
				return "Primo(a)";
			case 4:
				return "Tio(a)";
			case 5:
				return "Esposo(a)";
			case 6:
				return "Filho(a)";
		}
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
}
?>