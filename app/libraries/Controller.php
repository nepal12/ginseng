<?php
    /*
     * Base Controller
     * Loads the models and views
    */

    class Controller {
        // Load model
        public function model($model){
            // Require model file
            require_once '../app/models/' . $model . '.php';
            // Instatiate model
            return new $model();
        }  
        
        // Load View My Style
        public function viewaaa($view,$data = []){
            require_once('../app/views/main.php');
        }
        // Load view
        public function view($view, $data = []){
            // Check for view file
            if(file_exists('../app/views/' . $view . '.php')){
                require_once '../app/views/' . $view . '.php';
            } else {
                // View doesnot exists
                die('View does not exists. Need to use one 404 view here');
            }
        }
    }