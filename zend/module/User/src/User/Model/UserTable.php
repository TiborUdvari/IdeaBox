<?php

namespace User\Model;

use Zend\Db\TableGateway\TableGateway;

class UserTable
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

    public function getUser($pkuser)
    {
        $pkuser  = (int) $pkuser;
        $rowset = $this->tableGateway->select(array('pkuser' => $pkuser));
        $row = $rowset->current();
        if (!$row) {
            throw new \Exception("Could not find row $pkuser");
        }
        return $row;
    }

    public function saveUser(User $User)
    {
        $data = array(
            'firstname' => $User->firstname,
            'lastname'  => $User->lastname,
			'email'  => $User->email,
			'description'  => $User->description,
			'password'  => $User->password,
        );

        $pkuser = (int)$User->pkuser;
        if ($pkuser == 0) {
            $this->tableGateway->insert($data);
        } else {
            if ($this->getUser($pkuser)) {
                $this->tableGateway->update($data, array('pkuser' => $pkuser));
            } else {
                throw new \Exception('Form pkuser does not exist');
            }
        }
    }

    public function deleteUser($pkuser)
    {
        $this->tableGateway->delete(array('pkuser' => $pkuser));
    }

}