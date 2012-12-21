<?php
namespace User\Form;

use Zend\Form\Form;

class LoginForm extends Form
{
    public function __construct($name = null)
    {
        // we want to ignore the name passed
        parent::__construct('User');
        $this->setAttribute('method', 'post');

        $this->add(array(
            'name' => 'email',
            'attributes' => array(
                'type'  => 'text',
                'placeholder' => 'yourname@yourdomain.ch',
            ),
            
        ));

        $this->add(array(
            'name' => 'password',
            'attributes' => array(
                'type'  => 'Password',
                'placeholder' => 'shhh'
            ),
        ));

	$this->add(array(
            'name' => 'submit',
            'attributes' => array(
                'value'  => 'Login',
                'class' => 'btn btn-success',
		'type' 	=> 'submit',
            ),
        ));


       
    }
}
