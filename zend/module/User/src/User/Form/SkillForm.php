<?php
namespace User\Form;

use Zend\Form\Form;

class SkillForm extends Form
{
    public function __construct($skills, $name = null)
    {
        // we want to ignore the name passed
        parent::__construct('Project');

        $this->setAttribute('method', 'post');
        $this->add(array(
            'name' => 'id',
            'attributes' => array(
                'type'  => 'hidden',
            ),
        ));

        $this->add(array(
            'name' => 'skills',
            'type'  => 'Zend\Form\Element\Select',
            'options' => array(
                'label' => 'Skill',
		'value_options' => $skills,
            ),
        ));

        $this->add(array(
            'name' => 'level',
            'attributes' => array(
                'type'  => 'number',
				'min' => '0',
				'max' => '100',
            ),
            'options' => array(
                'label' => 'Skill level (0-100)',
            ),
        ));
		
        $this->add(array(
            'name' => 'description',
            'attributes' => array(
                'type'  => 'text',
            ),
            'options' => array(
                'label' => 'Description',
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
