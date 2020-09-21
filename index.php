<?php 

require "./vendor/autoload.php";
use Jenssegers\Blade\Blade;

header('Content-Type: text/html; charset=utf-8');
date_default_timezone_set('Asia/Ho_Chi_Minh');
$blade = new Blade('','src/Cache');
session_start();

echo $blade->make('src.Views.Page')->render();