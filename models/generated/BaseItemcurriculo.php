<?php

/**
 * BaseItemcurriculo
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $idItemCurriculo
 * @property integer $idProfessor
 * @property string $titulo
 * @property string $conteudo
 * @property string $ano
 * @property Professor $Professor
 * 
 * @package    ##PACKAGE##
 * @subpackage ##SUBPACKAGE##
 * @author     ##NAME## <##EMAIL##>
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseItemcurriculo extends Doctrine_Record
{
    public function setTableDefinition()
    {
        $this->setTableName('itemcurriculo');
        $this->hasColumn('idItemCurriculo', 'integer', 4, array(
             'type' => 'integer',
             'length' => 4,
             'fixed' => false,
             'unsigned' => false,
             'primary' => true,
             'autoincrement' => true,
             ));
        $this->hasColumn('idProfessor', 'integer', 4, array(
             'type' => 'integer',
             'length' => 4,
             'fixed' => false,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             ));
        $this->hasColumn('titulo', 'string', 255, array(
             'type' => 'string',
             'length' => 255,
             'fixed' => false,
             'unsigned' => false,
             'primary' => false,
             'notnull' => true,
             'autoincrement' => false,
             ));
        $this->hasColumn('conteudo', 'string', null, array(
             'type' => 'string',
             'fixed' => false,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             ));
        $this->hasColumn('ano', 'string', 12, array(
             'type' => 'string',
             'length' => 12,
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
        $this->hasOne('Professor', array(
             'local' => 'idProfessor',
             'foreign' => 'idProfessor'));
    }	
}