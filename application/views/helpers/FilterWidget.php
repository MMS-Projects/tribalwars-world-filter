<?php

class Zend_View_Helper_FilterWidget extends Zend_View_Helper_Abstract
{

    public function filterWidget()
    {
        $html = '<div id="filters"><form id="filter-form"></form></div>';
        return $html;
    }
    
}
