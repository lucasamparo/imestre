<?php

/**
 * Turma
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @package    ##PACKAGE##
 * @subpackage ##SUBPACKAGE##
 * @author     ##NAME## <##EMAIL##>
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
class Turma extends BaseTurma{
public function getIdTurma() {
		return $this->idTurma;
	}
	public function setIdTurma($idTurma) {
		$this->idTurma = $idTurma;
		return $this;
	}
	public function getIdInstituicao() {
		return $this->idInstituicao;
	}
	public function setIdInstituicao($idInstituicao) {
		$this->idInstituicao = $idInstituicao;
		return $this;
	}
	public function getIdDisciplina() {
		return $this->idDisciplina;
	}
	public function setIdDisciplina($idDisciplina) {
		$this->idDisciplina = $idDisciplina;
		return $this;
	}
	public function getNomeTurma() {
		return $this->nomeTurma;
	}
	public function setNomeTurma($nomeTurma) {
		$this->nomeTurma = $nomeTurma;
		return $this;
	}
	public function getCargaHoraria() {
		return $this->cargaHoraria;
	}
	public function setCargaHoraria($cargaHoraria) {
		$this->cargaHoraria = $cargaHoraria;
		return $this;
	}
	public function getPeriodo() {
		return $this->periodo;
	}
	public function setPeriodo($periodo) {
		$this->periodo = $periodo;
		return $this;
	}
	public function getTurno() {
		return $this->turno;
	}
	public function setTurno($turno) {
		$this->turno = $turno;
		return $this;
	}
	public function getInstituicao() {
		return $this->Instituicao;
	}
	public function setInstituicao($Instituicao) {
		$this->Instituicao = $Instituicao;
		return $this;
	}
	public function getDisciplina() {
		return $this->Disciplina;
	}
	public function setDisciplina($Disciplina) {
		$this->Disciplina = $Disciplina;
		return $this;
	}
	public function getAlunoturma() {
		return $this->Alunoturma;
	}
	public function setAlunoturma($Alunoturma) {
		$this->Alunoturma = $Alunoturma;
		return $this;
	}
	public function getAvaliacao() {
		return $this->Avaliacao;
	}
	public function setAvaliacao($Avaliacao) {
		$this->Avaliacao = $Avaliacao;
		return $this;
	}
	public function getPlanejaementa() {
		return $this->Planejaementa;
	}
	public function setPlanejaementa($Planejaementa) {
		$this->Planejaementa = $Planejaementa;
		return $this;
	}
	
	public function inserirTurma(){
		try{
			$this->save();
			return true;
		} catch(Doctrine_Exception $e){
			echo $e->getMessage();
		}
	}
	
	public function retornaTodasTurmas(){
		try{
			$rs = $this->getTable("turma")->findAll();
			return $rs;
		} catch(Doctrine_Exception $e){
			echo $e->getMessage();
		}
	}
	
	public function excluirTurma(){
		try{
			$turma = $this->getTable('turma')->find($this->getIdTurma());
			if($turma){
				$turma->delete();
				return true;
			} else {
				return false;
			}
		} catch(Doctrine_Exception $e){
			echo $e->getMessage();
		}
	}
	
	public function atualizaTurma(){
		try{
			$turma = $this->getTable('turma')->find($this->getIdTurma());
			if($turma){
				if(!is_null($this->getIdTurma())){
					$turma->setIdTurma($this->getIdTurma());
				}
				if(!is_null($this->getIdInstituicao())){
					$turma->setIdInstituicao($this->getIdInstituicao());
				}
				if(!is_null($this->getIdDisciplina())){
					$turma->setIdDisciplina($this->getIdDisciplina());
				}
				if(!is_null($this->getNomeTurma())){
					$turma->setNomeTurma($this->getNomeTurma());
				}
				if(!is_null($this->getCargaHoraria())){
					$turma->setCargaHoraria($this->getCargaHoraria());
				}
				if(!is_null($this->getPeriodo())){
					$turma->setPeriodo($this->getPeriodo());
				}
				if(!is_null($this->getTurno())){
					$turma->setTurno($this->getTurno());
				}
				$turma->save();
				return true;
			} else {
				return false;
			}
		} catch(Doctrine_Exception $e){
			echo $e->getMessage();
		}
	}
	
	public function retornaTurmaPorId(){
		try{
			return $this->getTable("turma")->findOneBy('idTurma', $this->getIdTurma());
		} catch(Doctrine_Exception $e){
			echo $e->getMessage();
		}
	}
	
	public function retornaAlunosDaTurma(){
		try{
			$at1 = new Alunoturma();
			$alunoTurmas = $at1->retornaAlunosDeTurma($this->getIdTurma());
			$alunos = null;
			foreach($alunoTurmas as $at){
				$a = new Aluno();
				$a->setIdAluno($at->getIdAluno());
				$alunos[] = $a->retornaAlunoPorId();
			}
			return $alunos;
		} catch(Doctrine_Exception $e){
			echo $e->getMessage();
		}
	}
	
	public function retornaAulasPorMes($mes){
		try{
			if(strlen($mes) == 1){
				$mes = '0'.$mes;
			}
			$table = Doctrine_Core::getTable('Planejaementa');
			$query = $table->createQuery()->addWhere("previsto like '".date('Y')."-".$mes."%'")
											->andWhere('idTurma = '.$this->getIdTurma());
			$rs = $query->execute();
			return $rs;
		} catch (Doctrine_Exception $e){
			echo $e->getMessage();
		}
	}
	
	public function retornarTurmasDeProfessor($id){
		try{
			$tb = Doctrine_Core::getTable('Instituicao')->findBy('idProfessor', $id);
			$rs = new Doctrine_Collection('Turma');
			foreach($tb as $t){
				foreach($t->getTurma() as $t1){
					$rs->add($t1);
				}
			}
			return $rs;
		} catch (Doctrine_Exception $e){
			echo $e->getMessage();
		}
	}
	
	public function getJson(){
		$array = Array();
		$array['idTurma'] = utf8_encode($this->idTurma);
		$array['idInstituicao'] = utf8_encode($this->idInstituicao);
		$array['idDisciplina'] = utf8_encode($this->idDisciplina);
		$array['nomeTurma'] = utf8_encode($this->nomeTurma);
		$array['cargaHoraria'] = utf8_encode($this->cargaHoraria);
		$array['periodo'] = utf8_encode($this->periodo);
		$array['turno'] = utf8_encode($this->turno);
		
		return json_encode($array);
	}
}