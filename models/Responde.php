<?php

/**
 * Responde
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @package    ##PACKAGE##
 * @subpackage ##SUBPACKAGE##
 * @author     ##NAME## <##EMAIL##>
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
class Responde extends BaseResponde
{
	public function getIdAluno() {
		return $this->idAluno;
	}
	public function setIdAluno($idAluno) {
		$this->idAluno = $idAluno;
		return $this;
	}
	public function getIdAvaliacao() {
		return $this->idAvaliacao;
	}
	public function setIdAvaliacao($idAvaliacao) {
		$this->idAvaliacao = $idAvaliacao;
		return $this;
	}
	public function getConceito() {
		return $this->conceito;
	}
	public function setConceito($conceito) {
		$this->conceito = $conceito;
		return $this;
	}
	public function getAvaliacao() {
		return $this->Avaliacao;
	}
	public function setAvaliacao($Avaliacao) {
		$this->Avaliacao = $Avaliacao;
		return $this;
	}
	public function getAluno() {
		return $this->Aluno;
	}
	public function setAluno($Aluno) {
		$this->Aluno = $Aluno;
		return $this;
	}
}