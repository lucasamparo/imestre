<?php

/**
 * Professor
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @package    ##PACKAGE##
 * @subpackage ##SUBPACKAGE##
 * @author     ##Lucas Amparo Barbosa## <##lucasamparo.ti@gmail.com##>
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
class Professor extends BaseProfessor{
	public function getIdProfessor() {
		return $this->idProfessor;
	}
	public function setIdProfessor($idProfessor) {
		$this->idProfessor = $idProfessor;
		return $this;
	}
	public function getNomeProfessor() {
		return $this->nomeProfessor;
	}
	public function setNomeProfessor($nomeProfessor) {
		$this->nomeProfessor = $nomeProfessor;
		return $this;
	}
	public function getNascimento() {
		return $this->nascimento;
	}
	public function setNascimento($nascimento) {
		$this->nascimento = $nascimento;
		return $this;
	}
	public function getTituloMax() {
		return $this->tituloMax;
	}
	public function setTituloMax($tituloMax) {
		$this->tituloMax = $tituloMax;
		return $this;
	}
	public function getAreaAtuacao() {
		return $this->areaAtuacao;
	}
	public function setAreaAtuacao($areaAtuacao) {
		$this->areaAtuacao = $areaAtuacao;
		return $this;
	}
	public function getNivelAtuacao() {
		return $this->nivelAtuacao;
	}
	public function setNivelAtuacao($nivelAtuacao) {
		$this->nivelAtuacao = $nivelAtuacao;
		return $this;
	}
	public function getLogradouro() {
		return $this->logradouro;
	}
	public function setLogradouro($logradouro) {
		$this->logradouro = $logradouro;
		return $this;
	}
	public function getNumero() {
		return $this->numero;
	}
	public function setNumero($numero) {
		$this->numero = $numero;
		return $this;
	}
	public function getBairro() {
		return $this->bairro;
	}
	public function setBairro($bairro) {
		$this->bairro = $bairro;
		return $this;
	}
	public function getCidade() {
		return $this->cidade;
	}
	public function setCidade($cidade) {
		$this->cidade = $cidade;
		return $this;
	}
	public function getEstado() {
		return $this->estado;
	}
	public function setEstado($estado) {
		$this->estado = $estado;
		return $this;
	}
	public function getPais() {
		return $this->pais;
	}
	public function setPais($pais) {
		$this->pais = $pais;
		return $this;
	}
	public function getCep() {
		return $this->cep;
	}
	public function setCep($cep) {
		$this->cep = $cep;
		return $this;
	}
	public function getEmail() {
		return $this->email;
	}
	public function setEmail($email) {
		$this->email = $email;
		return $this;
	}
	public function getTelCel() {
		return $this->telCel;
	}
	public function setTelCel($telCel) {
		$this->telCel = $telCel;
		return $this;
	}
	public function getLogin() {
		return $this->login;
	}
	public function setLogin($login) {
		$this->login = $login;
		return $this;
	}
	public function getSenha() {
		return $this->senha;
	}
	public function setSenha($senha) {
		$this->senha = $senha;
		return $this;
	}
	public function getItemcurriculo() {
		return $this->Itemcurriculo;
	}
	public function setItemcurriculo($Itemcurriculo) {
		$this->Itemcurriculo = $Itemcurriculo;
		return $this;
	}
	public function getMensagem() {
		return $this->Mensagem;
	}
	public function setMensagem($Mensagem) {
		$this->Mensagem = $Mensagem;
		return $this;
	}
	public function getTrabalha() {
		return $this->Trabalha;
	}
	public function setTrabalha($Trabalha) {
		$this->Trabalha = $Trabalha;
		return $this;
	}
	public function getValidador() {
		return $this->validador;
	}
	public function setValidador($validador) {
		$this->validador = $validador;
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
	public function getAluno() {
		return $this->Aluno;
	}
	public function setAluno($Aluno) {
		$this->Aluno = $Aluno;
		return $this;
	}
	public function getFuncionalidades() {
		return $this->Funcionalidades;
	}
	public function setFuncionalidades($Funcionalidades) {
		$this->Funcionalidades = $Funcionalidades;
		return $this;
	}
		
	public function inserirProfessor(){
		try{
			$this->save();
			return true;
		} catch(Doctrine_Exception $e){
			echo $e->getMessage();
		}
	}
	
	public function retornaTodosProfessores(){
		try{
			$rs = $this->getTable("professor")->findAll();
			return $rs;
		} catch(Doctrine_Exception $e){
			echo $e->getMessage();
		}
	}
	
	public function excluirProfessor(){
		try{
			$professor = $this->getTable('professor')->find($this->getIdProfessor());
			if($professor){
				$professor->delete();
				return true;
			} else {
				return false;
			}
		} catch(Doctrine_Exception $e){
			echo $e->getMessage();
		}
	}
	
	public function validaProfessor(){
		try{
			$sql = "Update professor set validador = 'V' where idProfessor = ".$this->getIdProfessor();
			$this->getTable()->getConnection()->prepare($sql)->execute();
		} catch(Doctrine_Exception $e){
			echo $e->getMessage();
		}
	}
	
	public function atualizaProfessor(){
		try{
			$professor = $this->getTable('professor')->find($this->getIdProfessor());
			if($professor){
				//Sobrepor os valores
				if(!is_null($this->getNome())){
					$professor->setNome($this->getNome());
				}				
				if(!is_null($this->getNascimento())){
					$professor->setNascimento($this->getNascimento());					
				}
				if(!is_null($this->getTituloMax())){
					$professor->setTituloMax($this->getTituloMax());
				}
				if(!is_null($this->getAreaAtuacao())){
					$professor->setAreaAtuacao($this->getAreaAtuacao());
				}
				if(!is_null($this->getNivelAtuacao())){
					$professor->setNivelAtuacao($this->getNivelAtuacao());
				}
				if(!is_null($this->getLogradouro())){
					$professor->setLogradouro($this->getLogradouro());
				}
				if(!is_null($this->getNumero())){
					$professor->setNumero($this->getNumero());
				}
				if(!is_null($this->getBairro())){
					$professor->setBairro($this->getBairro());
				}
				if(!is_null($this->getCidade())){
					$professor->setCidade($this->getCidade());
				}
				if(!is_null($this->getEstado())){
					$professor->setEstado($this->getEstado());
				}
				if(!is_null($this->getPais())){
					$professor->setPais($this->getPais());
				}
				if(!is_null($this->getCep())){
					$professor->setCep($this->getCep());
				}
				if(!is_null($this->getEmail())){
					$professor->setEmail($this->getEmail());
				}
				if(!is_null($this->getTelCel())){
					$professor->setTelCel($this->getTelCel());					
				}
				if(!is_null($this->getLogin())){
					$professor->setLogin($this->getLogin());					
				}
				if(!is_null($this->getSenha())){
					$professor->setSenha($this->getSenha());
				}
				$professor->save();
				return true;
			} else {
				return false;
			}
		} catch(Doctrine_Exception $e){
			echo $e->getMessage();
		}
	}
	
	public function retornaProfessorPorId(){
		try{
			return $this->getTable("professor")->findOneBy('idProfessor', $this->getIdProfessor());
		} catch(Doctrine_Exception $e){
			echo $e->getMessage();
		}
	}
	
	public function validarAcesso($login, $senha){
		$retorno = $this->getTable("Professor")->findOneBy('login',$login);
		if($retorno){
			if($retorno->getValidador() != 'V'){
				return false;
			}
			if($retorno->getSenha() == md5($senha)){
				return $retorno;
			} else {
				return false;
			}
		} else {
			return false;
		}
	}
	
	public function verificaEmail(){
		try{
			$r = $this->getTable()->findOneBy('email', $this->getEmail());
			if($r){
				return true;
			} else {
				return false;
			}
		} catch(Doctrine_Exception $e){
			echo $e->getMessage();
		}
	}
	
	public function validaLogin(){
		try{
			$r = $this->getTable()->findOneBy('login', $this->getLogin());
			if($r){
				return true;
			} else {
				return false;
			}
		} catch(Doctrine_Exception $e){
			echo $e->getMessage();
		}
	}
	
	public function validarCadastro(){
		try{
			$r = $this->getTable()->findOneBy('idProfessor', $this->getIdProfessor());
			if($r){
				$r->setValidador('V');
				$r->save();
			}
		} catch(Doctrine_Exception $e){
			echo $e->getMessage();
		}
	}
}