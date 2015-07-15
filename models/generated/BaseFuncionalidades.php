<?php

/**
 * BaseFuncionalidades
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $idFuncionalidades
 * @property integer $idProfessor
 * @property enum $disco
 * @property enum $blog
 * @property Professor $Professor
 * 
 * @package    ##PACKAGE##
 * @subpackage ##SUBPACKAGE##
 * @author     ##NAME## <##EMAIL##>
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseFuncionalidades extends Doctrine_Record
{
    public function setTableDefinition()
    {
        $this->setTableName('funcionalidades');
        $this->hasColumn('idFuncionalidades', 'integer', 4, array(
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
             'notnull' => true,
             'autoincrement' => false,
             ));
        $this->hasColumn('disco', 'enum', 1, array(
             'type' => 'enum',
             'length' => 1,
             'fixed' => false,
             'unsigned' => false,
             'values' => 
             array(
              0 => 'S',
              1 => 'N',
             ),
             'primary' => false,
             'default' => 'N',
             'notnull' => true,
             'autoincrement' => false,
             ));
        $this->hasColumn('blog', 'enum', 1, array(
             'type' => 'enum',
             'length' => 1,
             'fixed' => false,
             'unsigned' => false,
             'values' => 
             array(
              0 => 'S',
              1 => 'N',
             ),
             'primary' => false,
             'default' => 'N',
             'notnull' => true,
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