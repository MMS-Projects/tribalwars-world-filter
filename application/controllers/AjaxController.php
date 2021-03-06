<?php

class AjaxController extends Zend_Controller_Action
{

    public $worlds = null;

    public $filters = array(
        array(
            'title' => 'Paladin',
            'id' => 'paladin',
            'options' => array(
                array(
                    'text' => 'Yes',
                    'value' => true
                    ),
                array(
                    'text' => 'No',
                    'value' => false
                    )
                )
            ),
        array(
            'title' => 'Nobel item',
            'id' => 'nobel-item',
            'options' => array(
                array(
                    'text' => 'Packages',
                    'value' => 1
                    ),
                array(
                    'text' => 'Coins',
                    'value' => 2
                    )
                )
            ),
        array(
            'title' => 'Church',
            'id' => 'church',
            'options' => array(
                array(
                    'text' => 'Yes',
                    'value' => true
                    ),
                array(
                    'text' => 'No',
                    'value' => false
                    )
                )
            ),
        array(
            'title' => 'World speed',
            'id' => 'speed',
            'options' => array(
                array(
                    'text' => '1',
                    'value' => 1
                    ),
                array(
                    'text' => '1.5',
                    'value' => 1.5
                    ),
                array(
                    'text' => '2',
                    'value' => 2
                    )
                )
            )
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
        foreach ($parameters as $key => $value) {
            unset($parameters[$key]);
		    $key = lcfirst(Zend_Filter::filterStatic(
		        substr($key, 7), 'Word_UnderscoreToCamelCase'
	        ));
	        $parameters[$key] = $value;
		}
		$this->view->worlds = array();
		
	    foreach ($this->worlds as $world) {
	        foreach ($parameters as $option => $value) {
	            if ((isset($world->$option)) && ($world->$option != $value)) {
	                continue 2;
	            }
	        }
	        $this->view->worlds[] = $world;
	    }
	    $this->view->bla = print_r($parameters, true);
    }

    public function getFiltersAction()
    {
        $mapper = new Application_Model_FilterMapper;
        $this->view->filters = $mapper->fetchAll();
    }

    public function getTranslationsAction()
    {
        $strings = $this->_getParam('strings');
        if (!is_array($strings)) {
            return false;
        }
        foreach ($strings as $i => &$data) {
            $data = $this->view->translate($data);
        }
        $this->view->strings = $strings;
    }

    public static function getAvailableWorlds()
    {
        $mapper = new Application_Model_WorldMapper;
        return $mapper->fetchAll();
    	/*$worlds = array();
    	for ($i = 0; $i < 20; $i++) {
    		$world = new Application_Model_World();
    		$world->randomize();
    		$worlds[] = $world;
    	}
    	return $worlds;*/
    }
    
}



