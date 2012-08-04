<?php

class AjaxController extends Zend_Controller_Action
{
	public $worlds;
	public $filters = array(
	    array(
	        'title'  => 'Paladin',
	        'id'     => 'paladin',
	        'options' => array(
	            array(
	                'text'  => 'Yes',
	                'value' => true
	            ),
	            array(
	                'text'  => 'No',
	                'value' => false
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
	        'title'  => 'Church',
	        'id'     => 'church',
	        'options' => array(
	            array(
	                'text'  => 'Yes',
	                'value' => true
	            ),
	            array(
	                'text'  => 'No',
	                'value' => false
	            )
	        )
	    ),
	    array(
	        'title'  => 'World speed',
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
        $parameters = $this->_getAllParams();
        // @TODO Okay this really needs some improvements...
        if(isset($parameters['controller'])) {
            unset($parameters['controller']);
        }
        if(isset($parameters['action'])) {
            unset($parameters['action']);
        }
        if (isset($parameters['module'])) {
            unset($parameters['module']);
        }
        $parameters = array_flip($parameters);
        foreach ($parameters as &$parameter) {
		    $parameter = lcfirst(Zend_Filter::filterStatic(
		        substr($parameter, 7), 'Word_DashToCamelCase'
	        ));
		}
		$parameters = array_flip($parameters);
        $bla->uhuh = print_r($parameters, true);
		
		$this->view->worlds = array($bla);
		
	    foreach ($this->worlds as $world) {
	        foreach ($parameters as $option => $value) {
	            if ((isset($world->$option)) && ($world->$option != $value)) {
	                continue 2;
	            }
	        }
	        $this->view->worlds[] = $world;
	    }
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

