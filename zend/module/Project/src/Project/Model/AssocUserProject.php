<?php

namespace Project\Model;

use Zend\InputFilter\InputFilter;
use Zend\InputFilter\Factory as InputFactory;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;

class AssocUserProject //implements InputFilterAwareInterface
{
    public $fkuser;
	public $fkproject;
	public $fkrole;

    protected $inputFilter;

    /**
     * Used by ResultSet to pass each database row to the entity
     */
    public function exchangeArray($data)
    {
        $this->fkuser     = (isset($data['fkuser'])) ? $data['fkuser'] : null;
		$this->fkproject     = (isset($data['fkproject'])) ? $data['fkproject'] : null;
		$this->fkrole     = (isset($data['fkrole'])) ? $data['fkrole'] : null;
    }

    public function getArrayCopy()
    {
        return get_object_vars($this);
    }

    // public function setInputFilter(InputFilterInterface $inputFilter)
    // {
        // throw new \Exception("Not used");
    // }

    public function getInputFilter()
    {
        if (!$this->inputFilter) {
            $inputFilter = new InputFilter();

            $factory = new InputFactory();

            $this->inputFilter = $inputFilter;        
        }

        return $this->inputFilter;
    }
}
