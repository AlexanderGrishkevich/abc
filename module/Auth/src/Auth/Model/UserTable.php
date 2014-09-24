<?php

namespace Auth\Model;

use Zend\Db\Adapter\Adapter,
    Zend\Db\ResultSet\ResultSet,
    Zend\Db\TableGateway\AbstractTableGateway,
    Zend\Db\Sql\Expression,
    Zend\Db\Sql\Select,
    Zend\Paginator\Adapter\DbSelect,
    Auth\Model\User;

class UserTable extends AbstractTableGateway {

	protected $table = 'users';

    public function __construct(Adapter $adapter) {
        $this->adapter = $adapter;
        $this->resultSetPrototype = new ResultSet();
        $this->resultSetPrototype->setArrayObjectPrototype(new User());
        $this->initialize();
    }

    public function fetchAll() {
        $select = new Select($this->table);
        $resultSet = $this->executeSelect($select);
        return $resultSet;
    }

	public function saveUser(User $user) {
		$data = array(
            'email' => $user->email,
            'password' => new Expression("md5(?)", $user->password),
		);
		$id = (int)$user->id;

        if ($id == 0) {
            $this->insert($data);
        } elseif ($this->getUser($id)) {
            $this->update(
                $data,
                array(
                    'id' => $id,
                )
            );
        } else {
            throw new \Exception('Form id does not exist');
        }
	}

    public function activateUser($id, $time) {
        $id  = (int) $id;
        if ($this->getUser($id)) {
            $this->update(array('off_date' => $time), array('id' => $id));
        }
    }

	public function getUser($id) {
        $id  = (int) $id;
        $rowset = $this->select(array('id' => $id));
        $row = $rowset->current();
        if (!$row) {
            throw new \Exception("Could not find row $id");
        }
        return $row;
	}

    public function getUserByEmail($email) {
        $rowset = $this->select(array('email' => $email));
        $row = $rowset->current();
        if (!$row) {
            return false;
        }
        return $row;
    }

    public function getUserByUNP($unp) {
        $rowset = $this->select(array('unp' => $unp));
        $row = $rowset->current();
        if (!$row) {
            return false;
        }
        return $row;
    }

    public function updateAvatar($file, $id) {
        $id  = (int) $id;
        if ($this->getUser($id)) {
            $this->update(array('avatar' => $file), array('id' => $id));
        }
    }

    public function changePassword($id, $password) {
        $id  = (int) $id;
        if ($this->getUser($id)) {
            $this->update(array('password' => new Expression("md5(?)", $password)), array('id' => $id));
        }
    }
    
    public function updatePassword(User $user) {
        $id = (int)$user->id;
        $data = array(
            'password' => $user->password,
            );
        $this->update(
                $data,
                array(
                    'id' => $id,
                )
            );
    }
    
    public function deleteUser($id) {
        $id = (int) $id;
        $rowset = $this->delete(array('id' => $id));
        return $rowset;
    }
}