<?php

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap
{
    
    public function _initBaseUrl()
    {
        $this->bootstrap('FrontController');
        
        $urlParts = explode('/', dirname($_SERVER['SCRIPT_NAME']));
        if (end($urlParts) == 'public') {
            array_pop($urlParts);
        }
        $baseUrl = implode('/', $urlParts) . '/';
        
        $front = $this->getResource('frontController');
        $front->setBaseUrl($baseUrl);
    }
    
    public function _initNavigation()
    {
        $home = new Zend_Navigation_Page_Mvc(array(
            'action'     => 'index',
            'controller' => 'index',
            'label'      => 'Home'
        ));
        $filterPage = new Zend_Navigation_Page_Mvc(array(
            'action'     => 'index',
            'controller' => 'filter-page',
            'label'      => 'World filter'
        ));
        $communtiesPage = new Zend_Navigation_Page_Mvc(array(
            'action'     => 'index',
            'controller' => 'communities',
            'label'      => 'Communities'
        ));
        $container = new Zend_Navigation(array(
            $home, $communtiesPage, $filterPage
        ));
        Zend_Registry::set('Zend_Navigation', $container);
    }
    
    public function _initPlugins()
    {
        $front = $this->getResource('frontController');
        $front->registerPlugin(new Application_Plugin_NavigationTitle())
            ->registerPlugin(new Application_Plugin_MobileDeviceLayout())
            ->registerPlugin(new Application_Plugin_AjaxRequest())
            ->registerPlugin(new Application_Plugin_SubdomainCountry())
            ->registerPlugin(new Application_Plugin_CommunityBar());
    }
    
    public function _initRoutes()
    {
        $router = Zend_Controller_Front::getInstance()->getRouter();
        $router->addRoute(
            'robots',
            new Zend_Controller_Router_Route('/robots.txt',
                array('controller' => 'Robots', 'action' => 'robots')
            )
        );
    }

}

