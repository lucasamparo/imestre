<?php

/**
 * Ementa
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @package    ##PACKAGE##
 * @subpackage ##SUBPACKAGE##
 * @author     ##NAME## <##EMAIL##>
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
class Ementa extends BaseEmenta
{
	public function getIdEmenta() {
		return $this->idEmenta;
	}
	public function setIdEmenta($idEmenta) {
		$this->idEmenta = $idEmenta;
		return $this;
	}
	public function getIdDisciplina() {
		return $this->idDisciplina;
	}
	public function setIdDisciplina($idDisciplina) {
		$this->idDisciplina = $idDisciplina;
		return $this;
	}
	public function getAno() {
		return $this->ano;
	}
	public function setAno($ano) {
		$this->ano = $ano;
		return $this;
	}
	public function getDisciplina() {
		return $this->Disciplina;
	}
	public function setDisciplina($Disciplina) {
		$this->Disciplina = $Disciplina;
		return $this;
	}
	public function getItemementa() {
		return $this->Itemementa;
	}
	public function setItemementa($Itemementa) {
		$this->Itemementa = $Itemementa;
		return $this;
	}
}