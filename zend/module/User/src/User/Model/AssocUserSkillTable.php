<?php

namespace User\Model;

use Zend\Db\TableGateway\TableGateway;

class AssocUserSkillTable
{
    protected $tableGateway;

    public function __construct(TableGateway $tableGateway)
    {
        $this->tableGateway = $tableGateway;
    }

    public function fetchAll()
    {
        $resultSet = $this->tableGateway->select();
        return $resultSet;
    }

    public function getAssocSkills($fkuser)
    {
        $fkuser  = (int) $fkuser;
        $rowset = $this->tableGateway->select(array('fkuser' => $fkuser));
        return $rowset;
    }
}