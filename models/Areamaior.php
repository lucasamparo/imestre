<?php

/**
 * Areamaior
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @package    ##PACKAGE##
 * @subpackage ##SUBPACKAGE##
 * @author     ##NAME## <##EMAIL##>
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
class Areamaior extends BaseAreamaior
{
	public function getIdAreaMaior() {
		return $this->idAreaMaior;
	}
	public function setIdAreaMaior($idAreaMaior) {
		$this->idAreaMaior = $idAreaMaior;
		return $this;
	}
	public function getNomeArea() {
		return $this->nomeArea;
	}
	public function setNomeArea($nomeArea) {
		$this->nomeArea = $nomeArea;
		return $this;
	}
	public function getAreamenor() {
		return $this->Areamenor;
	}
	public function setAreamenor($Areamenor) {
		$this->Areamenor = $Areamenor;
		return $this;
	}
	
	public function retornaTodasAreas(){
		try{
			return $this->getTable()->findAll();
		} catch (Doctrine_Exception $e){
			echo $e->getMessage();
		}
	}
}