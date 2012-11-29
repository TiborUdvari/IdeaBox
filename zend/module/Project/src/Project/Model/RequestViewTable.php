<?php

namespace Project\Model;

use Zend\Db\TableGateway\TableGateway;

class RequestViewTable
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

    public function fillUserRequests($userID, &$receivedRequests, &$sentRequests)
    {
        $resultSet = $this->tableGateway->select(array('fkuser_source' => $userID));
        $sentRequests = $resultSet;
		$resultSet = $this->tableGateway->select(array('fkuser_destination' => $userID));
        $receivedRequests = $resultSet;
    }
    
    public function updateState($requestID, $newState)
    {
		$this->tableGateway->update(array('state' => $newState), array('id' => $requestID));
    }
}
