<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

include_once APPPATH.'/third_party/mpdf-7.0.0/autoload.php';

use Mpdf\Mpdf;

class M_pdf
{
   
    public $pdf;
 
    public function __construct()
    {
        $CI = &get_instance();
        //$this->pdf = new Mpdf($params);
    }
    
    function load($param = NULL)
    {
       
        if ($param == NULL) {
            $param = [
                'mode' => 'utf-8', 
                'format' => 'A4', 
                'default_font_size' => 0,
                'default_font' => 'myriadpro',
                'margin_left' => 0,
                'margin_right' => 0,
                'margin_top' => 6,
                'margin_bottom' => 12,
                'margin_header' => 0,
                'margin_footer' => 0,
                'orientation' => 'P'
            ];
        }
     
        return new Mpdf($param);
    }
}


