<?php

namespace User\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use User\Model\User;
use User\Form\UserForm;

class UserController extends AbstractActionController
{
    protected $userTable;

    public function indexAction()
    {
        return new ViewModel(array(
            'users' => $this->getUserTable()->fetchAll(),
        ));
    }

    public function addAction()
    {
        $form = new UserForm();
        $form->get('submit')->setAttribute('value', 'Add');

        $request = $this->getRequest();
        if ($request->isPost()) {
            $User = new User();
            $form->setInputFilter($User->getInputFilter());
            $form->setData($request->getPost());
            if ($form->isValid()) {
                $User->exchangeArray($form->getData());
                $this->getUserTable()->saveUser($User);

                // Redirect to list of Users
                return $this->redirect()->toRoute('User');
            }
        }

        return array('form' => $form);
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
}
