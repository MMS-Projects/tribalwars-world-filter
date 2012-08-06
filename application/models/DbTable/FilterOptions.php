<?php

class Application_Model_DbTable_FilterOptions extends Zend_Db_Table_Abstract
{

    protected $_name = 'filter_options';

    protected $_referenceMap = array (
        'Application_Model_DbTable_Filters' => array (
            'columns' =>'filter_id',
            'refTableClass'=>'Application_Model_DbTable_Filters',
            'refColumns'=>'id'
        )
    );
    
}

