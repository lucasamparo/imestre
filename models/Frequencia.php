<?php

/**
 * Frequencia
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @package    ##PACKAGE##
 * @subpackage ##SUBPACKAGE##
 * @author     ##NAME## <##EMAIL##>
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
class Frequencia extends BaseFrequencia
{
	public function getIdFrequencia() {
		return $this->idFrequencia;
	}
	public function setIdFrequencia($idFrequencia) {
		$this->idFrequencia = $idFrequencia;
		return $this;
	}
	public function getIdAluno() {
		return $this->idAluno;
	}
	public function setIdAluno($idAluno) {
		$this->idAluno = $idAluno;
		return $this;
	}
	public function getIdPlanejamento() {
		return $this->idPlanejamento;
	}
	public function setIdPlanejamento($idPlanejamento) {
		$this->idPlanejamento = $idPlanejamento;
		return $this;
	}
	public function getPresenca() {
		return $this->presenca;
	}
	public function setPresenca($presenca) {
		$this->presenca = $presenca;
		return $this;
	}
	public function getPlanejaementa() {
		return $this->Planejaementa;
	}
	public function setPlanejaementa($Planejaementa) {
		$this->Planejaementa = $Planejaementa;
		return $this;
	}
	public function getAluno() {
		return $this->Aluno;
	}
	public function setAluno($Aluno) {
		$this->Aluno = $Aluno;
		return $this;
	}
	
	public function lancarFrequencia(){
		try{
			$tmp = $this->copy();
			$q = Doctrine_Query::create()
							->select("*")
							->from('Frequencia')
							->from('Frequencia')
							->where('idAluno = '.$this->getIdAluno())
							->andWhere('idPlanejamento = '.$this->getIdPlanejamento());
			$f = $q->execute()[0];
			if($f){
				$f->setPresenca($tmp->getPresenca());
				$f->save();
			} else {
				$tmp->save();
			}
		} catch (Doctrine_Exception $e){
			echo $e->getMessage();
		}
	}
	
	static public function verificarFrequencia($idAluno, $idPlanejamento){
		try{
			$query = Doctrine_Query::create()
						->select('presenca')
						->from('Frequencia')
						->where('idAluno = '.$idAluno)
						->andWhere('idPlanejamento = '.$idPlanejamento);
			$rs = $query->execute();
			return $rs[0]->getPresenca();
		} catch (Doctrine_Exception $e){
			echo $e->getMessage();
		}
	}
}