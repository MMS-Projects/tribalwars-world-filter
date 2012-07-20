<?php
require_once 'Zend/View/Helper/Placeholder/Container/Standalone.php';

class Zend_View_Helper_Sidebar extends Zend_View_Helper_Placeholder_Container_Standalone
{

    /**
     * Registry key for placeholder
     * @var string
     */
    protected $_regKey = 'Zend_View_Helper_Sidebar';

    /**
     * Default sidebar rendering order
     *
     * @var string
     */
    protected $_defaultAttachOrder = null;
    
    /**
     * The target of the header inflector
     *
     * @var string
     */
    protected $_headerInflectorTarget = '<h3>:title</h3>';
    
    protected $_headerInflector = null;

    public function __construct()
    {
        $this->_headerInflector = new Zend_Filter_Inflector();
        $this->_headerInflector->setTargetReference(
            $this->_headerInflectorTarget
        );
        $this->_headerInflector->setRules(array(
            'title' => 'a',
        ));
        parent::__construct();
    }

    /**
     * Retrieve placeholder for sidebar
     *
     * @return Zend_View_Helper_Sidebar
     */
    public function sidebar()
    {
        return $this;
    }

    /**
     * Set a default order to add sidebar items
     *
     * @param string $setType
     */
    public function setDefaultAttachOrder($setType)
    {
        if (!in_array($setType, array(
            Zend_View_Helper_Placeholder_Container_Abstract::APPEND,
            Zend_View_Helper_Placeholder_Container_Abstract::SET,
            Zend_View_Helper_Placeholder_Container_Abstract::PREPEND
        ))) {
            require_once 'Zend/View/Exception.php';
            throw new Zend_View_Exception("You must use a valid attach order: 'PREPEND', 'APPEND' or 'SET'");
        }

        $this->_defaultAttachOrder = $setType;
        return $this;
    }

    /**
     * Get the default attach order, if any.
     *
     * @return mixed
     */
    public function getDefaultAttachOrder()
    {
        return $this->_defaultAttachOrder;
    }

    /**
     * Turn helper into string
     *
     * @param  string|null $indent
     * @param  string|null $locale
     * @return string
     */
    public function toString($indent = null)
    {
        $indent = (null !== $indent)
                ? $this->getWhitespace($indent)
                : $this->getIndent();

        $output = '';
        if(($prefix = $this->getPrefix())) {
            $output  .= $prefix;
        }
        
        foreach ($this as $item) {
            if (isset($item['title'])) {
                $output .= $this->_headerInflector->filter(array(
                    'title' => $item['title']
                ));
            }
            $output .= $item['data'];
        }
        
        if(($postfix = $this->getPostfix())) {
            $output .= $postfix;
        }

        return $indent . '<div class="sidebar">' . $output . '</div>';
    }
    
    public function append($data, $title = null)
    {
        $info = array();
        $info['data']      = $data;
        if ($title) {
            $info['title'] = $title;
        }
        parent::append($info);
    }
    
    public function prepend($data, $title = null)
    {
        $info = array();
        $info['data']      = $data;
        if ($title) {
            $info['title'] = $title;
        }
        parent::prepend($info);
    }
    
    public function set($data, $title = null)
    {
        $info = array();
        $info['data']      = $data;
        if ($title) {
            $info['title'] = $title;
        }
        parent::set($info);
    }
    
}
