<?php

/**
 * BaseInstituicao
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $idInstituicao
 * @property integer $idProfessor
 * @property string $nomeInstituicao
 * @property string $funcionamento
 * @property string $dias
 * @property string $logradouro
 * @property string $numero
 * @property string $bairro
 * @property string $cidade
 * @property string $telContato
 * @property float $media
 * @property Professor $Professor
 * @property Doctrine_Collection $Trabalha
 * @property Doctrine_Collection $Turma
 * 
 * @package    ##PACKAGE##
 * @subpackage ##SUBPACKAGE##
 * @author     ##NAME## <##EMAIL##>
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseInstituicao extends Doctrine_Record
{
    public function setTableDefinition()
    {
        $this->setTableName('instituicao');
        $this->hasColumn('idInstituicao', 'integer', 4, array(
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
        $this->hasColumn('nomeInstituicao', 'string', 255, array(
             'type' => 'string',
             'length' => 255,
             'fixed' => false,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             ));
        $this->hasColumn('funcionamento', 'string', null, array(
             'type' => 'string',
             'fixed' => false,
             'unsigned' => false,
             'primary' => false,
             'notnull' => true,
             'autoincrement' => false,
             ));
        $this->hasColumn('dias', 'string', 7, array(
             'type' => 'string',
             'length' => 7,
             'fixed' => false,
             'unsigned' => false,
             'primary' => false,
             'default' => '0111111',
             'notnull' => true,
             'autoincrement' => false,
             ));
        $this->hasColumn('logradouro', 'string', 100, array(
             'type' => 'string',
             'length' => 100,
             'fixed' => false,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             ));
        $this->hasColumn('numero', 'string', 5, array(
             'type' => 'string',
             'length' => 5,
             'fixed' => false,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             ));
        $this->hasColumn('bairro', 'string', 20, array(
             'type' => 'string',
             'length' => 20,
             'fixed' => false,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             ));
        $this->hasColumn('cidade', 'string', 30, array(
             'type' => 'string',
             'length' => 30,
             'fixed' => false,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             ));
        $this->hasColumn('telContato', 'string', 11, array(
             'type' => 'string',
             'length' => 11,
             'fixed' => false,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             ));
        $this->hasColumn('media', 'float', null, array(
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
        $this->hasOne('Professor', array(
             'local' => 'idProfessor',
             'foreign' => 'idProfessor'));

        $this->hasMany('Trabalha', array(
             'local' => 'idInstituicao',
             'foreign' => 'idInstituicao'));

        $this->hasMany('Turma', array(
             'local' => 'idInstituicao',
             'foreign' => 'idInstituicao'));
    }
}