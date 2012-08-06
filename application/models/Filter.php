<?php

class Application_Model_Filter
{

    protected $_id;
    protected $_title;
    protected $_tag;
    protected $_options;
    
    public function __set($name, $value)
    {
        $method = 'set' . ucfirst($name);
        if (('mapper' == $name) || !method_exists($this, $method)) {
            throw new Exception('Invalid filter property "' . $name . '".');
        }
        $this->$method($value);
    }
    
    public function __get($name)
    {
        $method = 'get' . ucfirst($name);
        if (('mapper' == $name) || !method_exists($this, $method)) {
            throw new Exception('Invalid filter property "' . $name . '".');
        }
        return $this->$method();
    }
    
    public function setProperties(array $options)
    {
        $methods = get_class_methods($this);
        foreach ($options as $key => $value) {
            $key = Zend_Filter::filterStatic(
		        $key, 'Word_DashToCamelCase'
	        );
            $method = 'set' . $key;
            if (in_array($method, $methods)) {
                $this->$method($value);
            } else {
                throw new Exception('Invalid filter property "' . $key . '".');
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
    
    public function setTitle($title)
    {
        if (!is_string($title)) { 
            return false;
        }
        $this->_title = (string) $title;
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
    
    public function setOptions(array $options)
    {
        if (!is_array($options)) { 
            return false;
        }
        $this->_options = $options;
        return $this; 
    }

    public function getId()
    {
        return $this->_id;
    }
    
    public function getTitle()
    {
        return $this->_title;
    }
    
    public function getTag()
    {
        return $this->_tag;
    }
    
    public function getOptions()
    {
        return $this->_options;
    }
    
}

