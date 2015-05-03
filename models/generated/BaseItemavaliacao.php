<?php

/**
 * BaseItemavaliacao
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $idAvaliacao
 * @property integer $idQuestao
 * @property integer $indice
 * @property Avaliacao $Avaliacao
 * @property Questao $Questao
 * 
 * @package    ##PACKAGE##
 * @subpackage ##SUBPACKAGE##
 * @author     ##NAME## <##EMAIL##>
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseItemavaliacao extends Doctrine_Record
{
    public function setTableDefinition()
    {
        $this->setTableName('itemavaliacao');
        $this->hasColumn('idAvaliacao', 'integer', 4, array(
             'type' => 'integer',
             'length' => 4,
             'fixed' => false,
             'unsigned' => false,
             'primary' => true,
             'autoincrement' => false,
             ));
        $this->hasColumn('idQuestao', 'integer', 4, array(
             'type' => 'integer',
             'length' => 4,
             'fixed' => false,
             'unsigned' => false,
             'primary' => true,
             'autoincrement' => false,
             ));
        $this->hasColumn('indice', 'integer', 4, array(
             'type' => 'integer',
             'length' => 4,
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
        $this->hasOne('Avaliacao', array(
             'local' => 'idAvaliacao',
             'foreign' => 'idAvaliacao'));

        $this->hasOne('Questao', array(
             'local' => 'idQuestao',
             'foreign' => 'idQuestao'));
    }
}