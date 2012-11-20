<?php

namespace User\Model;

use Zend\InputFilter\InputFilter;
use Zend\InputFilter\Factory as InputFactory;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;

class Skill //implements InputFilterAwareInterface
{
    public $pkskill;
	public $name;
	public $level;
	public $description;

    protected $inputFilter;

    /**
     * Used by ResultSet to pass each database row to the entity
     */
    public function exchangeArray($data)
    {
	    $this->pkskill = (isset($data['pkskill'])) ? $data['pkskill'] : null;
        $this->name     = (isset($data['name'])) ? $data['name'] : null;
		$this->level     = null;
		$this->description = null;
    }

    public function getArrayCopy()
    {
        return get_object_vars($this);
    }

    // public function setInputFilter(InputFilterInterface $inputFilter)
    // {
        // throw new \Exception("Not used");
    // }

    // public function getInputFilter()
    // {
        // if (!$this->inputFilter) {
            // $inputFilter = new InputFilter();

            // $factory = new InputFactory();

            // $this->inputFilter = $inputFilter;        
        // }

        // return $this->inputFilter;
    // }
}
