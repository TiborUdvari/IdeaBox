<?php

namespace Project\Model;

use Zend\Db\TableGateway\TableGateway;

class ProjectTable
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

    public function getProject($pkproject)
    {
        $pkproject  = (int) $pkproject;
        $rowset = $this->tableGateway->select(array('pkproject' => $pkproject));
        $row = $rowset->current();
        if (!$row) {
            throw new \Exception("Could not find row $pkproject");
        }
		
        return $row;
    }

    public function saveProject(Project $Project)
    {
        $data = array(
			'name' => $Project->name,
            'short_description' => $Project->short_description,
            'long_description'  => $Project->long_description,
			'image'  => $Project->image,
			'fkowner'  => $Project->fkowner,
			'ispublic'  => $Project->ispublic,
        );

        $pkproject = (int)$Project->pkproject;
        if ($pkproject == 0) {
            $this->tableGateway->insert($data);
        } else {
            if ($this->getProject($pkproject)) {
                $this->tableGateway->update($data, array('pkproject' => $pkproject));
            } else {
                throw new \Exception('Form pkproject does not exist');
            }
        }
    }

    public function deleteProject($pkproject)
    {
        $this->tableGateway->delete(array('pkproject' => $pkproject));
    }

    public function isProjectOwner($pkuser, $pkproject)
    {
    	return $this->getProject($pkproject)->fkowner == $pkuser;
    }

}
