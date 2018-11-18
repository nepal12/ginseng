<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
class User{
    private $db;

    public function __construct(){
        $this->db = new Database;
    }

    // Register User
    public function register($data){
        $this->db->query('INSERT INTO users (user_name, user_email, password, rand_code, user_status) VALUES(:name, :email, :password, :random, :stat)');
        // Bind values
        $this->db->bind(':name', $data['name']);
        $this->db->bind(':email', $data['email']);
        $this->db->bind(':password', $data['password']);
        $this->db->bind(':random', $data['random_code']);
        $this->db->bind(':stat', $data['user_status']);
        
        $email_data['name']= $data['name'];
        $email_data['email']= $data['email'];
        $email_data['code']= $data['random_code'];
        $email_data['type'] = "register";      
        
        // Execute the Query
        // Insert the user in the database
        // Send an email activation
        if($this->db->execute()){
            if($this->email_member($email_data)){
                return true;
            }else{
                return false;
            }
        } else {
            return false;
        }
        
    }

    // Email the user regarding the registration
    public function email_member($data){
        //check the email type
        if($data['type'] = "register"){
            // send the registration email
            {                              
                $mail = new PHPMailer(true);     
                $base_url = URLROOT ;
                $mail_body = "
                <p>Hi ".$data['name'].",</p>
                <p>Thanks for Registration with us.</p>
                <p>Please Open <a href= '".URLROOT."/users/emailconfirmation/".$data['code']."'>this link </a> to verified your email address. OR copy and paste the following link in your address bar. </p>" . URLROOT."users/emailconfirmation/".$data['code']."
                <p>Best Regards,<br />Your Ginseng Team</p>
                ";
                //Server setting
                $mail->IsSMTP();
                $mail->Host = SMTPHOST;  
                $mail->Port = SMTPPORT;  
                $mail->SMTPAuth = true;  
                $mail->Username = SMTPUSER;
                $mail->Password = SMTPPASS;
                $mail->SMTPSecure = 'tls';    
                // Reciepents setting
                $mail->setFrom('ginseng-48641d@inbox.mailtrap.io', 'Ritesh Rijal');
                $mail->addAddress($data['email'], $data['name']);     // Add a recipient              
                $mail->WordWrap = 50;       //Sets word wrapping on the body of the message to a given number of characters
                $mail->IsHTML(true);       //Sets message type to HTML    
                $mail->Subject = 'Ginsengrestaurant Email Verification';   //Sets the Subject of the message
                $mail->Body = $mail_body;       //An HTML or plain text message body
                if($mail->Send()){
                    return true;
                } else {
                    return false;
                }  
            }
        } else if($data['type'] = "resetpassword"){

        }

    }

    // Login User
    public function login($email, $password){
        $this->db->query('SELECT * FROM users WHERE user_email = :email');
        $this->db->bind(':email', $email);
        
        $row = $this->db->single();  
        $hashed_password = $row->password;
        if(password_verify($password, $hashed_password)){
          return $row;
        } else {
          return false;
        }
    }

    // CheckUser Status
    // Login User
    public function getUserStatus($email){
        $this->db->query('SELECT user_status FROM users WHERE user_email = :email');
        $this->db->bind(':email', $email);
        $row = $this->db->single(); 
        return $row->user_status;    
    }

    //Find user by email
    public function findUserByEmail($email){
        $this->db->query('SELECT * FROM users WHERE user_email = :email');
        $this->db->bind(':email', $email);

        $row = $this->db->single();

        //check row
        if($this->db->rowCount($row)){
            return true;
        }else{
            return false;
        }
    }

    // Find registration activation
    public function isActivated($code){
        $this->db->query('SELECT * FROM users WHERE rand_code = :code AND user_status = :rank');
        $this->db->bind(':code', $code);
        $this->db->bind(':rank', userStatusRank("active"));
        $row = $this->db->single();
        // check row
        if($this->db->rowCount($row)){
            return true;
        }else{
            return false;
        }
    }

    // email activation
    public function emailActivation($code){
        $this->db->query('UPDATE users set user_status= :newstatus WHERE rand_code = :code');
        $this->db->bind(':newstatus', userStatusRank("active"));
        $this->db->bind(':code', $code);
        if($this->db->execute()){
            return true;
        } else {
            return false;
        }
    }


}