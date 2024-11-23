<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class MY_Form_validation extends CI_Form_validation
{
    protected $CI;

    public function __construct($config = array())
    {
        parent::__construct($config);
        $this->CI =& get_instance();
    }

    function run($module = '', $group = '')
    {
        (is_object($module)) AND $this->CI = &$module;
        return parent::run($group);
    }

    /**
     * Is Unique Update
     *
     * @param $str
     * @param $field
     * @return bool
     */
    public function is_unique_update($str, $field){
        $explode=explode('@', $field);
        $field_name=$explode['0'];
        $field_id_key=$explode['1'];
        $field_id_value=$explode['2'];
        sscanf($field_name, '%[^.].%[^.]', $table, $field_name);

        if(isset($this->CI->db)){
            if($this->CI->db->limit(1)->get_where($table, array($field_name => $str,$field_id_key=>$field_id_value))->num_rows() === 0){
                $this->CI->form_validation->set_message('is_unique_update', 'The {field} field must contain a unique value.');
                return false;
            }
            return true;
        }
        return false;
    }

    /**
     * Is Uniqueq
     *
     * @param	string	$str
     * @param	string	$field
     * @return	bool
     */
    public function is_uniqueq($str, $field)
    {
        sscanf($field, '%[^.].%[^.]', $table, $field);
        if (isset($this->CI->db)){
            if ($this->CI->db->limit(1)->get_where($table, array($field => $str))->num_rows() > 0){
                $this->CI->form_validation->set_message('is_uniqueq', 'The {field} field must contain a unique value.');
                return false;
            }
            return true;
        }
        return false;
    }

    /**
     * Validate Date
     *
     * @param $date
     * @return bool
     */
    public function valid_date($date) {
        $d = DateTime::createFromFormat('d-m-Y', $date);
        return $d && $d->format('d-m-Y') === $date;
    }

    /**
     * Validate DateTime
     *
     * @param $datetime
     * @return bool
     */
    public function valid_datetime($datetime) {
        if (strlen($datetime) == 14) {
            $format = 'd-m-Y H:i';
        } else {
            $format = 'd-m-Y H:i:s';
        }
        $d = DateTime::createFromFormat($format, $datetime);
        return $d && $d->format($format) === $datetime;
    }
}
