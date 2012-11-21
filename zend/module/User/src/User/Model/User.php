<?php

namespace User\Model;

use Zend\InputFilter\InputFilter;
use Zend\InputFilter\Factory as InputFactory;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;

class User //implements InputFilterAwareInterface
{
    public $pkuser;
    public $firstname;
    public $lastname;
	public $email;
	public $description;
	public $password;
	public $role;

    protected $inputFilter;

    /**
     * Used by ResultSet to pass each database row to the entity
     */
    public function exchangeArray($data)
    {
        $this->pkuser     = (isset($data['pkuser'])) ? $data['pkuser'] : null;
        $this->firstname = (isset($data['firstname'])) ? $data['firstname'] : null;
        $this->lastname  = (isset($data['lastname'])) ? $data['lastname'] : null;
		$this->email  = (isset($data['email'])) ? $data['email'] : null;
		$this->description  = (isset($data['description'])) ? $data['description'] : null;
		$this->password  = (isset($data['password'])) ? $data['password'] : null;
		$this->role = null;
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
