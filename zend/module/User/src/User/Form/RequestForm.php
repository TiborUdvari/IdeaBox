<?php
namespace User\Form;

use Zend\Form\Form;

class RequestForm extends Form
{
    public function __construct($roles, $projects, $name = null)
    {
        // we want to ignore the name passed
        parent::__construct('Request');

        $this->setAttribute('method', 'post');
		
		$this->add(array(
            'name' => 'project',
            'type'  => 'Zend\Form\Element\Select',
            'options' => array(
                'label' => 'project',
		'value_options' => $projects,
            ),
        ));

        $this->add(array(
            'name' => 'role',
            'type'  => 'Zend\Form\Element\Select',
            'options' => array(
                'label' => 'role',
		'value_options' => $roles,
            ),
        ));

        $this->add(array(
            'name' => 'comment',
            'attributes' => array(
                'type'  => 'text',
            ),
            'options' => array(
                'label' => 'comment',
            ),
        ));
		
        $this->add(array(
            'name' => 'submit',
            'attributes' => array(
                'type'  => 'submit',
                'value' => 'Envoyer la demande',
                'id' => 'submitbutton',
            ),
        ));

    }
}
