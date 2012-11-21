<?php

namespace User\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\Session\Container;
use User\Model\User;
use User\Form\LoginForm;
use User\Form\RequestForm;
use Project\Model\Request;

class UserController extends AbstractActionController
{
    protected $userTable;
	protected $skillTable;
	protected $assocUserSkillTable;
	protected $projectTable;
	protected $roleTable;
	protected $requestTable;
	
	public function controlPanelAction()
	{
		$session = new Container('ideabox');
		if(!$session->offsetExists('id'))
		{
			// redirect to home page
			return $this->redirect()->toRoute('Project', array( 'action' => 'home' ));
		}
			
		$userID = $session->offsetGet('id');
		$requests = $this->getRequestTable()->fetchAll();
		
		$receivedRequests = array();
		$sentRequests = array();
		foreach($requests as $request)
		{
			if($request->fkuser_source == $userID)
			{
				array_push($sentRequests, $request);
			}
			
			if($request->fkuser_destination == $userID)
			{
				array_push($receivedRequests, $request);
			}
		}
	
		return array('receivedRequests' => $receivedRequests, 'sentRequests' => $sentRequests);
	}
	
	public function recruitAction()
	{
		$session = new Container('ideabox');
		$destID = (int)$this->params('id');
		if(!$session->offsetExists('id'))
		{
			// redirect to home page
			return $this->redirect()->toRoute('Project', array( 'action' => 'home' ));
		}
	
		$id = $session->offsetGet('id');
		$rolesRaw = $this->getRoleTable()->fetchAll();
		$roles = array();
		foreach($rolesRaw as $role)
		{
			//array_push($roles, $role->pkrole => $role->role);
			$roles[$role->pkrole] = $role->role;
		}
		
		$sourceID = $session->offsetGet('id');
		$projectsRaw = $this->getProjectTable()->fetchAll();
		$projects = array();
		foreach($projectsRaw as $project)
		{
			if($project->fkowner == $sourceID)
			{
				$projects[$project->pkproject] = $project->name;
			}
		}
		
		$form = new RequestForm($roles, $projects);
		$request = $this->getRequest();
		if ($request->isPost()) {
		    $roleID = $request->getPost()->get('role', '');
			$comment = $request->getPost()->get('comment', '');
			
		    $demand = new Request();
			$demand->fkuser_source = $sourceID;
			$demand->fkuser_destination = $destID;
			$demand->fkrole = $roleID;
			$demand->fkproject = $request->getPost()->get('project', '');
			$demand->comment = $comment;
			$demand->state = 0;
			$demand->id = 0;
			$this->getRequestTable()->saveRequest($demand);
			

		    // Redirect to list of Users
		    return $this->redirect()->toRoute('User');
		}
		return array('form' => $form, 'id' => $destID);
	}


    public function indexAction()
    {
        return new ViewModel(array(
            'users' => $this->getUserTable()->fetchAll(),
        ));
    }
	
	public function myProfileAction()
	{
		$session = new Container('ideabox');
		if(!$session->offsetExists('email'))
		{
			// redirect to home page
			return $this->redirect()->toRoute('Project', array( 'action' => 'home' ));
		}
	
		$email = $session->offsetGet('email');
		return new ViewModel(array(
            'user' => $this->getUserTable()->getUserByEmail($email),
        ));
	}
	
	public function showAction()
	{
		$id = (int)$this->params('id');
		$user = $this->getUserTable()->getUser($id);
		$assocUserSkills = $this->getAssocUserSkillTable()->getAssocSkills($user->pkuser);
		
		$userSkills = array();
		
		foreach($assocUserSkills as $assocUserSkill)
		{
			$skill = $this->getSkillTable()->getSkill($assocUserSkill->fkskill);
			$skill->level = $assocUserSkill->level;
			$skill->description = $assocUserSkill->description;
			array_push($userSkills, $skill);
		}
		
		try
		{
			return new ViewModel(array(
				'user' => $this->getUserTable()->getUser($id),
				'skills' => $userSkills,
			));
		} 
		catch(\Exception $pokemon)
		{
			// redirect to home page
			return $this->redirect()->toRoute('Project', array( 'action' => 'home' ));
		}
	}

    public function logoutAction()
    {
		$session = new Container('ideabox');
		$session->getManager()->destroy();
		//on adore la syntaxe ...
		return $this->redirect()->toRoute('Project', array( 'action' => 'home' ));
    }

    public function loginAction()
    {
        $form = new LoginForm();
        $request = $this->getRequest();
	
        if ($request->isPost()) 
		{
			$email = $request->getPost()->get('email', 'toto');
			$password = $request->getPost()->get('password', 'toto');
				$ok = $this->getUserTable()->isValidLogin($email, $password);
			if($ok)
			{
				$session = new Container('ideabox');
				$session->offsetSet('email', $email);
				
				$user = $this->getUserTable()->getUserByEmail($email);
				$id = $user->pkuser;
				$session->offsetSet('id', $id);
				
				return $this->redirect()->toRoute('User', array('action' => 'myProfile'));
			}
			else
			{
			return $this->redirect()->toRoute('Project');
			}
		}
		return array(
				'form' => $form,
			);
    }

    public function editAction()
    {
        $id = (int)$this->params('id');
        if (!$id) {
            return $this->redirect()->toRoute('User', array('action'=>'add'));
        }
        $User = $this->getUserTable()->getUser($id);

        $form = new UserForm();
        $form->bind($User);
        $form->get('submit')->setAttribute('value', 'Edit');

        $request = $this->getRequest();
        if ($request->isPost()) {
            $form->setData($request->getPost());
            if ($form->isValid()) {
                $this->getUserTable()->saveUser($User);

                // Redirect to list of Users
                return $this->redirect()->toRoute('User');
            }
        }

        return array(
            'id' => $id,
            'form' => $form,
        );
    }

    public function deleteAction()
    {
        $id = (int)$this->params('id');
        if (!$id) {
            return $this->redirect()->toRoute('User');
        }

        $request = $this->getRequest();
        if ($request->isPost()) {
            $del = $request->getPost()->get('del', 'No');
            if ($del == 'Yes') {
                $id = (int)$request->getPost()->get('id');
                $this->getUserTable()->deleteUser($id);
            }

            // Redirect to list of Users
            return $this->redirect()->toRoute('User');
        }

        return array(
            'pkuser' => $pkuser,
            'user' => $this->getUserTable()->getUser($id)
        );
    }

    public function getUserTable()
    {
        if (!$this->userTable) {
            $sm = $this->getServiceLocator();
            $this->userTable = $sm->get('User\Model\UserTable');
        }
        return $this->userTable;
    }
	
	public function getSkillTable()
    {
        if (!$this->skillTable) {
            $sm = $this->getServiceLocator();
            $this->skillTable = $sm->get('User\Model\SkillTable');
        }
        return $this->skillTable;
    }
	public function getAssocUserSkillTable()
    {
        if (!$this->assocUserSkillTable) {
            $sm = $this->getServiceLocator();
            $this->assocUserSkillTable = $sm->get('User\Model\AssocUserSkillTable');
        }
        return $this->assocUserSkillTable;
    }
	
	public function getProjectTable()
    {
        if (!$this->projectTable) {
            $sm = $this->getServiceLocator();
            $this->projectTable = $sm->get('Project\Model\ProjectTable');
        }
        return $this->projectTable;
    }
	
	public function getRoleTable()
    {
        if (!$this->roleTable) {
            $sm = $this->getServiceLocator();
            $this->roleTable = $sm->get('Project\Model\RoleTable');
        }
        return $this->roleTable;
    }
	
	public function getRequestTable()
    {
        if (!$this->requestTable) {
            $sm = $this->getServiceLocator();
            $this->requestTable = $sm->get('Project\Model\RequestTable');
        }
        return $this->requestTable;
    }
}
