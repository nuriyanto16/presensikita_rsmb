<?php
/** Author : KiQ 
   Created Date 2016.05.31 
   Modified Date 2016.05.31
**/
class Mailerfactory  
{
    static $ins = null;
	
    //const newline = "\r\n";   
    protected $obj; 
    
    public static function init($config)
    {
        require_once (APPPATH . "third_party/phpmailer/class.phpmailer.php");
        require_once (APPPATH . "third_party/phpmailer/class.smtp.php");

        //$this->obj =& get_instance();
        //$this->obj->load->config('email_cnf', TRUE); 
        
        if(self::$ins == null)
        {                    
            $smtpauth = false;
            if((int)$config['smtp_auth']==1) $smtpauth = true;
            $smtpuser 	= $config['smtp_user'];
            $smtppass  	= $config['smtp_pass'];
            $smtphost 	= $config['smtp_host'];
            $smtpsecure	= $config['smtp_secure']; // '' | 'tls' | 'ssl'
            $smtpport	= $config['smtp_port']; // 25 | 465 | 587
            $mailfrom 	= $config['smtp_user'];
            $fromname 	= $config['smtp_user_name'];
                        
            self::$ins = new PHPMailer();			
            self::$ins->IsSMTP();
            if($smtpauth=="0"){
                self::$ins->SMTPAuth = false;
            }else{
                self::$ins->SMTPAuth = true;
            }

            if($smtpsecure != ''){
                self::$ins->SMTPSecure = $smtpsecure;
            }

            self::$ins->Host = $smtphost;
            self::$ins->Port = $smtpport;
            self::$ins->Username = $smtpuser;
            self::$ins->Password = $smtppass;

            self::$ins->From = $mailfrom;
            self::$ins->FromName = $fromname;
            //self::$ins->WordWrap = 0;         
            self::$ins->IsHTML(true);			
        }
        return self::$ins;
    }		     
}

