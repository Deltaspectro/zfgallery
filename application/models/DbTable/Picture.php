<?php
class Model_DbTable_Picture extends Zend_Db_Table_Abstract
{

    protected $_name = 'pictures';

    public function setPictureData($data)
    {
        // create a new row
        $row = $this->createRow();
        if ($row) {

        				try
			             {
			            $row->filename =  $data->filename;
			            $row->date =  $data->date;
			            $row->save();
			            
			            return true;
			            }
			             //catch (Zend_Exception $e) { //egyszerű is
			             catch (Exception $e) {
			             echo "ERROR, not create row!: : " . $e->getMessage() . "\n";
			            }
        } else {
            throw new Zend_Exception("ERROR, not create row");
        }
        
        
        return false;
    }
    
    /*
        public function readMessage()
    {
    	    $select = $this->select()
    
	     // ->from($this->_name, array('COUNT(*)','id', 'message' ))
	      ->from($this->_name, array('id', 'message' ))
	     ->joinInner(array('user1' => 'users'),'user1.id = messages.sender_id', array('sendername'=>'name')) 
	    ->joinInner(array('user2' => 'users'),'user2.id = messages.addressed_id', array('addressedname'=>'name')) 
	      ->order(array('id ASC'));
	      ;   

	      $select->setIntegrityCheck(false);  
	        $rows = $this->fetchAll($select);
	      // Zend_Debug::dump($rows); 
	     return $rows;
    }

*/

}
