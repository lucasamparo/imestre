<?php
require_once('../models/bootstrap.php');
$login = $_GET['l'];

$p = new Professor();
$p->setLogin($login);
if($p->validaLogin()){
	$a[] = 'usado';
	echo json_encode($a);
} else {
	$a[] = 'nao_usado';
	echo json_encode($a);
}
?>