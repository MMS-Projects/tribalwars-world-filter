<?php

class FilterPageController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        // action body
        if ($this->_hasParam('fb')) {
            $this->view->layout()->setLayout('twf-fb');
        }
    }


}

