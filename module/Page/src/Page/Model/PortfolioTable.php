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
        return $this->select(array('active' => 1));
    }

    public function savePortfolio(Portfolio $portfolio) {
        $data = array(
        );

        $id = (int) $portfolio->id;

        if ($id == 0) {
            $this->insert($data);
            //return id of new post
            $sql = "SELECT LAST_INSERT_ID() AS id FROM portfolio";
            $rowset = $this->adapter->query($sql, array());
            return $rowset->current();
        } else {

            $data = array(
                'activity' => $portfolio->activity,
                'site_link' => $portfolio->site_link,
                'work' => $portfolio->work,
                'review' => $portfolio->review,
                'target' => $portfolio->target,
                'active' => 1,
            );

            $this->update(
                    $data, array(
                'id' => $id,
                    )
            );
        }
    }

    public function getPortfolioImagesById($id) {
        $id = (int) $id;
        $sql = "SELECT *
                FROM `portfolio_images`
                WHERE portfolio_id = $id";
        $rowset = $this->adapter->query($sql, array());
        return $rowset;
    }

    public function saveLogo($src, $id) {
        $id = (int) $id;
        $data = array(
            'logo' => $src,
        );

        $this->update(
                $data, array(
            'id' => $id,
                )
        );
    }
    
    public function saveBanner($src, $id) {
        $id = (int) $id;
        $data = array(
            'banner' => $src,
        );

        $this->update(
                $data, array(
            'id' => $id,
                )
        );
    }
    
    public function deletePortfolio($id) {
        $id = (int) $id;
        $rowset = $this->delete(array('id' => $id));
        return $rowset;
    }
    
    public function getPortfolioById($id) {
        $id = (int) $id;
        return $this->select(array('id' => $id))->current();
    }

}
