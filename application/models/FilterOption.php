<?php

class Application_Model_FilterOption
{

    protected $_id;
    protected $_text;
    protected $_value;
    protected $_filterId;
    
    public function __set($name, $value)
    {
        $this->{'_' . $name} = $value;
    }
    
    public function __get($name)
    {
        return $this->{'_' . $name};
    }

}

