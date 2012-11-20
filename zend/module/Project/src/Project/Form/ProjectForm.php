<?php
namespace Project\Form;

use Zend\Form\Form;

class ProjectForm extends Form
{
    public function __construct($name = null)
    {
        // we want to ignore the name passed
        parent::__construct('Project');

        $this->setAttribute('method', 'post');

        $this->add(array(
            'name' => 'name',
            'attributes' => array(
                'type'  => 'text',
            ),
            'options' => array(
                'label' => 'Name',
            ),
        ));

        $this->add(array(
            'name' => 'short_description',
            'attributes' => array(
                'type'  => 'text',
            ),
            'options' => array(
                'label' => 'Short description',
            ),
        ));
		
		$this->add(array(
            'name' => 'long_description',
            'attributes' => array(
                'type'  => 'text',
            ),
            'options' => array(
                'label' => 'Long description',
            ),
        ));

		$this->add(array(
            'name' => 'image',
            'attributes' => array(
                'type'  => 'text',
            ),
            'options' => array(
                'label' => 'Image URL',
            ),
        ));
		
		$this->add(array(
            'name' => 'ispublic',
            'attributes' => array(
                'type'  => 'checkbox',
            ),
            'options' => array(
                'label' => 'Public',
            ),
        ));
		
        $this->add(array(
            'name' => 'submit',
            'attributes' => array(
                'type'  => 'submit',
                'value' => 'Go',
                'id' => 'submitbutton',
            ),
        ));

    }
}
