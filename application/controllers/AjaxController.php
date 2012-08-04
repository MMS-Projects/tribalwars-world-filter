<?php

class AjaxController extends Zend_Controller_Action
{
	public $worlds;
	public $filters = array(
	    array(
	        'title'  => 'With or without paladin?',
	        'id'     => 'paladin',
	        'options' => array(
	            array(
	                'text'  => 'With paladin',
	                'value' => 1
	            ),
	            array(
	                'text'  => 'Without paladin',
	                'value' => 2
	            )
	        )
	    ),
	    array(
	        'title'  => 'Nobel item',
	        'id'     => 'nobel-item',
	        'options' => array(
	            array(
	                'text'  => 'Packages',
	                'value' => 1
	            ),
	            array(
	                'text'  => 'Coins',
	                'value' => 2
	            )
	        )
	    ),
	    array(
	        'title'  => 'With or without church?',
	        'id'     => 'church',
	        'options' => array(
	            array(
	                'text'  => 'With church',
	                'value' => 1
	            ),
	            array(
	                'text'  => 'Without church',
	                'value' => 2
	            )
	        )
	    ),
	    array(
	        'title'  => 'World speed?',
	        'id'     => 'speed',
	        'options' => array(
	            array(
	                'text'  => '1',
	                'value' => 1
	            ),
	            array(
	                'text'  => '1.5',
	                'value' => 1.5
	            ),
	            array(
	                'text'  => '2',
	                'value' => 2
	            )
	        )
	    ),
    );
	
    public function init()
    {
    	$this->worlds = self::getAvailableWorlds();
    	$this->view->layout()->setLayout('ajax');
    }
    
    public function filterWorldsAction()
    {
        $parameters = $_POST;
        $bla->uhuh = print_r($parameters, true);
		
		$this->view->worlds = array($bla);
		$this->view->worlds += $this->worlds;
    }
    
    public function getFiltersAction()
    {
        $this->view->filters = $this->filters;
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

