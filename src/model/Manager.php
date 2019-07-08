<?php

namespace Philippe\Blog\Src\Model;

use Philippe\Blog\Src\Core\Factory\DbFactory;

class Manager
{
	protected $db;

    protected function getDb()
    {
        $this->db = new DbFactory();
        return $this->db;
    }
}