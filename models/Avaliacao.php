<?php

/**
 * Avaliacao
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @package    ##PACKAGE##
 * @subpackage ##SUBPACKAGE##
 * @author     ##NAME## <##EMAIL##>
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
class Avaliacao extends BaseAvaliacao
{
	public function getIdAvaliacao() {
		return $this->idAvaliacao;
	}
	public function setIdAvaliacao($idAvaliacao) {
		$this->idAvaliacao = $idAvaliacao;
		return $this;
	}
	public function getIdTurma() {
		return $this->idTurma;
	}
	public function setIdTurma($idTurma) {
		$this->idTurma = $idTurma;
		return $this;
	}
	public function getPeso() {
		return $this->peso;
	}
	public function setPeso($peso) {
		$this->peso = $peso;
		return $this;
	}
	public function getDataAvaliacao() {
		return $this->data;
	}
	public function setDataAvaliacao($data) {
		$this->data = $data;
		return $this;
	}
	public function getTurma() {
		return $this->Turma;
	}
	public function setTurma($Turma) {
		$this->Turma = $Turma;
		return $this;
	}
	public function getItemavaliacao() {
		return $this->Itemavaliacao;
	}
	public function setItemavaliacao($Itemavaliacao) {
		$this->Itemavaliacao = $Itemavaliacao;
		return $this;
	}
	public function getResponde() {
		return $this->Responde;
	}
	public function setResponde($Responde) {
		$this->Responde = $Responde;
		return $this;
	}
}