<?php defined('BASEPATH') OR exit('No direct script access allowed.');

$config['useragent']        = 'CodeIgniter';              // Mail engine switcher: 'CodeIgniter' or 'PHPMailer'

$config['protocol']         = 'smtp';                   // 'mail', 'sendmail', or 'smtp'
$config['smtp_host']        = 'smtp.mailtrap.io'; // smtp.gmail.com, smtp.googlemail.com
$config['smtp_user']        = '9991b1c3329162';
$config['smtp_pass']        = 'cccb3d7be1f17a';
$config['smtp_port']        = 2525; // 25 , 587 , 465
$config['smtp_auth']        = true;                        // (in seconds)
$config['smtp_secure']      = '';                    // '' or 'tls' or 'ssl'

$config['word_wrap']        = 50;
$config['mailtype']         = 'html';                   // 'text' or 'html'
$config['charset']          = "utf-8";                     // 'UTF-8', 'ISO-8859-15', ...; NULL (preferable) means config_item('charset'), i.e. the character set of the site.
$config['priority']         = 2;                        // 1, 2, 3, 4, 5; on PHPMailer useragent NULL is a possible option, it means that X-priority header is not set at all, see https://github.com/PHPMailer/PHPMailer/issues/449
$config['newline']          = "\r\n";                     // "\r\n" or "\n" or "\r"
$config['content_type']     = "text/plain; charset=iso-8859-1";

$config['fromemail']        = 'notifikasi@pupuk-indonesia.com';
$config['fromname']         = 'DSM NO-REPLY';
$config['sitename']         = 'APLIKASI DSM';
$config['allow_sendmail']   = true;
 