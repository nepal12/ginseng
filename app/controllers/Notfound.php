<?php
    // class for 404
    class Notfound extends Controller{
        public function __construct(){

        }

        public function Index(){
            $this->view('404', []);
        }

    }
