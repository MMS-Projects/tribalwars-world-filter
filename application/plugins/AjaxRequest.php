<?php

class Application_Plugin_AjaxRequest extends Zend_Controller_Plugin_Abstract
{

    public function postDispatch(Zend_Controller_Request_Abstract $request)
    {
        if ($request->getParam('ajax')) {
            $layout = Zend_Layout::getMvcInstance();
            $layout->setLayout('ajax');
        }
    }


}
