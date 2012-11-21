<?php

namespace Project\Model;

use Zend\Db\TableGateway\TableGateway;

class AssocUserProjectTable
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
	
	public function getMembersFromProjectAssoc($fkproject)
	{
		$rowset = $this->tableGateway->select(array('fkproject' => $fkproject));
		return $rowset;
	}

    public function getAssocUserProject($fkuser, $fkproject)
    {
        $rowset = $this->tableGateway->select(array('fkuser' => $fkuser));
		
		$resultSet = array();
		foreach($rows as $row)
		{
			if($row->fkproject == $fkproject)
			{
			array_push($resultSet, $row);
			}
		}
        return $resultSet;
    }
}
