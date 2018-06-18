<?php

class Application_Model_UserMapper
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
            $this->setDbTable('Application_Model_DbTable_User');
        }
        return $this->_dbTable;
    }
 
    public function save(Application_Model_User $user)
    {
        $data = array(
            'username'   => $user->getUsername(),
            'name' => $user->getName(),
            'password' => password_hash($user->getPassword(),PASSWORD_BCRYPT),
            'created_at' => date('Y-m-d H:i:s'),
        );
 
        if (null === ($id = $user->getId())) {
            unset($data['id']);
            $this->getDbTable()->insert($data);
        } else {
            $this->getDbTable()->update($data, array('id = ?' => $id));
        }
    }
 
    public function find($id,Application_Model_User $user)
    {
        $result = $this->getDbTable()->find($id)->toArray();
        
        if (0 == count($result)) {
            return;
        }
        //$row = $result->current();
        foreach($result as $row){
            $user->setId($row['id'])
                ->setUsername($row['username'])
                ->setName($row['name'])
                ->setPassword($row['password'])
                ->setCreated($row['created_at']);
        }
        
        return $user;
    }

    public function delete($id){

        $result = $this->getDbTable()->delete("id = $id");

        return $result;
    }

    
 
    public function fetchAll()
    {   
        $resultSet = $this->getDbTable()->fetchAll()->toArray();
        
        $entries   = array();
        foreach ($resultSet as $row) {
            $entry = new Application_Model_User();
            $entry->setId($row['id'])
                ->setUsername($row['username'])
                ->setName($row['name'])
                ->setPassword($row['password'])
                ->setCreated($row['created_at']);
            $entries[] = $entry;
        }
        return $entries;
        
    }
}

