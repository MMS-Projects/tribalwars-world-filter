<?php

// Thank you Daimon - http://stackoverflow.com/a/4124419/1126911

class Application_Plugin_NavigationTitle extends Zend_Controller_Plugin_Abstract
{
    function preDispatch(Zend_Controller_Request_Abstract $request)
    {
        $view = Zend_Controller_Front::getInstance()->getParam('bootstrap')
            ->getResource('view');

        //get active page and its label
        $activePage = $view->navigation()->findOneBy('active', true);
        if (!$activePage) {
            return;
        }
        $label = $view->translate($activePage->get('label'));

        //set page label as html title
        $view->headTitle()->prepend($label);
    }
}
