<?php

namespace Project\Model;

use Zend\InputFilter\InputFilter;
use Zend\InputFilter\Factory as InputFactory;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;

class Request //implements InputFilterAwareInterface
{
    public $id;
    public $fkuser_source;
    public $fkuser_destination;	
    public $fkrole;
    public $fkproject;
    public $comment;
    public $state;
    public $creationdate;
    protected $inputFilter;

    /**
     * Used by ResultSet to pass each database row to the entity
     */
    public function exchangeArray($data)
    {
        $this->id     = (isset($data['id'])) ? $data['id'] : null;
	$this->fkuser_source     = (isset($data['fkuser_source'])) ? $data['fkuser_source'] : null;
        $this->fkuser_destination     = (isset($data['fkuser_destination'])) ? $data['fkuser_destination'] : null;
	$this->fkrole     = (isset($data['fkrole'])) ? $data['fkrole'] : null;
        $this->fkproject     = (isset($data['fkproject'])) ? $data['fkproject'] : null;
	$this->comment     = (isset($data['comment'])) ? $data['comment'] : null;
        $this->state     = (isset($data['state'])) ? $data['state'] : null;
	$this->creationdate     = (isset($data['creationdate'])) ? $data['creationdate'] : null;
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
