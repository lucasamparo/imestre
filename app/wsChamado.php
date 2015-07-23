<?php
require_once('../models/bootstrap.php');
$c = new Chamado();
$c->setIdChamado($_GET['id']);
echo $c->getJson();