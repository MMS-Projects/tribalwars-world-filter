<?php

class Application_Model_Community
{

    protected $_id;
    protected $_tag;
    protected $_url;
    protected $_spritePlace;
    
    public function __set($name, $value)
    {
        $method = 'set' . ucfirst($name);
        if (('mapper' == $name) || !method_exists($this, $method)) {
            throw new Exception('Invalid community property "' . $name . '".');
        }
        $this->$method($value);
    }
    
    public function __get($name)
    {
        $method = 'get' . ucfirst($name);
        if (('mapper' == $name) || !method_exists($this, $method)) {
            throw new Exception('Invalid community property "' . $name . '".');
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
                throw new Exception('Invalid community property "' . $key . '".');
            }
        }
        return $this;
    }
    
    public function setId($id)
    {
        if (!is_numeric($id)) { 
            throw new Exception('Community property "id" needs to be a number.');
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
    
    public function setUrl($value)
    {
        if (!is_string($value)) { 
            return false;
        }
        $this->_url = $value;
        return $this; 
    }
    
    public function setSpritePlace($value)
    {
        if (!is_numeric($value)) { 
            return false;
        }
        $this->_spritePlace = (int) $value;
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
    
    public function getUrl()
    {
        return $this->_url;
    }
    
    public function getSpritePlace()
    {
        return $this->_spritePlace;
    }
    
}

