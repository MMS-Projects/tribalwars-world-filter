<?php

class Application_Model_WorldMapper
{

    protected $_dbTable;
 
    public function setDbTable($dbTable)
    {
        if (is_string($dbTable)) {
            $dbTable = new $dbTable();
        }
        if (!$dbTable instanceof Zend_Db_Table_Abstract) {
            throw new Exception('Invalid table data gateway provided');
        }
        $this->_dbTable = $dbTable;
        return $this;
    }
 
    public function getDbTable()
    {
        if (null === $this->_dbTable) {
            $this->setDbTable('Application_Model_DbTable_Worlds');
        }
        return $this->_dbTable;
    }
 
    public function save(Application_Model_Filter $filter)
    {
        $data = array(
            'title'   => $filter->title,
            'tag'     => $filter->tag,
        );
 
        if (null === ($id = $filter->getId())) {
            unset($data['id']);
            $this->getDbTable()->insert($data);
        } else {
            $this->getDbTable()->update($data, array('id = ?' => $id));
        }
    }
 
    public function find($id, Application_Model_Filter $filter)
    {
        $result = $this->getDbTable()->find($id);
        if (0 == count($result)) {
            return;
        }
        $row = $result->current();
        $filter->id    = $row->id;
        $filter->title = $row->title;
        $filter->tag   = $row->tag;
    }
 
    public function fetchAll()
    {
        $resultSet = $this->getDbTable()->fetchAll();
        $entries   = array();
        foreach ($resultSet as $row) {
            $entry = new Application_Model_World();
            $entry->setProperties(array(
                'id'    => $row->id,
                'tag'   => $row->tag,
                'game_knight' => $row->game_knight,
                'snob_gold' => $row->snob_gold,
                'game_church' => $row->game_church,
                'speed' => $row->speed,
                'coord_bonus_villages' => $row->coord_bonus_villages,
            ));
            $entries[] = $entry;
        }
        return $entries;
    }

}

