<?php

namespace Page\Model;

use Zend\Db\Adapter\Adapter,
    Zend\Db\ResultSet\ResultSet,
    Zend\Db\TableGateway\AbstractTableGateway,
    Zend\Db\Sql\Expression,
    Zend\Db\Sql\Select,
    Zend\Paginator\Adapter\DbSelect,
    Page\Model\Portfolio;

class PortfolioTable extends AbstractTableGateway {

	protected $table = 'portfolio';

    public function __construct(Adapter $adapter) {
        $this->adapter = $adapter;
        $this->resultSetPrototype = new ResultSet();
        $this->resultSetPrototype->setArrayObjectPrototype(new Portfolio());
        $this->initialize();
    }

    public function fetchAll() {
        $select = new Select($this->table);
        return $this->executeSelect($select);
    }

    public function save(Portfolio $portfolio) {
//        $data = array(
//            'username' => $checkout->username,
//            'phone' => $checkout->site,
//            'phone' => $checkout->phone,
//            'email' => $checkout->email,
//            'text' => $checkout->text,
//        );
//        $this->insert($data);
    }
    
    public function getPortfolioImagesById($id) {
        $id = (int) $id;
        $sql = "SELECT *
                FROM `portfolio_images`
                WHERE portfolio_id = $id";
        $rowset = $this->adapter->query($sql, array());
        return $rowset;
        
    }
}