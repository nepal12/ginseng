<?php
    class Home extends Controller{
        public function __construct(){
            
        }
        // Index method. This is the default view
        public function Index(){
            $data = [
                'title'=>'Welcome'
            ];
            $this->view("home/index", $data);
        }
    }