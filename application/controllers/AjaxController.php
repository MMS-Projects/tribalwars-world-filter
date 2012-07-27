<?php

class AjaxController extends Zend_Controller_Action
{
	public $worlds;
	
    public function init()
    {
    	$this->worlds = self::getAvailableWorlds();
    	$this->view->layout()->setLayout('ajax');
    }
    
    public function filterWorldsAction()
    {
		$this->view->worlds = $this->worlds;
    }
    
    public static function getAvailableWorlds ()
    {
    	$worlds = array();
    	for ($i = 0; $i < 20; $i++) {
    		$world = new Application_Model_World();
    		$world->randomize();
    		$worlds[] = $world;
    	}
    	return $worlds;
    }
}

