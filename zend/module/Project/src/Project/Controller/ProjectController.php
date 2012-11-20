<?php

namespace Project\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Project\Model\Project;
use Project\Form\ProjectForm;
use Zend\Session\Container;

class ProjectController extends AbstractActionController
{
    protected $projectTable;

    public function indexAction()
    {
        return new ViewModel(array(
            'projects' => $this->getProjectTable()->fetchAll(),
        ));
    }
	
	public function showAction()
	{
		$id = (int)$this->params('id');
		try
		{
			return new ViewModel(array(
				'project' => $this->getProjectTable()->getProject($id),
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
            $form->setInputFilter($Project->getInputFilter());
            $form->setData($request->getPost());
            if ($form->isValid()) {
                $Project->exchangeArray($form->getData());
                $this->getProjectTable()->saveProject($Project);

                // Redirect to list of Projects
                return $this->redirect()->toRoute('Project');
            }
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
}
