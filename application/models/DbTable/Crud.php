<?php

class Application_Model_DbTable_Crud extends Zend_Db_Table_Abstract
{

    protected $_name = 'proglang';
    protected $_primary = 'id';
    
    public function getList($order="language_name") {
        $query = $this->select()->setIntegrityCheck(false);
        $query->from(array('proglang'),array('proglang.id','proglang.language_name','proglang.language_description'));
        $query->order($order);
        $list = $this->fetchAll($query);
        return $list;
    }
    
    public function getLanguageDetails($id) {
        $query = $this->select()->setIntegrityCheck(false);
        $query->from(array('proglang'),array('id','language_name','language_description'));
        $query->where('id = ?',$id);
        $list = $this->fetchRow($query);
        return $list;
    }
    
    public function insertRecord($name, $description) {
        $new_record = new Application_Model_DbTable_Crud();
        $data = array(
            'id' => null,
            'language_name' => $name,
            'language_description' => $description
        );
        $result = $new_record->insert($data);        
    }
    
    public function updateRecord($name,$description,$id) {
        $update_record = new Application_Model_DbTable_Crud();
        $data = array(
            'language_name' => $name,
            'language_description' => $description
        ); 
        $where = $update_record->getAdapter()->quoteInto('id = ?', $id);
        $update_record->update($data,$where);
    }
    
    public function deleteRecord($id) {
        $langTable = new Application_Model_DbTable_Crud();
        $where = $langTable->getAdapter()->quoteInto('id = ?', $id);
        $langTable->delete($where);
    }

}

