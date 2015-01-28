<?php

namespace Page\Model;

use Zend\Db\Adapter\Adapter,
    Zend\Db\ResultSet\ResultSet,
    Zend\Db\TableGateway\AbstractTableGateway,
    Zend\Db\Sql\Expression,
    Zend\Db\Sql\Select,
    Zend\Paginator\Adapter\DbSelect,
    Page\Model\Feedback;

class LandingTable extends AbstractTableGateway {

	protected $table = 'landing';

    public function __construct(Adapter $adapter) {
        $this->adapter = $adapter;
        $this->resultSetPrototype = new ResultSet();
        $this->resultSetPrototype->setArrayObjectPrototype(new Landing());
        $this->initialize();
    }

    public function fetchAll() {
        $select = new Select($this->table);
        return $this->executeSelect($select);
    }

    public function save(Landing $landing) {
        $data = array(
            'type' => $landing->type,
            'phone' => $landing->phone,
            'business' => $landing->business,
            'email' => $landing->email,
            'question' => $landing->question,
        );
        $this->insert($data);
    }
    
    public function deleteCheckout($id) {
        $id = (int) $id;
        $rowset = $this->delete(array('id' => $id));
        return $rowset;
    }
}