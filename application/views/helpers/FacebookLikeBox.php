<?php

class Zend_View_Helper_FacebookLikeBox extends Zend_View_Helper_Abstract
{

    protected $_href      = null;
    protected $_width     = 292;
    protected $_showFaces = false;
    protected $_stream    = false;
    protected $_header    = false;

    public function facebookLikeBox(array $options = array())
    {
        if (!empty($options)) {
            $this->setOptions($options);
        }
        return $this;        
    }
    
    public function __toString()
    {
        return $this->_buildHtml();
    }
    
    public function setOptions(array $options)
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
    
    public function setHref($href)
    {
        $this->_href = $href;
        return $this;
    }
    
    public function setWidth($width)
    {
        $this->_width = $width;
    }
    
    public function setShowFaces($value)
    {
        $this->_showFaces = $value;
    }
    
    public function setStream($value)
    {
        $this->_stream = $value;
    }
    
    public function setHeader($value)
    {
        $this->_header = $value;
    }
    
    protected function _buildHtml()
    {
        $options = array();
        if (!$this->_href) {
            $options['href'] = $this->view->serverUrl() . $this->view->url();
            $options['href'] = 'http://google.nl/';
        } else {
            $options['href'] = $this->_href;
        }
        $options['width']      = $this->_width;
        $options['show-faces'] = json_encode($this->_showFaces);
        $options['stream']     = json_encode($this->_stream);
        $options['header']     = json_encode($this->_header);
        $parameters = array();
        foreach ($options as $option => $value) {
            $parameters[] = 'data-' . $option . '="' . $value . '"';
        }
        $html = '<div class="fb-like-box" ' . implode(' ', $parameters) . '></div>';
        return $html;
    }
}
