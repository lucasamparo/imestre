<?php

/**
 * Planejaementa
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @package    ##PACKAGE##
 * @subpackage ##SUBPACKAGE##
 * @author     ##NAME## <##EMAIL##>
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
class Planejaementa extends BasePlanejaementa
{
	public function getIdTurma() {
		return $this->idTurma;
	}
	public function setIdTurma($idTurma) {
		$this->idTurma = $idTurma;
		return $this;
	}
	public function getIdItemEmenta() {
		return $this->idItemEmenta;
	}
	public function setIdItemEmenta($idItemEmenta) {
		$this->idItemEmenta = $idItemEmenta;
		return $this;
	}
	public function getPrevisto() {
		return $this->previsto;
	}
	public function setPrevisto($previsto) {
		$this->previsto = $previsto;
		return $this;
	}
	public function getRealizado() {
		return $this->realizado;
	}
	public function setRealizado($realizado) {
		$this->realizado = $realizado;
		return $this;
	}
	public function getItemementa() {
		return $this->Itemementa;
	}
	public function setItemementa($Itemementa) {
		$this->Itemementa = $Itemementa;
		return $this;
	}
	
	public function inserirPlanejamento(){
		try{
			$this->save();
		} catch (Doctrine_Exception $e){
			echo $e->getMessage();
		}
	}
	
	public function retornaPlanejamentoPorIdTurma(){
		try{
			return $this->getTable()->findBy('idTurma', $this->getIdTurma());
		} catch (Doctrine_Exception $e){
			echo $e->getMessage();
		}
	}
}