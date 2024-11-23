<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Class Qsecure
 * @author MST
 */
class Qsecure
{
    private $skey = 'f873ec29d83d9aa3b50cc818fe9e2069';

    function __construct()
    {
        $this->ci =& get_instance();
        $this->ci->load->library('encryption');
        $this->ci->encryption->initialize(
            array(
                'cipher' => 'aes-128',
                'mode' => 'cbc',
                'key' => hex2bin($this->skey)
            )
        );
    }

    public function safe_b64encode($string)
    {
        $data = str_replace(array('+', '/', '='), array('-', '_', ''), $string);
        return $data;
    }

    public function safe_b64decode($string)
    {
        $data = str_replace(array('-', '_'), array('+', '/'), $string);
        $mod4 = strlen($data) % 4;
        if ($mod4) {
            $data .= substr('====', $mod4);
        }
        return $data;
    }

    public function encrypt($value)
    {
        if (!$value) return false;

        $crypttext = $this->ci->encryption->encrypt($value);
        return trim($this->safe_b64encode($crypttext));
    }

    public function decrypt($value)
    {
        if (!$value) return false;

        $crypttext = $this->safe_b64decode($value);
        return $this->ci->encryption->decrypt($crypttext);
    }
}
