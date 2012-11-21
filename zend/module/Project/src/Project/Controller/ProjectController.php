<?php

namespace Project\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Project\Model\Project;
use Project\Form\ProjectForm;
use Zend\Session\Container;
use User\Model\UserTable;

class ProjectController extends AbstractActionController
{
    protected $projectTable;
	protected $roleTable;
	protected $assocUserProjectTable;
	protected $userTable;

    public function indexAction()
    {
        return new ViewModel(array(
            'projects' => $this->getProjectTable()->fetchAll(),
        ));
    }
	
	public function showAction()
	{
		$id = (int)$this->params('id');
		
		$assocs = $this->getAssocUserProjectTable()->getMembersFromProjectAssoc($id);
		
		// fetch project members with their roles
		$members = array();
		foreach($assocs as $assoc)
		{
			$fkrole = $assoc->fkrole;
			$fkuser = $assoc->fkuser;
			$role = $this->getRoleTable()->getRole($fkrole);
			$member = $this->getUserTable()->getUser($fkuser);
			$member->role = $role;
			array_push($members, $member);
		}
		
		$project = $this->getProjectTable()->getProject($id);
		$owner = $this->getUserTable()->getUser($project->fkowner);
		
		try
		{
			return new ViewModel(array(
				'project' => $project,
				'members' => $members,
				'owner' => $owner,
			));
		} 
		catch(\Exception $pokemon)
		{
			// redirect to home page
			return $this->redirect()->toRoute('Project', array( 'action' => 'home' ));
		}
	}
	
	public function homeAction()
    {
        return new ViewModel(array(
            'projects' => $this->getProjectTable()->fetchAll(),
        ));
    }

    public function addAction()
    {
		$session = new Container('ideabox');
		if(!$session->offsetExists('email'))
		{
			// redirect to home page
			return $this->redirect()->toRoute('Project', array( 'action' => 'home' ));
		}	
	
        $form = new ProjectForm();
        $form->get('submit')->setAttribute('value', 'Add');

        $request = $this->getRequest();
        if ($request->isPost()) {
            $Project = new Project();
	    $Project->name = $request->getPost()->get('name', 'pas de nom');
	    $Project->short_description = $request->getPost()->get('short_description', 'pas de desc');
	    $Project->long_description = $request->getPost()->get('long_description', 'pas de desc');
	    $Project->image = $request->getPost()->get('image', '');
	    $Project->ispublic = $request->getPost()->get('ispublic', 1) == 1 ? 0 : 1;
	    $Project->fkowner = $session->offsetGet('id');
            //$Project->exchangeArray($form->getData());
            $this->getProjectTable()->saveProject($Project);
            // Redirect to list of Project
            return $this->redirect()->toRoute('Project');
            }

        return array('form' => $form);
    }

    public function editAction()
    {
        $id = (int)$this->params('id');
        if (!$id) {
            return $this->redirect()->toRoute('Project', array('action'=>'add'));
        }
        $Project = $this->getProjectTable()->getProject($id);

        $form = new ProjectForm();
        $form->bind($Project);
        $form->get('submit')->setAttribute('value', 'Edit');

        $request = $this->getRequest();
        if ($request->isPost()) {
            $form->setData($request->getPost());
            if ($form->isValid()) {
                $this->getProjectTable()->saveProject($Project);

                // Redirect to list of Projects
                return $this->redirect()->toRoute('Project');
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
            return $this->redirect()->toRoute('Project');
        }

        $request = $this->getRequest();
        if ($request->isPost()) {
            $del = $request->getPost()->get('del', 'No');
            if ($del == 'Yes') {
                $id = (int)$request->getPost()->get('id');
                $this->getProjectTable()->deleteProject($id);
            }

            // Redirect to list of Projects
            return $this->redirect()->toRoute('Project');
        }

        return array(
            'pkproject' => $pkproject,
            'project' => $this->getProjectTable()->getProject($id)
        );
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
	
	public function getAssocUserProjectTable()
    {
        if (!$this->assocUserProjectTable) {
            $sm = $this->getServiceLocator();
            $this->assocUserProjectTable = $sm->get('Project\Model\AssocUserProjectTable');
        }
        return $this->assocUserProjectTable;
    }
	
	public function getUserTable()
    {
        if (!$this->userTable) {
            $sm = $this->getServiceLocator();
            $this->userTable = $sm->get('User\Model\UserTable');
        }
        return $this->userTable;
    }
}
