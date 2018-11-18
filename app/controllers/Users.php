<?php
class Users extends Controller{
    public function __construct(){
      $this->userModel = $this->model('User');
    }

    //Index function
    public function Index(){
        // User Profile
        echo "This is index";
    }

    // Register function
    public function register(){
        // Check for POST
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            // Process form
    
            // Sanitize POST data
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
  
            // Init data
            $data =[
                'name' => trim($_POST['name']),
                'email' => trim($_POST['email']),
                'password' => trim($_POST['password']),
                'confirm_password' => trim($_POST['confirm_password']),
                'name_err' => '',
                'email_err' => '',
                'password_err' => '',
                'confirm_password_err' => ''
            ];
  
            // Validate Email
            if(empty($data['email'])){
                $data['email_err'] = 'Please enter email';
            }else{
                // check if e-mail address is well-formed
                if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
                    $data['email_err'] = "Invalid email format"; 
                } else {
                  if($this->userModel->findUserByEmail($data['email'])){
                    $data['email_err'] = 'Email already exists.';
                  }
                } 
            }
  
          // Validate Name
          if(empty($data['name'])){
            $data['name_err'] = 'Please enter name';
          }
  
          // Validate Password
          if(empty($data['password'])){
            $data['password_err'] = 'Please enter password';
          } elseif(strlen($data['password']) < 6){
            $data['password_err'] = 'Password must be at least 6 characters';
          }
  
          // Validate Confirm Password
          if(empty($data['confirm_password'])){
            $data['confirm_password_err'] = 'Please confirm password';
          } else {
            if($data['password'] != $data['confirm_password']){
              $data['confirm_password_err'] = 'Passwords do not match';
            }
          }
  
          // Make sure errors are empty
          if(empty($data['email_err']) && empty($data['name_err']) && empty($data['password_err']) && empty($data['confirm_password_err'])){
            // Validated
            
            // Hash the password
            $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
            //Other system generated registration inputs
            $data['random_code']= random_generator();
            $data['user_status']= "0";
            
            // Register User
            if($this->userModel->register($data)){
              flash("loginFlash", "You have been successfully registered. Please check your email : ". $data['email'] . "  to complete the registration.");
              redirect('users/login');
            } else {
              die('Something went wrong');    
            }

          } else {
            // Load view with errors
            $this->view('users/register', $data);
          }
  
        } else {
          // Init data
          $data =[
            'name' => '',
            'email' => '',
            'password' => '',
            'confirm_password' => '',
            'name_err' => '',
            'email_err' => '',
            'password_err' => '',
            'confirm_password_err' => ''
          ];
  
          // Load view
          $this->view('users/register', $data);
        }
    }
  

    // Login Method
    public function login(){
        // Check for POST
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
          // Process form
          // Sanitize POST data
          $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
          
          // Init data
          $data =[
            'email' => trim($_POST['email']),
            'password' => trim($_POST['password']),
            'email_err' => '',
            'password_err' => '',      
          ];
  
          // Validate Email
          if(empty($data['email'])){
            $data['email_err'] = 'Please enter email';
          } else{
            // check if e-mail address is well-formed
            if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
              $data['email_err'] = "Invalid email format"; 
            }  
          }
  
          // Validate Password
          if(empty($data['password'])){
            $data['password_err'] = 'Please enter password';
          }

          // Check for user/email
          if($this->userModel->findUserByEmail($data['email'])){
            
          } else {
            // User not found
            $data['email_err'] = 'No user found';
          }

          // Check for  user activation
          $stat = $this->userModel->getUserStatus($data['email']);

          if($stat == userStatusRank("active")){
            
          } elseif ($stat == userStatusRank("inactive")){
            flash("loginFlash", "You need to confirm your registration before you are able to login to our system. Please check your email.", "alert alert-info");
            redirect('/users/login');
          } elseif ($stat == userStatusRank("blocked")){
            flash("loginFlash", "Your account is Blocked !! Please contact the admin.", "alert alert-danger");
            redirect('/users/login');
          } 
  
          // Make sure errors are empty
        if(empty($data['email_err']) && empty($data['password_err'])){
          // Validated
          // Check and set logged in user
          $loggedInUser = $this->userModel->login($data['email'], $data['password']);
         
          if($loggedInUser){
            echo "yahoo vava";
            // Create Session
            $this->createUserSession($loggedInUser);
          } else {
            $data['password_err'] = 'Password incorrect';

            $this->view('users/login', $data);
          }
        } else {
          // Load view with errors
          $this->view('users/login', $data);
        }


      } else {
        // Init data
        $data =[    
          'email' => '',
          'password' => '',
          'email_err' => '',
          'password_err' => '',        
        ];

        // Load view
        $this->view('users/login', $data);
      }
    }

    public function createUserSession($user){

      $_SESSION['user_id'] = $user->user_id;
      $_SESSION['user_email'] = $user->user_email;
      $_SESSION['user_name'] = $user->user_name;
      redirect('');
    }

    public function logout(){
      unset($_SESSION['user_id']);
      unset($_SESSION['user_email']);
      unset($_SESSION['user_name']);
      session_destroy();
      redirect('');
    }

    public function isLoggedIn(){
      if(isset($_SESSION['user_id'])){
        return true;
      } else {
        return false;
      }
    }

    // Email confirmation
    public function emailconfirmation($code){
      // check for the empty and invalid code
      if(empty($code) || strlen($code)<25){
        $this->view('404');  
      }else{
        // Now check if the user is already activated
        if($this->userModel->isActivated($code)){
          flash('loginFlash', 'Your account is already activated. You can login to your account.', 'alert alert-info');
          redirect('users/login');
        }else{
          if($this->userModel->emailActivation($code)){
            flash('loginFlash', 'Your account is now successfully activated. You can login to your account.');
            redirect('users/login'); 
          }else{
            // Later redirect to the contact page ...
            flash('registerFlash', 'There is some problem with your account creation. Please contact the admin using the contact form to solve this problem', 'alert alert-error') ;
            redirect('users/register'); 
          }
        }
      }
    }

  }