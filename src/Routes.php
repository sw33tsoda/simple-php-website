<?php

use Controllers\CommentsController;
use Controllers\UsersController;
use Controllers\PostsController;

$route = isset($_GET['site']) ? $_GET['site'] : '';
$users = new UsersController;
$posts = new PostsController;
$comments = new CommentsController;

switch ($route) {
    case 'welcome': { 
        $users->welcome();
        break;
    }

    case 'user_profile'; {
        $users->user_profile();
        break;
    }

    case 'register': {
        if (!isset($_SESSION['user']))
            $users->register();
        break;
    }

    case 'login': {
        if (!isset($_SESSION['user']))
            $users->login();
        break;
    }

    case 'edit': {
        if (isset($_SESSION['user']))
            $users->edit();
        break;
    }

    case 'logout': {
        if (isset($_SESSION['user']))
            $users->logout();
        break;
    }

    case 'add_post': {
        if (isset($_SESSION['user']))
            $posts->add();
        break;
    }

    case 'show_post': {
        $posts->show_post();
        break;
    }

    case 'add_comment': {
        if (isset($_SESSION['user']))
            $comments->add_comment();
        break;
    }
    
    case 'get_comment': {
        $comments->get_comment();
        break;
    }

    case 'my_post': {
        if (isset($_SESSION['user']))
            $posts->my_post();
        break;
    }

    case 'remove_post': {
        if (isset($_SESSION['user']))
            $posts->remove();
        break;
    }
    
    case 'test': {
        break;
    }

    default: {
        header('location:/?site=welcome');
        break;
    }
}