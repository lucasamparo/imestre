<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
// Verifique o caminho de acordo a versão baixada
require '../libs/doctrine/Doctrine.php';

spl_autoload_register(array('Doctrine', 'autoload'));
spl_autoload_register(array('Doctrine_Core', 'modelsAutoload'));

$manager = Doctrine_Manager::getInstance();
try {
  // Insira aqui os dados de sua conexão
  $conn = Doctrine_Manager::connection('mysql://imestre:1m3sTR3@localhost/imestre');

  $manager->setAttribute(Doctrine_Core::ATTR_MODEL_LOADING,
Doctrine_Core::MODEL_LOADING_CONSERVATIVE);
  $manager->setAttribute(Doctrine_Core::ATTR_EXPORT, Doctrine_Core::EXPORT_ALL);

  $profiler = new Doctrine_Connection_Profiler();
  $manager->setListener($profiler);

} catch (Doctrine_Manager_Exception $e) {
  print $e->getMessage();
}

Doctrine_Core::loadModels('../models');

?>