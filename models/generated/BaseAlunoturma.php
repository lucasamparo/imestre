<?php

/**
 * BaseAlunoturma
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $idAlunoTurma
 * @property integer $idAluno
 * @property integer $idTurma
 * @property string $ano
 * @property Aluno $Aluno
 * @property Turma $Turma
 * 
 * @package    ##PACKAGE##
 * @subpackage ##SUBPACKAGE##
 * @author     ##NAME## <##EMAIL##>
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseAlunoturma extends Doctrine_Record
{
    public function setTableDefinition()
    {
        $this->setTableName('alunoturma');
        $this->hasColumn('idAlunoTurma', 'integer', 4, array(
             'type' => 'integer',
             'length' => 4,
             'fixed' => false,
             'unsigned' => false,
             'primary' => true,
             'autoincrement' => true,
             ));
        $this->hasColumn('idAluno', 'integer', 4, array(
             'type' => 'integer',
             'length' => 4,
             'fixed' => false,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             ));
        $this->hasColumn('idTurma', 'integer', 4, array(
             'type' => 'integer',
             'length' => 4,
             'fixed' => false,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             ));
        $this->hasColumn('ano', 'string', 5, array(
             'type' => 'string',
             'length' => 5,
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

        $this->hasOne('Turma', array(
             'local' => 'idTurma',
             'foreign' => 'idTurma'));
    }
}