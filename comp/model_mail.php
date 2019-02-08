<?php
namespace Mail;
use \DateTime;
class Mail
{
    
    protected $input_alert;
    protected $from_email;
    protected $message;
    protected $to_email; 
    protected $subject; 
    protected $whole_message;
    protected $headers;
    
    public function __construct($from_email, $message, $subject, $to_email)
    {
        $this->from_email = $from_email;
        $this->message = $message;
        $this->subject = $subject;
        $this->to_email = $to_email;
    } 
    
    public function filterMessage()
    {
        $this->message = filter_var(stripslashes($this->message), FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    }
    
    public function checkMessageLength($min_length, $max_length)
    {
        if (!(strlen($this->message) >= $min_length) || !(strlen($this->message) <= $max_length)) {
            $this->input_alert .= 'error_length_subject&';
        }
    }
    
}
class MailFromUser extends Mail 
{
    
    private $from_name;
    
    public function __construct($from_name, $from_email, $message, $subject, $to_email)
    {
        parent::__construct($from_email, $message, $subject, $to_email);
        $this->from_name = $from_name;
    }
    
    public function filterName()
    {
        $this->from_name = filter_var(stripslashes($this->from_name), FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    } 
    
    public function filterEmailUser()
    {
        if (!filter_var(stripslashes($this->from_email),FILTER_VALIDATE_EMAIL)) {
            $this->input_alert .= 'error_notvalid_email&';
        }
    }   
    
    public function checkNameLength($min_length, $max_length)
    {
        if (!(strlen($this->from_name) >= $min_length) || !(strlen($this->from_name) <= $max_length)) {
            $this->input_alert .= 'error_length_name&';
        }
    }
    
    public function checkEmailLength($min_length, $max_length)
    {
        if (!(strlen($this->from_email) >= $min_length) || !(strlen($this->from_email) <= $max_length)) {
            $this->input_alert .= 'error_length_email&';
        }
    }
    
    public function createMailUser()
    {
        $client_mail_date = new DateTime();  
        $this->whole_message = 
                "Klienta vārds: " . $this->from_name . "\n" .
                "Klienta e-pasts: " . $this->from_email . "\n" .
                "Jautājums: " . $this->message . "\n" .
                "Laiks: " . $client_mail_date->format("d-m-Y H:i") . "\n" .
                "Jāatbilda klienta e-pastā 2 dienu laikā!";
        $this->headers = 
                'From: ' . '"Klienta jautājums" <contactform@paradiseplants.lv>' . "\r\n" .
                'Reply-To: ' . $this->from_email . "\r\n" .
                'X-Mailer: PHP/' . phpversion() . "\r\n" .
                'Content-type: text/plain; charset=iso-8859-1';
    }
    
    public function sendMailUser($redirect_address)
    {
        if ($this->input_alert !== null || !mail($this->to_email, $this->subject, $this->whole_message, $this->headers)) {
            $this->input_alert .= 'error_mail_send&uname=' . $this->from_name . '&uemail=' . $this->from_email . '&message=' . $this->message;
        } else {
            $this->input_alert .= 'success_mail_send&';
        }
        header("Location: $redirect_address?$this->input_alert");
    }
    
}
class MailFromAdmin extends Mail 
{
    
    private $from_file;
    private $file1;
    private $file0;
    
    public function __construct($from_email, $to_email, $subject, $message, $from_file)
    {
        parent::__construct($from_email, $message, $subject, $to_email);
        $this->from_file = $from_file;
    }
    
    public function filterSubject()
    {
        $this->subject = filter_var(stripslashes($this->subject), FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    } 
    
    public function filterEmailAdmin()
    {
        if (!filter_var(stripslashes($this->to_email),FILTER_VALIDATE_EMAIL)) {
            $this->input_alert .= 'error_notvalid_email&';
        }
    }
    
    public function checkSubjectLength($min_length, $max_length)
    {
        if (!(strlen($this->subject) >= $min_length) || !(strlen($this->subject) <= $max_length)) {
            $this->input_alert .= 'error_length_subject&';
        }
    }        
    
    public function checkEmailLength($min_length, $max_length)
    {
        if (!(strlen($this->to_email) >= $min_length) || !(strlen($to->from_email) <= $max_length)) {
            $this->input_alert .= 'error_length_email&';
        }
    }
    
    public function createMailAdmin()
    {
        if (empty($this->from_file['tmp_name'])) {
            $this->whole_message = $this->message;
            $this->headers = 
                    'From: ' . $this->from_email . "\r\n" .
                    'Reply-To: ' . $this->from_email . "\r\n" .
                    'X-Mailer: PHP/' . phpversion() . "\r\n" .
                    'Content-type: text/plain; charset=iso-8859-1';
        } else {
            self::fileHandler();
            self::createMailAdminFiles();
        }
    }
    
    public function fileHandler()
    {
        $path = $this->from_file['name'];
        if (copy($this->from_file['tmp_name'], $path)) $this->file1 = $path;
        $fp = fopen($this->file1,"r");
        if (!$fp) {
            print "Kļūda! Failu $this->file1 nevar nolasīt.";
            exit();
        }
        $this->file0 = fread($fp, filesize($this->file1));
        fclose($fp);
    }
    
    public function createMailAdminFiles()
    {
        $boundary = "--".md5(uniqid(time()));
        $this->headers = 'From: ' . $this->from_email . "\r\n" .
                            'Reply-To: ' . $this->from_email . "\r\n" .
                            'MIME-Version: 1.0' . "\r\n" .
                            "Content-Type: multipart/mixed; boundary=\"$boundary\"" . "\r\n";
        $this->whole_message = "--$boundary" . "\r\n" . 
                               "Content-Type: text/plain; charset=utf-8" . "\r\n" . 
                               "Content-Transfer-Encoding: Quot-Printed" . "\r\n" . "\r\n" .
                               $this->message . "\r\n" . "\r\n" .
                               "--$boundary" . "\r\n" .
                               "Content-Type: application/octet-stream" . "\r\n" .
                               "Content-Transfer-Encoding: base64" . "\r\n" .
                               "Content-Disposition: attachment; filename = \"".$this->file1."\"\r\n\r\n" . "\r\n" .
                               chunk_split(base64_encode($this->file0)) . "\r\n" .
                               "--$boundary--\n";
    }
    
    public function sendMailAdmin($redirect_address)
    {
        if ($this->input_alert !== null || !mail($this->to_email, $this->subject, $this->whole_message, $this->headers)) {
            $this->input_alert .= 'error_mail_send&to_email=' . $this->to_email . '&subject=' . $this->subject . '&message=' . $this->message;
        } else {
            $this->input_alert .= 'success_mail_send&';
        }
        header("Location: $redirect_address?$this->input_alert");
    }
}
       
        