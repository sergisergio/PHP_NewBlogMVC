<?php

namespace Philippe\Blog\Src\Model;

use Philippe\Blog\Src\Model\Manager;
use PhilippeBlog\Src\Core\Factory\DbFactory;
use \PDO;

class CommentManager extends Manager
{
    protected $db;

    public function __construct() {
        $this->db = $this->getDb();
        //parent::__construct();
    }
	public function getComments($postId)
    {
        $comments = $this->db->getPdo()->prepare('SELECT id, author, comment, DATE_FORMAT(comment_date, \'%d/%m/%Y à %Hh%imin%ss\') AS comment_date_fr FROM comments WHERE post_id = ? ORDER BY comment_date DESC');
        $comments->execute(array($postId));

        return $comments;
    }

    public function postComment($postId, $author, $comment)
    {
        $comments = $this->db->getPdo()->prepare('INSERT INTO comments(post_id, author, comment, comment_date) VALUES(?, ?, ?, NOW())');
        $affectedLines = $comments->execute(array($postId, $author, $comment));

        return $affectedLines;
    }

    public function getComment($commentId)
    {
        $comment = $this->db->getPdo()->prepare('SELECT id, post_id, author, comment, DATE_FORMAT(comment_date, \'%d/%m/%Y à %Hh%imin%ss\') AS comment_date_fr FROM comments WHERE id = ?');
        $comment->execute(array($commentId)); 
        //$comment = $req->fetch();
 
        return $comment;
    }

    public function modifyComment($commentId, $author, $comment)
    {
        $comments = $this->db->getPdo()->prepare('UPDATE comments SET author = ?, comment = ?, comment_date = NOW() WHERE id = ?');
        $editedComment = $comments->execute(array($author, $comment, $commentId)); //ligne 31
 
        return $editedComment;
    }  
}