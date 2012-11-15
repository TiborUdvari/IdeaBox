<?php

namespace Project\Model;

use Zend\InputFilter\InputFilter;
use Zend\InputFilter\Factory as InputFactory;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;

class Project //implements InputFilterAwareInterface
{
    public $pkproject;
    public $short_description;
    public $long_description;
	public $image;
	public $fkowner;
	public $ispublic;

    protected $inputFilter;

    /**
     * Used by ResultSet to pass each database row to the entity
     */
    public function exchangeArray($data)
    {
        $this->pkproject     = (isset($data['pkproject'])) ? $data['pkproject'] : null;
        $this->short_description = (isset($data['short_description'])) ? $data['short_description'] : null;
        $this->long_description  = (isset($data['long_description'])) ? $data['long_description'] : null;
		$this->image  = (isset($data['image'])) ? $data['image'] : null;
		$this->fkowner  = (isset($data['fkowner'])) ? $data['fkowner'] : null;
		$this->ispublic  = (isset($data['ispublic'])) ? $data['ispublic'] : null;
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
