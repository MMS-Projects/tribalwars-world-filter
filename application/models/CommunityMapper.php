<?php

class Application_Model_CommunityMapper
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
            $this->setDbTable('Application_Model_DbTable_Communities');
        }
        return $this->_dbTable;
    }
 
    public function save(Application_Model_Community $entry)
    {
        $data = array(
            'tag' => $entry->tag,
            'url' => $entry->url,
            'sprite_place' => $entry->spritePlace
        );
 
        if (null === ($id = $entry->getId())) {
            unset($data['id']);
            $this->getDbTable()->insert($data);
        } else {
            $this->getDbTable()->update($data, array('id = ?' => $id));
        }
    }
 
    public function find($id, Application_Model_Community $entry)
    {
        $result = $this->getDbTable()->find($id);
        if (0 == count($result)) {
            return;
        }
        $row = $result->current();
        $entry->id  = $row->id;
        $entry->tag = $row->tag;
        $entry->url = $row->url;
        $entry->spritePlace = $row->sprite_place;
    }
 
    public function fetchAll()
    {
        $resultSet = $this->getDbTable()->fetchAll();
        $entries   = array();
        foreach ($resultSet as $row) {
            $entry = new Application_Model_Community();
            $entry->setProperties(array(
                'id'    => $row->id,
                'tag'   => $row->tag,
                'url'   => $row->url,
                'sprite_place' => $row->sprite_place,
            ));
            $entries[] = $entry;
        }
        return $entries;
    }

}

