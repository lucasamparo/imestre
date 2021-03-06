<?php

/**
 * BaseResponde
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $idAluno
 * @property integer $idAvaliacao
 * @property float $conceito
 * @property Aluno $Aluno
 * @property Avaliacao $Avaliacao
 * 
 * @package    ##PACKAGE##
 * @subpackage ##SUBPACKAGE##
 * @author     ##NAME## <##EMAIL##>
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseResponde extends Doctrine_Record
{
    public function setTableDefinition()
    {
        $this->setTableName('responde');
        $this->hasColumn('idAluno', 'integer', 4, array(
             'type' => 'integer',
             'length' => 4,
             'fixed' => false,
             'unsigned' => false,
             'primary' => true,
             'autoincrement' => false,
             ));
        $this->hasColumn('idAvaliacao', 'integer', 4, array(
             'type' => 'integer',
             'length' => 4,
             'fixed' => false,
             'unsigned' => false,
             'primary' => true,
             'autoincrement' => false,
             ));
        $this->hasColumn('conceito', 'float', null, array(
             'type' => 'float',
             'fixed' => false,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasOne('Aluno', array(
             'local' => 'idAluno',
             'foreign' => 'idAluno'));

        $this->hasOne('Avaliacao', array(
             'local' => 'idAvaliacao',
             'foreign' => 'idAvaliacao'));
    }
}