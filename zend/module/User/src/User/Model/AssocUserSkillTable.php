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
	
	public function deleteAssocUserSkill($fkuser, $fkskill)
	{
		$this->tableGateway->delete(array('fkuser' => $fkuser, 'fkskill' => $fkskill,));
	}
	
	public function saveAssocUserSkill($assocUserSkill)
	{
		if($assocUserSkill->level == 0)
		{
			$this->deleteAssocUserSkill($assocUserSkill->fkuser, $assocUserSkill->fkskill);
			return;
		}
	
        $data = array(
			'fkuser' => (int)$assocUserSkill->fkuser,
			'fkskill' => (int)$assocUserSkill->fkskill,
			'level' => $assocUserSkill->level,
			'description' => $assocUserSkill->description,
        );

		try
		{
			$this->tableGateway->insert($data);
		}
		catch(\Exception $e)
		{
			$this->tableGateway->update($data, array('fkuser' => (int)$assocUserSkill->fkuser, 'fkskill' => (int)$assocUserSkill->fkskill,));
		}
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