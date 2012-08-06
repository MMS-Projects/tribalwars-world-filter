<?php

class Application_Model_DbTable_Filters extends Zend_Db_Table_Abstract
{

    protected $_name = 'filters';
    
    protected $_dependentTables = array('FiltersToFilterOptionsMap');


}

