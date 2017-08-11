<?php 

class Model
{ 
    protected $contactname;
    protected $email;
    protected $subject;
    protected $message;
    
    private $error = [];
    private $send_error = false;
    private $send = false;

    public function __construct()
   {

   }
   	
	public function getArray()
        {	    
            $default = [
                '%TITLE%'=>'Contact Form'
            ];
            if($this->send){
                if($this->send_error){
                    $default['%send_message%'] = "сообщение отправлено";
                }  else {
                    $default['%send_message%'] = "ошибка отправки сообщения";
                }
            }else{
                $default['%send_message%'] = "";
            }
            foreach ($this as $k => $v){
               if($k != 'error' && $k != 'send_error' && $k != 'send'){
                  $default['%error_'.$k.'%'] = (isset($this->error[$k])) ? $this->error[$k] : ""; 
                  if($k == "subject"){
                      $default['%subject_'.$v.'%'] = 'selected';
                  }else{
                    $default['%'.$k.'%'] = ($this->send && $this->send_error) ? "" : $v;
                  }
               }
            }
            
            return $default;	
        }
	
	public function checkForm()
	{
        $errors = [];
            
        if(!empty($_POST)) { 
            $this->contactname = $_POST["contactname"];
            $this->email = $_POST["email"];
            $this->subject = $_POST["subject"];
            $this->message = $_POST["message"];
            
            if($this->validate()){
                return true;
            }  else {
                return false;
            }     			
          }
        
        }
        
        function rules(){
        
        return [
            "required" => "contactname,email,subject,message",
            "email"=>"email",
            "length"=>['contactname'=>20,'email'=>30]
            ];

        }
        
        function validate(){

        $rules = $this->rules();
            foreach ($rules as $rule => $value) {

                switch ($rule){
                    case "required":
                        $fields = explode(",", $value);
                        foreach ($fields as $field) {
                            $field = trim($field);
                            if($this->$field == ""){
                                $this->error[$field] = "Не может быть пустым";   
                            }
                        }
                        break;
                    case "email":
                        $fields = explode(",", $value);
                        foreach ($fields as $field) {
                            $field = trim($field);
                            $tmpl = "`^[a-z0-9!#$%&'*+\/=?^_\`{|}~-]+(?:\.[a-z0-9!#$%&'*+\/=?^_\`{|}~-]+)*@(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?$`i";
                            $valid = preg_match($tmpl, $this->$field);
                            if(!$valid){
                                $this->error[$field] = "Не правильный email";
                            }

                        }
                        break; 
                    case "length":
                         foreach ($value as $field => $length) {
                             if(strlen($this->$field)>$length){
                                 $this->error[$field] = "не может быть больше ".$length;
                             }
                         }

                        break;
                }

            }

                if(sizeof($this->error) == 0){
                    return true;
                }  else {
                    return false;
                }
        
        }
    
   
	public function sendEmail()
	{
            $to = 'alexnikolaev.ua@gmail.com';
            $subject = $this->subject;
            $message = date("d.m.Y H:i", strtotime("now"))."\n".$this->message;
            $headers =  'From: '.$this->contactname.' <'.$this->email . '> \r\n'.
                        'MIME-Version: 1.0 \r\n'.
                        'Content-type: text/html; charset=utf-8 \r\n'.
                        'Content-Transfer-Encoding: 8bit \r\n'.
                        'Date: '.date("r (T)").' \r\n';
            $this->send = TRUE;
            
            echo $to, "<br>";
            echo $subject, "<br>";
            echo $message, "<br>";
            print_r($headers);
            echo "<br>";
            //print_r($_SERVER);
            echo $_SERVER["REMOTE_ADDR"];
//            $this->send_error = mail($to, $subject, $message, $headers);
	}		
}
