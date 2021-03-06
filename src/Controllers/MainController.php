<?php 

namespace Controllers;

use Exception;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;
use Jenssegers\Blade\Blade;
use Models\PostsModel;

class MainController {
    protected $log;
    protected $root_dir;
    protected $errors = [];

    function __construct() {
        // LOG
        $this->log = new Logger('activity');
        $this->log->pushHandler(new StreamHandler('logs/activity.txt', Logger::INFO));

        // BLADE - TEMPLATE ENGINE
        $this->blade = new Blade('src/Views', 'src/Cache');

        // ROOT DIRECTORY
        $this->root_dir = explode("\\",__DIR__);
        array_pop($this->root_dir);
        $this->root_dir = join("\\",$this->root_dir);
    }

    function welcome() {
        $model = new PostsModel;
        $result = $model->getAll();
        $this->render('Welcome',['posts' => $result]);
    }

    function render($page_location,$passing_data = []) {
        echo $this->blade->make($page_location,$passing_data)->render();
    }

    function saveFile($file,$type,$folder) {
        if (!empty($file[$type]['name'])) {
            // RENAME BEFORE SAVE.
            $file_extension = explode('.',$file[$type]['name']);
            $file_name = uniqid() . '.' . $file_extension[count($file_extension) - 1];

            // WHERE THE FILE WILL BE SAVED AT.
            $file_dir = $this->root_dir . "\\Storage\\$folder\\" . $file_name;

            // START SAVING.
            try {
                $start_saving = move_uploaded_file($file[$type]['tmp_name'],$file_dir);
                if (!$start_saving) {
                    throw new Exception("Failed to save the file!");
                } else {
                    $this->log->warning("A file has been saved at $file_dir");
                }
            } catch (Exception $e) {
                $this->log->error($e->getMessage());
            }
        } else {
            return (string) "no_image";
        }
            
        return (string) $file_name;
    }
}