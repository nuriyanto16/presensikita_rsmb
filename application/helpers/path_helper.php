<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * 
 */
if ( !function_exists('asset_url') ){
    function assets_url($dir = null){
        // the helper function doesn't have access to $this, so we need to get a reference to the
        // CodeIgniter instance.  We'll store that reference as $CI and use it instead of $this
        $CI =& get_instance();

        // return the asset_url
        if( !empty( $dir ) ){
            return base_url() . $CI->config->item('assets_path') . $dir .'/';
        }else{
            return base_url() . $CI->config->item('assets_path');
        }
        
    }
}

if ( !function_exists('base_url_index') ){
    function base_url_index(){        
        //$CI =& get_instance();
        return base_url() . index_page();        
    }
}

if ( !function_exists('check_dir_repo') ){
    function check_dir_repo($jenis, $uploadpath, $inst_dir, $unit_dir, $jsn_dir){ 
        $CI =& get_instance();
        $_instdir="";
        $_unitdir="";
        $_jsndir="";
        if ($jenis == "statis"){
            $_instdir = $uploadpath."statis/".$inst_dir;
            //--=== directori instansi atau OPD
            if (realpath($_instdir) !== FALSE)
            {
                $_instdir = str_replace('\\', '/', realpath($_instdir));
            }
            if ( ! is_dir($_instdir))
            {
                // EDIT: make directory and try again
                if ( ! mkdir ($_instdir, 0777, TRUE))
                {                 
                    $error = 'upload_opddir_no_filepath';
                    return FALSE;
                }
            }
            if ( ! is_really_writable($_instdir))
            {
                // EDIT: change directory mode
                if ( ! chmod($_instdir, 0774)) // 0777
                {
                    $error = 'upload_opddir_not_writable';
                    return FALSE;
                }
            }
            $_instdir = preg_replace('/(.+?)\/*$/', '\\1/',  $_instdir);
            
            
            //--=== directori unit pengelola
            $_unitdir = $_instdir . $unit_dir;
            if (realpath($_unitdir) !== FALSE)
            {
                $_unitdir = str_replace('\\', '/', realpath($_unitdir));
            }
            if ( ! is_dir($_unitdir))
            {
                // EDIT: make directory and try again
                if ( ! mkdir ($_unitdir, 0777, TRUE))
                {                 
                    $error = 'upload_unitdir_no_filepath';
                    return FALSE;
                }
            }
            if ( ! is_really_writable($_unitdir))
            {
                // EDIT: change directory mode
                if ( ! chmod($_unitdir, 0774)) // 0777
                {
                    $error = 'upload_unitdir_not_writable';
                    return FALSE;
                }
            }
            $_unitdir = preg_replace('/(.+?)\/*$/', '\\1/',  $_unitdir);
            
            
            //--=== directori jenis naskah
            $_jsndir = $_unitdir . $jsn_dir;
            if (realpath($_jsndir) !== FALSE)
            {
                $_jsndir = str_replace('\\', '/', realpath($_jsndir));
            }
            if ( ! is_dir($_jsndir))
            {
                // EDIT: make directory and try again
                if ( ! mkdir ($_jsndir, 0777, TRUE))
                {                 
                    $error = 'upload_jsndir_no_filepath';
                    return FALSE;
                }
            }
            if ( ! is_really_writable($_jsndir))
            {
                // EDIT: change directory mode
                if ( ! chmod($_jsndir, 0774)) // 0777
                {
                    $error = 'upload_jsndir_not_writable';
                    return FALSE;
                }
            }
            $_jsndir = preg_replace('/(.+?)\/*$/', '\\1/',  $_jsndir);
            
        }
        
        return TRUE;
    }
}

if ( !function_exists('make_repo_path') ){
    /**
        Make a nested path , creating directories down the path
        Recursion !!
    */
    function make_repo_path($path)
    {
        $dir = pathinfo($path , PATHINFO_DIRNAME);
        
        if (realpath($dir) !== FALSE)
        {
            $dir = str_replace('\\', '/', realpath($dir));
        }
        
        if( is_dir($dir) )
        {
            return true;
        }
        else
        {
            if( make_repo_path($dir) )
            {
                //if( mkdir($dir) )
                if ( mkdir ($dir, 0774, TRUE))
                {
                    chmod($dir , 0774);
                    return true;
                }
            }
        }

        return false;
    }
}

function debug_var($vars){
    
    echo '<pre>';
    var_dump($vars);
    echo '</pre>';
    
}
?>
