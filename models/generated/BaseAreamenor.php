<?php

/**
 * BaseAreamenor
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $idAreaMenor
 * @property integer $idAreaMaior
 * @property string $nomeArea
 * @property Areamaior $Areamaior
 * @property Doctrine_Collection $Disciplina
 * 
 * @package    ##PACKAGE##
 * @subpackage ##SUBPACKAGE##
 * @author     ##NAME## <##EMAIL##>
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseAreamenor extends Doctrine_Record
{
    public function setTableDefinition()
    {
        $this->setTableName('areamenor');
        $this->hasColumn('idAreaMenor', 'integer', 4, array(
             'type' => 'integer',
             'length' => 4,
             'fixed' => false,
             'unsigned' => false,
             'primary' => true,
             'autoincrement' => true,
             ));
        $this->hasColumn('idAreaMaior', 'integer', 4, array(
             'type' => 'integer',
             'length' => 4,
             'fixed' => false,
             'unsigned' => false,
             'primary' => false,
             'notnull' => true,
             'autoincrement' => false,
             ));
        $this->hasColumn('nomeArea', 'string', null, array(
             'type' => 'string',
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
        $this->hasOne('Areamaior', array(
             'local' => 'idAreaMaior',
             'foreign' => 'idAreaMaior'));

        $this->hasMany('Disciplina', array(
             'local' => 'idAreaMenor',
             'foreign' => 'idAreaMenor'));
    }
}