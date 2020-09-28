<?php 

require "./vendor/autoload.php";
use Jenssegers\Blade\Blade;

header('Content-Type: text/html; charset=utf-8');
date_default_timezone_set('Asia/Ho_Chi_Minh');
$blade = new Blade('','src/Cache');
session_start();

echo $blade->make('src.Views.Page')->render();

interface Animal {
    const HUMAN = false;
    public function setName($name);
    public function getName();
}

class Dog implements Animal {
    private $name;

    public function setName($name) {
        $this->name = $name;    
    }

    public function getName() {
        return $this->name;
    }
}

trait Food {
    private $food = ['snack','pepsi','coca'];

    function __construct() {
        $this->food[0] = 'something';
    }
}

class Cat extends Dog {
    use Food;

    public function getFood() {
        return $this->food;
    }
}

$cat = new cat;
$cat->setName("Lucky");
echo "<br>Your dog's name is {$cat->getFood()[0]}";