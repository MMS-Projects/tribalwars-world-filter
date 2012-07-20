<?php

class IndexController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
        $this->view->headTitle()->prepend('Home');  
    }

    public function indexAction()
    {
        // action body
    }


}

