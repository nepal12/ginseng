<?php
    class Shares extends Controller{
        public function __construct(){
            $this->shareModel = $this->model('Share');
           
        }
        // Index method. This is the default view
        public function Index(){
            $posts = $this->shareModel->getPosts();
            $data =[
                'title' => 'welcome',
                'posts' => $posts
            ];
            $this->view("shares/index", $data);
        }
    }