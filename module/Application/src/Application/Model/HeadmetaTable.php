<?php

namespace Application\Model;

use Zend\Db\Adapter\Adapter,
    Zend\Db\ResultSet\ResultSet,
    Zend\Db\TableGateway\AbstractTableGateway,
    Zend\Db\Sql\Expression,
    Zend\Db\Sql\Select,
    Zend\Paginator\Adapter\DbSelect,
    Page\Model\Feedback;

class HeadmetaTable extends AbstractTableGateway {

    protected $table = 'headmeta';

    public function __construct(Adapter $adapter) {
        $this->adapter = $adapter;
        $this->resultSetPrototype = new ResultSet();
        $this->resultSetPrototype->setArrayObjectPrototype(new Headmeta());
        $this->initialize();
    }

    public function getMetaByControllerAndAction($controller, $action) {
        $rowset = $this->select(array('controller' => $controller, 'action' => $action))->current();
        if (!$rowset) {
            $this->insert(array('controller' => $controller, 'action' => $action));
            $rowset = $this->select(array('controller' => $controller, 'action' => $action))->current();
        }
        return $rowset;
    }

    public function saveHeadMeta(Headmeta $headmeta) {
        $data = array(
            'title' => $headmeta->title,
            'description' => $headmeta->description,
            'keywords' => $headmeta->keywords,
        );
        $this->update(
                $data, array(
            'controller' => $headmeta->controller,
            'action' => $headmeta->action,
                )
        );
    }

}
