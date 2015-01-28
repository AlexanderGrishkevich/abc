<?php

namespace Page\Model;

use Zend\Db\Adapter\Adapter,
    Zend\Db\ResultSet\ResultSet,
    Zend\Db\TableGateway\AbstractTableGateway,
    Zend\Db\Sql\Expression,
    Zend\Db\Sql\Select,
    Zend\Paginator\Adapter\DbSelect;

class ServicesTable extends AbstractTableGateway {

	protected $table = 'services';

    public function __construct(Adapter $adapter) {
        $this->adapter = $adapter;
        $this->resultSetPrototype = new ResultSet();
        $this->resultSetPrototype->setArrayObjectPrototype(new Services());
        $this->initialize();
    }

    public function fetchAll() {
        $select = new Select($this->table);
        return $this->executeSelect($select);
    }

//    public function save(Checkout $checkout) {
//        $data = array(
//            'username' => $checkout->username,
//            'phone' => $checkout->site,
//            'phone' => $checkout->phone,
//            'email' => $checkout->email,
//            'text' => $checkout->text,
//        );
//        $this->insert($data);
//    }
//    
//    public function deleteCheckout($id) {
//        $id = (int) $id;
//        $rowset = $this->delete(array('id' => $id));
//        return $rowset;
//    }
}