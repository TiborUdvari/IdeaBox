<?php

namespace User\Model;

use Zend\Db\TableGateway\TableGateway;
use Zend\Db\Adapter\Adapter;
use Zend\Db\Sql;
use Zend\Db\ResultSet\ResultSet;

class SkillTable
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

    public function getSkill($pkskill)
    {
        $pkskill  = (int) $pkskill;
        $rowset = $this->tableGateway->select(array('pkskill' => $pkskill));
        $row = $rowset->current();
        if (!$row) {
            throw new \Exception("Could not find row $pkskill");
        }
        return $row;
    }
}
