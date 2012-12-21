<?php
namespace User\Form;

use Zend\Form\Form;

class RegisterForm extends Form
{
    public function __construct($name = null)
    {
        // we want to ignore the name passed
        parent::__construct('User');
        $this->setAttribute('method', 'post');

        $this->add(array(
            'name' => 'firstname',
            'attributes' => array(
                'type'  => 'text',
                'placeholder' => 'John',
            ),
            'options' => array(
                'label' => 'First Name',
            ),
        ));
		
        $this->add(array(
            'name' => 'lastname',
            'attributes' => array(
                'type'  => 'text',
                'placeholder' => 'Smith',
            ),
            'options' => array(
                'label' => 'Last Name',
            ),
        ));

        $this->add(array(
            'name' => 'email',
            'attributes' => array(
                'type'  => 'email',
                'placeholder' => 'you@yourdomain.ch',
            ),
            'options' => array(
                'label' => 'E-mail address',
            ),
        ));
		
		$this->add(array(
            'name' => 'description',
            'attributes' => array(
                'type'  => 'textarea',
            ),
            'options' => array(
                'label' => 'Description',
            ),
        ));

        $this->add(array(
            'name' => 'password',
            'attributes' => array(
                'type'  => 'password',
                'placeholder' => 'Do not worry, we will not tell',
            ),
            'options' => array(
                'label' => 'Password',
            ),
        ));

	$this->add(array(
            'name' => 'submit',
            'attributes' => array(
                'value'  => 'Register',
                'class' => 'btn btn-success',
		'type' 	=> 'submit',
            ),
        ));
       
    }
}
