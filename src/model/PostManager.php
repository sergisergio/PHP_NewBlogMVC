<?php

namespace Philippe\Blog\Src\Model;

use PhilippeBlog\Src\Core\Factory\DbFactory;
use Philippe\Blog\Src\Model\Manager;
use \PDO;

class PostManager extends Manager
{
    protected $db;

    public function __construct() {
        $this->db = $this->getDb();
        //parent::__construct();
    }
    public function getPosts()
    {
        $req = $this->db->getPdo()->query('SELECT id, title, content, DATE_FORMAT(creation_date, \'%d/%m/%Y à %Hh%imin%ss\') AS creation_date_fr FROM posts ORDER BY creation_date DESC LIMIT 0, 5');

        $posts = $req->fetchAll();

        return $posts;

    }

    public function getPost($postId)
    {
        $req = $this->db->getPdo()->prepare('SELECT id, title, content, DATE_FORMAT(creation_date, \'%d/%m/%Y à %Hh%imin%ss\') AS creation_date_fr FROM posts WHERE id = ?');
        $req->execute(array($postId));
        $post = $req->fetch();

        return $post;
    }
}