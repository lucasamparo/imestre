<?php

/**
 * BaseAreamaior
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $idAreaMaior
 * @property string $nomeArea
 * @property Doctrine_Collection $Areamenor
 * 
 * @package    ##PACKAGE##
 * @subpackage ##SUBPACKAGE##
 * @author     ##NAME## <##EMAIL##>
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseAreamaior extends Doctrine_Record
{
    public function setTableDefinition()
    {
        $this->setTableName('areamaior');
        $this->hasColumn('idAreaMaior', 'integer', 4, array(
             'type' => 'integer',
             'length' => 4,
             'fixed' => false,
             'unsigned' => false,
             'primary' => true,
             'autoincrement' => true,
             ));
        $this->hasColumn('nomeArea', 'string', 100, array(
             'type' => 'string',
             'length' => 100,
             'fixed' => false,
             'unsigned' => false,
             'primary' => false,
             'notnull' => true,
             'autoincrement' => false,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasMany('Areamenor', array(
             'local' => 'idAreaMaior',
             'foreign' => 'idAreaMaior'));
    }
}