<?php
require_once('../models/bootstrap.php');
$email = $_GET['e'];

$p = new Professor();
$p->setEmail($email);
if($p->verificaEmail()){
	$a[] = 'usado';
	echo json_encode($a);
} else {
	$a[] = 'nao_usado';
	echo json_encode($a);
}
?>