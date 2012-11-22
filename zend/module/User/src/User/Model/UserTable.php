<?php

namespace User\Model;

use Zend\Db\TableGateway\TableGateway;
use Zend\Session\Container;

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
	
	public function getUserByEmail($email)
    {
        $rowset = $this->tableGateway->select(array('email' => $email));
        $row = $rowset->current();
        if (!$row) {
            throw new \Exception("Could not find row $email");
        }
        return $row;
    }

    public function isValidLogin($email, $password)
    {
        $rowset = $this->tableGateway->select(array('email' => $email));
        $row = $rowset->current();
		if (!$row) {
				return false;
			}
		$toto = $row->password;
			if($toto == $password)
				return true;
		else
			return false;
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
			try
			{
				$this->tableGateway->insert($data);
				$session = new Container('ideabox');
				$session->offsetSet('id', $User->pkuser);
				$session->offsetSet('email', $User->email);
			}
			catch(\Exception $e)
			{
				throw new \Exception("Email déjà utilisé<br />");
			}
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
