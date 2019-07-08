<?php

require 'vendor/autoload.php';

use Philippe\Blog\Src\Controller\FrontendController;

$frontController = new FrontendController();
try {
	if (isset($_GET['action'])) {
	    if ($_GET['action'] == 'listPosts') {
	        $frontController->listPosts();
	    }
	    elseif ($_GET['action'] == 'post') {
	        if (isset($_GET['id']) && $_GET['id'] > 0) {
	            $frontController->post();
	        }
	        else {
	            throw new Exception('aucun identifiant de billet envoyé');
	        }
	    }
	    elseif ($_GET['action'] == 'addComment') {
	        if (isset($_GET['id']) && $_GET['id'] > 0) {
	            if (!empty($_POST['author']) && !empty($_POST['comment'])) {
	                $frontController->addComment($_GET['id'], $_POST['author'], $_POST['comment']);
	            }
	            else {
	                throw new Exception('tous les champs ne sont pas remplis !');
	            }
	        }
	        else {
	            throw new Exception('aucun identifiant de billet envoyé');
	        }
	    }
	    elseif ($_GET['action'] == 'editComment') {
            if (isset($_GET['id']) && $_GET['id'] > 0 ) {
            	$frontController->editComment($_GET['id']);
            }
            else {
                throw new Exception('Aucun identifiant de commentaire envoyé');
            }
        }
        elseif ($_GET['action'] == 'modifyComment') {
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                if (!empty($_POST['comment']) && !empty($_POST['author'])) {
                    $frontController->modifyComment($_GET['id'], $_POST['author'], $_POST['comment']);
                }
                else {
                    // Autre exception
                    throw new Exception('Tous les champs ne sont pas remplis !');
                }
            }
            else {
                throw new Exception('Aucun identifiant de commentaire envoyé');
            }
        }
	}
	else {
	    $frontController->listPosts();
	}
}
catch(Exception $e) { // S'il y a eu une erreur, alors...
    echo 'Erreur : ' . $e->getMessage();
    require('view/frontend/errorView.php');
}