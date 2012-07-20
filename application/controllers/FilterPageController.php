<?php

class FilterPageController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
        $this->view->headTitle()->prepend('Filter page');  
        $this->view->sidebar()->prepend(
            $this->view->filterWidget(), 'World filter'
        );
        $this->view->headScript()->appendFile(
            $this->view->baseUrl('scripts/filter.js')
        );
    }

    public function indexAction()
    {
        // action body
    }


}

