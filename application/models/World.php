<?php

class Application_Model_World
{

    protected $_id;
    protected $_tag;
    protected $_gameKnight;
    protected $_snobGold;
    protected $_gameChurch;
    protected $_speed;
    protected $_coordBonusVillages;
    
    public function __set($name, $value)
    {
        $method = 'set' . ucfirst($name);
        if (('mapper' == $name) || !method_exists($this, $method)) {
            throw new Exception('Invalid world property "' . $name . '".');
        }
        $this->$method($value);
    }
    
    public function __get($name)
    {
        $method = 'get' . ucfirst($name);
        if (('mapper' == $name) || !method_exists($this, $method)) {
            throw new Exception('Invalid world property "' . $name . '".');
        }
        return $this->$method();
    }
    
    public function __isset($name)
    {
        $method = 'get' . ucfirst($name);
        if (('mapper' == $name) || !method_exists($this, $method)) {
            return false;
        }
        return true;
    }
    
    public function setProperties(array $options)
    {
        $methods = get_class_methods($this);
        foreach ($options as $key => $value) {
            $key = Zend_Filter::filterStatic(
		        $key, 'Word_UnderscoreToCamelCase'
	        );
            $method = 'set' . $key;
            if (in_array($method, $methods)) {
                $this->$method($value);
            } else {
                throw new Exception('Invalid world property "' . $key . '".');
            }
        }
        return $this;
    }
    
    public function setId($id)
    {
        if (!is_numeric($id)) { 
            throw new Exception('Filter property "id" needs to be a number.');
        }
        $this->_id = (int) $id;
        return $this;
    }
    
    public function setTag($tag)
    {
        if (!is_string($tag)) { 
            return false;
        }
        $this->_tag = (string) $tag;
        return $this; 
    }
    
    public function setGameKnight($value)
    {
        if (!is_numeric($value)) { 
            return false;
        }
        $this->_gameKnight = $value;
        return $this; 
    }
    
    public function setSnobGold($value)
    {
        if (!is_numeric($value)) { 
            return false;
        }
        $this->_snobGold = $value;
        return $this; 
    }
    
    public function setGameChurch($value)
    {
        if (!is_numeric($value)) { 
            return false;
        }
        $this->_gameChurch = $value;
        return $this; 
    }
    public function setSpeed($value)
    {
        if (!is_numeric($value)) { 
            return false;
        }
        $this->_speed = $value;
        return $this; 
    }
    
    public function setCoordBonusVillages($value)
    {
        if (!is_numeric($value)) { 
            return false;
        }
        $this->_coordBonusVillages = $value;
        return $this; 
    }

    public function getId()
    {
        return $this->_id;
    }
    
    public function getTag()
    {
        return $this->_tag;
    }
    
    public function getGameKnight()
    {
        return $this->_gameKnight;
    }
    
    public function getSnobGold()
    {
        return $this->_snobGold;
    }
    
    public function getGameChurch()
    {
        return $this->_gameChurch;
    }
    
    public function getSpeed()
    {
        return $this->_speed;
    }
    
    public function getCoordBonusVillages()
    {
        return $this->_coordBonusVillages;
    }
}

