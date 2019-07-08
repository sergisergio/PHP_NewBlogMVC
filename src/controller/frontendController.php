<?php

namespace Philippe\Blog\Src\Controller;

use Philippe\Blog\Src\Model\PostManager;
use Philippe\Blog\Src\Model\CommentManager;

class FrontendController {
	function listPosts()
	{
		$postManager = new PostManager(); // Création d'un objet
	    $posts = $postManager->getPosts();

	    require('view/frontend/listPostsView.php');
	}

	function post()
	{
		$postManager = new PostManager();
	    $commentManager = new CommentManager();

	    $post = $postManager->getPost($_GET['id']);
	    $comments = $commentManager->getComments($_GET['id']);

	    require('view/frontend/postView.php');
	}

	function addComment($postId, $author, $comment)
	{
		$commentManager = new CommentManager();
	    $affectedLines = $commentManager->postComment($postId, $author, $comment);

	    if ($affectedLines === false) {
	        // Erreur gérée. Elle sera remontée jusqu'au bloc try du routeur !
	        throw new Exception('Impossible d\'ajouter le commentaire !');
	    }
	    else {
	        header('Location: index.php?action=post&id=' . $postId);
	    }
	}

	function editComment($commentId)
	{
	    $commentManager = new CommentManager();
	    //$postManager = new PostManager();
	    $comment = $commentManager->getComment($commentId);
	    //$post = $postManager->getPost($comment['post_id']);
	    $data = $comment->fetch();

    	$comment->closeCursor();
	    require('view/frontend/commentView.php');
	}
	function modifyComment($commentId, $author, $comment)
	{
	    $commentManager = new CommentManager();
	    $modifiedComment = $commentManager->modifyComment($commentId, $author, $comment);
	    $comment = $commentManager->getComment($commentId);

	    if ($modifiedComment === false) {
	        throw new Exception('Impossible de modifier le commentaire !');
	    }
	    else {
	        header('Location: index.php?action=post&id=' . $_GET['post_id']);
	    }
	}
}

