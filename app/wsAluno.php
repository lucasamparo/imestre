<?php
require_once('../models/bootstrap.php');

$idAluno = $_GET['id'];

$a = new Aluno();
$a->setIdAluno($idAluno);
$aluno = $a->retornaAlunoPorId();

echo $aluno->getJson();