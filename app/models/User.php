<?php
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
        $email_data['type'] = "register";

        if($this->email_member($email_data)){
            echo "Email successfully sent.";
            die();
        }else{
            echo "sOMETHING WENT WRONG.";
            die();
        }
        
        /*
        // Execute
        if($this->db->execute()){
            return true;
        } else {
            return false;
        }
        */
    }

    // Email the user regarding the registration
    public function email_member($data){
        //check the email type
        if($data['type'] = "register"){
            // send the registration email
            {
                $base_url = URLROOT ;
                $mail_body = "
                <p>Hi ".$$data['name'].",</p>
                <p>Thanks for Registration with us.</p><br/>
                <p>Please Open this link to verified your email address - ".URLROOT."users/confirmation/".$user_activation_code."
                <p>Best Regards,<br />Your Ginseng Team</p>
                ";
                $mail = new PHPMailer/PHPMailer();
                $mail->IsSMTP();        //Sets Mailer to send message using SMTP
                $mail->Host = SMTPHOST;  
                $mail->Port = SMTPPORT;  
                $mail->SMTPAuth = true;  
                $mail->Username = SMTPUSER;
                $mail->Password = SMTPPASS;
                $mail->SMTPSecure = '';    
                $mail->From = 'admin@ginseng.com'; 
                $mail->FromName = 'Ginseng Restaurant';     
                $mail->AddAddress($data['email']);  //Adds a "To" address   
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


}