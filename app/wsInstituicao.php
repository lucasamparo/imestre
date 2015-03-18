<?php
require_once('../models/bootstrap.php');

$idInstituicao = $_GET['id'];

$inst = new Instituicao();
$inst->setIdInstituicao($idInstituicao);
$instituicao = $inst->retornaInstituicaoPorId();
echo $instituicao->getJson();