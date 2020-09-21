<?php

use Controllers\UsersController;

$route = isset($_GET['site']) ? $_GET['site'] : '';
$users = new UsersController;

switch ($route) {
    case 'welcome': { 
        $users->welcome();
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
    }

    default: {
        include __DIR__."./HTTP_WARNINGS/404.php";
        break;
    }
}