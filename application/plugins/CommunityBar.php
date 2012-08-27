<?php

class Application_Plugin_CommunityBar extends Zend_Controller_Plugin_Abstract
{

    function preDispatch(Zend_Controller_Request_Abstract $request)
    {
        $view = Zend_Controller_Front::getInstance()->getParam('bootstrap')
            ->getResource('view');
            
        $mapper = new Application_Model_CommunityMapper;
        $view->communities = $mapper->fetchAll();
    }
    
}
