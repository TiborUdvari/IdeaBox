<?php

namespace User;

use User\Model\User;
use User\Model\UserTable;
use User\Model\Skill;
use User\Model\SkillTable;
use User\Model\AssocUserSkill;
use User\Model\AssocUserSkillTable;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\TableGateway\TableGateway;

class Module
{
    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\ClassMapAutoloader' => array(
                __DIR__ . '/autoload_classmap.php',
            ),
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }

    public function getServiceConfig()
    {
        return array(
            'factories' => array(
                'User\Model\UserTable' =>  function($sm) {
                    $tableGateway = $sm->get('UserTableGateway');
                    $table = new UserTable($tableGateway);
                    return $table;
                },
                'UserTableGateway' => function ($sm) {
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new User());
                    return new TableGateway('user', $dbAdapter, null, $resultSetPrototype);
                },
                'User\Model\SkillTable' =>  function($sm) {
                    $tableGateway = $sm->get('SkillTableGateway');
                    $table = new SkillTable($tableGateway);
                    return $table;
                },
				'SkillTableGateway' => function ($sm) {
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new Skill());
                    return new TableGateway('skill', $dbAdapter, null, $resultSetPrototype);
                },
                'User\Model\AssocUserSkillTable' =>  function($sm) {
                    $tableGateway = $sm->get('AssocUserSkillTableGateway');
                    $table = new AssocUserSkillTable($tableGateway);
                    return $table;
                },
				'AssocUserSkillTableGateway' => function ($sm) {
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new AssocUserSkill());
                    return new TableGateway('assoc_user_skill', $dbAdapter, null, $resultSetPrototype);
                },
            ),
        );
    }

    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }
}
