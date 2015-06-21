<?php
require_once('../models/bootstrap.php');

$idAssunto = $_GET['id'];

$a = new Assunto();
$a->setIdAssunto($idAssunto);
$assunto = $a->retornarAssuntoPorId();
$questoes = $assunto->getQuestao();
$array = array();
$i = 0;
foreach($questoes as $q){
	$array[$i]['enunciado'] = utf8_encode($q->getEnunciado());
	$array[$i]['tipo'] = $q->getTipo();
	$array[$i]['id'] = $q->getIdQuestao();
	$i++;
}
echo json_encode($array);