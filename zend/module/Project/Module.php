<?php

namespace Project;

use Project\Model\Project;
use Project\Model\ProjectTable;
use Project\Model\Role;
use Project\Model\RoleTable;
use Project\Model\AssocUserProject;
use Project\Model\AssocUserProjectTable;
use Project\Model\Request;
use Project\Model\RequestTable;
use Project\Model\RequestView;
use Project\Model\RequestViewTable;
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
                'Project\Model\ProjectTable' =>  function($sm) {
                    $tableGateway = $sm->get('ProjectTableGateway');
                    $table = new ProjectTable($tableGateway);
                    return $table;
                },
                'ProjectTableGateway' => function ($sm) {
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new Project());
                    return new TableGateway('project', $dbAdapter, null, $resultSetPrototype);
                },
				'Project\Model\RoleTable' =>  function($sm) {
                    $tableGateway = $sm->get('RoleTableGateway');
                    $table = new RoleTable($tableGateway);
                    return $table;
                },
                'RoleTableGateway' => function ($sm) {
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new Role());
                    return new TableGateway('role', $dbAdapter, null, $resultSetPrototype);
                },
				'Project\Model\AssocUserProjectTable' =>  function($sm) {
                    $tableGateway = $sm->get('AssocUserProjectTableGateway');
                    $table = new AssocUserProjectTable($tableGateway);
                    return $table;
                },
                'AssocUserProjectTableGateway' => function ($sm) {
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new AssocUserProject());
                    return new TableGateway('assoc_user_project', $dbAdapter, null, $resultSetPrototype);
                },
				'Project\Model\RequestTable' =>  function($sm) {
                    $tableGateway = $sm->get('RequestTableGateway');
                    $table = new RequestTable($tableGateway);
                    return $table;
                },
                'RequestTableGateway' => function ($sm) {
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new Request());
                    return new TableGateway('request', $dbAdapter, null, $resultSetPrototype);
                },
				'Project\Model\RequestViewTable' =>  function($sm) {
                    $tableGateway = $sm->get('RequestViewTableGateway');
                    $table = new RequestViewTable($tableGateway);
                    return $table;
                },
                'RequestViewTableGateway' => function ($sm) {
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new RequestView());
                    return new TableGateway('request_view', $dbAdapter, null, $resultSetPrototype);
                },
            ),
        );
    }

    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }
}
