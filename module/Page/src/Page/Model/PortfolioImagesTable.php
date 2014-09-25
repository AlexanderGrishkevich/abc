<?php

namespace Page\Model;

use Zend\Db\Adapter\Adapter,
    Zend\Db\ResultSet\ResultSet,
    Zend\Db\TableGateway\AbstractTableGateway,
    Zend\Db\Sql\Expression,
    Zend\Db\Sql\Select,
    Zend\Paginator\Adapter\DbSelect,
    Page\Model\PortfolioImages;

class PortfolioImagesTable extends AbstractTableGateway {

    protected $table = 'portfolio_images';

    public function __construct(Adapter $adapter) {
        $this->adapter = $adapter;
        $this->resultSetPrototype = new ResultSet();
        $this->resultSetPrototype->setArrayObjectPrototype(new PortfolioImages());
        $this->initialize();
    }

    public function save($file, $id) {
        $data = array(
            'portfolio_id' => $id,
            'filepath' => $file
        );
        $this->insert($data);
    }
    
    public function deleteImage($src) {
        $rowset = $this->delete(array('filepath' => $src));
        return $rowset;
    }

}
