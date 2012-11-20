<?php

namespace User\Model;

use Zend\InputFilter\InputFilter;
use Zend\InputFilter\Factory as InputFactory;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;

class AssocUserSkill //implements InputFilterAwareInterface
{
    public $fkuser;
	public $fkskill;
	public $level;
	public $description;

    protected $inputFilter;

    /**
     * Used by ResultSet to pass each database row to the entity
     */
    public function exchangeArray($data)
    {
	    $this->fkuser = (isset($data['fkuser'])) ? $data['fkuser'] : null;
        $this->fkskill     = (isset($data['fkskill'])) ? $data['fkskill'] : null;
		$this->level     = (isset($data['level'])) ? $data['level'] : null;
        $this->description     = (isset($data['description'])) ? $data['description'] : null;
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
