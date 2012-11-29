<?php

namespace Project\Model;

use Zend\InputFilter\InputFilter;
use Zend\InputFilter\Factory as InputFactory;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;

class RequestView //implements InputFilterAwareInterface
{
	public $id;
	public $state;
	public $fkuser_source;
	public $fkuser_destination;
    public $source_firstname;
    public $source_lastname;
    public $destination_firstname;	
    public $destination_lastname;
    public $role;
    public $name;
	
    protected $inputFilter;
	
    /**
     * Used by ResultSet to pass each database row to the entity
     */
    public function exchangeArray($data)
    {
		$this->id     = (isset($data['id'])) ? $data['id'] : null;
		$this->state     = (isset($data['state'])) ? $data['state'] : null;
		$this->fkuser_source     = (isset($data['fkuser_source'])) ? $data['fkuser_source'] : null;
		$this->fkuser_destination     = (isset($data['fkuser_destination'])) ? $data['fkuser_destination'] : null;
        $this->source_firstname     = (isset($data['source_firstname'])) ? $data['source_firstname'] : null;
		$this->source_lastname     = (isset($data['source_lastname'])) ? $data['source_lastname'] : null;
        $this->destination_firstname     = (isset($data['destination_firstname'])) ? $data['destination_firstname'] : null;
		$this->destination_lastname     = (isset($data['destination_lastname'])) ? $data['destination_lastname'] : null;
        $this->role     = (isset($data['role'])) ? $data['role'] : null;
		$this->name     = (isset($data['name'])) ? $data['name'] : null;
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
