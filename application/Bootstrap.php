<?php

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap
{


    public function _initTranslations()
    {
        $adapter = new Zend_Translate(
            array(
                'adapter' => 'csv',
                'content' => '../languages',
                'scan'    => Zend_Translate::LOCALE_FILENAME,
                'locale'  => 'nl'
            )
        );
        Zend_Registry::set('Zend_Translate', $adapter);
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
        $container = new Zend_Navigation(array(
            $home, $filterPage
        ));
        Zend_Registry::set('Zend_Navigation', $container);
    }
    
    public function _initPlugins()
    {
        $this->bootstrap('FrontController');
        
        $front = $this->getResource('frontController');
        $front->registerPlugin(new Application_Plugin_NavigationTitle());
    }

}

