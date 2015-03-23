<?php
require_once('../models/bootstrap.php');

$idTurma = $_GET['id'];

$t = new Turma();
$t->setIdTurma($idTurma);
$turma = $t->retornaTurmaPorId();
echo $turma->getJson();