<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Extended version of HTML helper.
 * 
 * @author Fazri Alfan Muaz 
 * @since 1.0
 */

function message_box( $title, $message, $mode='info', $icon='', $fadeout=false, $close=true ){
    
    $html = '';
    $html .= '<div class="alert alert-'.$mode;
    if($close){
        $html .=' alert-dismissible';
    }
    if($fadeout){
        $html .= ' fade in';
    }
    $html .= '">';
    
    if($close){
        $html .= '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>';
    }
    if( !empty($title)){
        $html .= '<h4>';
        if( !empty($icon) ){
            $html .= '<i class="icon fa fa-'.$icon.'"></i>'.nbs();
        }
        $html .= $title;
        $html .= '</h4>';
    }elseif (empty($title) && !empty($icon)){
        $html .= '<h4>';
        if( !empty($icon) ){
            $html .= '<i class="icon fa fa-'.$icon.'"></i>'.nbs();
        }
        $html .= '</h4>';        
    }
    $html .= $message;
    $html .= '</div><!-- /.alert -->';
    if($fadeout){
        $html .= '<script type="text/javascript">';
        $html .= 'window.setTimeout(function(){'
                . 'jQuery(".alert").alert(\'close\');'
                . '},3000);';
        $html .= '</script>';
    }
    
    return $html;
}

function btn_action_group($paramId, $edit_url='', $delete_url='', $att_other=null){
    $att = array(
        'data-toggle' => 'tooltip',
        'data-placement' => 'top',
    );
    $html = '';
    $html .= '<div class="btn-group">
                <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">
                    <i class="fa fa-gear"></i> Aksi <span class="caret"></span>
                </button>
                <ul class="dropdown-menu dropdown-menu-act" role="menu">';
                    $att=array();
                    if (is_array($edit_url)){
                        $html .='<li>';                    
                        $att['title'] = $edit_url['title'];
                        $att['class'] = $edit_url['class'];
                        if (isset($edit_url['onclick']))
                            $att['onclick'] = $edit_url['onclick'];
                        if ($edit_url['url'] != "" && $edit_url['url'] !="#")
                            $edit_url['url'] .= $paramId;
                        $html .=  anchor($edit_url['url'], '<i class="fa fa-fw fa-edit"></i>Edit',$att);                            
                        $html .='</li>';
                    }elseif ($edit_url != "") {
                        $html .='<li>';                    
                        $att['title'] = 'Edit';
                        $att['class'] = 'editButton';                       
                        if ($edit_url != "" && $edit_url !="#")
                            $edit_url .= $paramId;
                        $html .=  anchor($edit_url, '<i class="fa fa-fw fa-edit"></i>Edit',$att);
                        $html .='</li>';
                    }
                    
                    $att=array();
                    if (is_array($delete_url)) {
                        $html .='<li>';                    
                        $att['title'] =  $delete_url['title'];
                        $att['class'] = $delete_url['class'];
                        if (isset($delete_url['onclick']))
                            $att['onclick'] = $delete_url['onclick'];
                        else
                            $att['onclick'] = "return confirm('Hapus data ini ?');";
                        
                        if ($delete_url['url'] != "" && $delete_url['url'] !="#")
                            $delete_url['url'] .= $paramId;
                        $html .=  anchor($delete_url['url'], '<i class="fa fa-fw fa-trash"></i>Hapus',$att);                            
                        $html .='</li>';
                    }elseif ($delete_url != "" ) {                                               
                        $html .='<li>';                    
                        $att['title'] = 'Hapus';
                        $att['class'] = 'deleteButton';
                        $att['onclick'] = "return confirm('Hapus data ini ?');";
                        if ($delete_url != "" && $delete_url !="#")
                            $delete_url .= $paramId;
                        $html .=  anchor($delete_url, '<i class="fa fa-fw fa-trash"></i>Hapus',$att);                            
                        $html .='</li>';
                    }
                    
                    $att=array();
                    if (!empty($att_other) && is_array($att_other)) {
                        $html .='<li>';                    
                        $att['title'] = $att_other['title'];
                        $att['class'] = $att_other['class'];
                        if (isset($att_other['onclick']))
                            $att['onclick'] = $att_other['onclick'];
                        if (isset($att_other['target']))
                            $att['target'] = $att_other['target'];
                                                
                        if ($att_other['url'] != "" && $att_other['url'] !="#")
                            $att_other['url'] .= $paramId;
                        if (isset($att_other['icon_class']))
                            $html .=  anchor($att_other['url'], '<i class="fa fa-fw '.$att_other['icon_class'].'"></i>'.$att_other['title'],$att);
                        else
                            $html .=  anchor($att_other['url'], '<i class="fa fa-fw fa-external-link"></i>'.$att_other['title'],$att);
                        $html .='</li>';
                    }
    $html .= '  </ul>
            </div>';
    
    return $html;
}

function btn_action_groupjm($paramId, $edit_url='', $delete_url='', $view_url='', $att_other=null, $att_other2=null){
    $att = array(
        'data-toggle' => 'tooltip',
        'data-placement' => 'top',
    );
    $html = '';
    $html .= '<div class="btn-group">
                <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">
                    <i class="fa fa-gear"></i> Aksi <span class="caret"></span>
                </button>
                <ul class="dropdown-menu dropdown-menu-act" role="menu">';
                    $att=array();
                    if (is_array($edit_url)){
                        $html .='<li>'; 
                        $att['title'] = $edit_url['title'];
                        $att['class'] = $edit_url['class'];
                        if (isset($edit_url['onclick']))
                            $att['onclick'] = $edit_url['onclick'];
                        if ($edit_url['url'] != "" && $edit_url['url'] !="#")
                            $edit_url['url'] .= $paramId;
                        $html .=  anchor($edit_url['url'], '<i class="fa fa-fw fa-edit"></i>Edit',$att);                            
                        $html .='</li>';
                    }elseif ($edit_url != "") {
                        $html .='<li>';                    
                        $att['title'] = 'Edit';
                        $att['class'] = 'editButton';                       
                        if ($edit_url != "" && $edit_url !="#")
                            $edit_url .= $paramId;
                        $html .=  anchor($edit_url, '<i class="fa fa-fw fa-edit"></i>Edit',$att);
                        $html .='</li>';
                    }
                    
                    $att=array();
                    if (is_array($delete_url)) {
                        $html .='<li>';                    
                        $att['title'] =  $delete_url['title'];
                        $att['class'] = $delete_url['class'];
                        if (isset($delete_url['onclick']))
                            $att['onclick'] = $delete_url['onclick'];
                        else
                            $att['onclick'] = "return confirm('Hapus data ini ?');";
                        
                        if ($delete_url['url'] != "" && $delete_url['url'] !="#")
                            $delete_url['url'] .= $paramId;
                        $html .=  anchor($delete_url['url'], '<i class="fa fa-fw fa-trash"></i>Hapus',$att);                            
                        $html .='</li>';
                    }elseif ($delete_url != "" ) {                                               
                        $html .='<li>';                    
                        $att['title'] = 'Hapus';
                        $att['class'] = 'deleteButton';
                        $att['onclick'] = "return confirm('Hapus data ini ?');";
                        if ($delete_url != "" && $delete_url !="#")
                            $delete_url .= $paramId;
                        $html .=  anchor($delete_url, '<i class="fa fa-fw fa-trash"></i>Hapus',$att);                            
                        $html .='</li>';
                    }
                    
                    $att=array();
                    if (is_array($view_url)){
                        $html .='<li>';                    
                        $att['title'] = $view_url['title'];
                        $att['class'] = $view_url['class'];
                        if (isset($view_url['onclick']))
                            $att['onclick'] = $view_url['onclick'];
                        if ($view_url['url'] != "" && $view_url['url'] !="#")
                            $view_url['url'] .= $paramId;
                        $html .=  anchor($view_url['url'], '<i class="fa fa-fw fa-eye"></i>Lihat',$att);                            
                        $html .='</li>';
                    }elseif ($view_url != "") {
                        $html .='<li>';                    
                        $att['title'] = 'Lihat';
                        $att['class'] = '';                       
                        if ($view_url != "" && $view_url !="#")
                            $view_url .= $paramId;
                        $html .=  anchor($view_url, '<i class="fa fa-fw fa-eye"></i>Edit',$att);
                        $html .='</li>';
                    }
                    
                    $att=array();
                    if (!empty($att_other) && is_array($att_other)) {
                        $html .='<li>';                    
                        $att['title'] = $att_other['title'];
                        $att['class'] = $att_other['class'];
                        if (isset($att_other['onclick']))
                            $att['onclick'] = $att_other['onclick'];
                                                
                        if (($att_other['url'] != "" && $att_other['url'] !="#") OR strtolower(substr($att_other['url'],0,8))== "javascript") {
                            //$att_other['url'] .= $paramId;
                              $html .=  '<a href="'.$att_other['url'].'" title="'.$att['title']. '" class="'.$att['class'].'" '.(isset($att['onclick']) ? 'onclick="'.$att['onclick'].'"' : '').'>'.
                                        '<i class="fa fa-fw '.$att_other['icon_class'].'"></i>'.$att_other['title'].
                                        '</a>';
                            //anchor($att_other['url'], '<i class="fa fa-fw '.$att_other['icon_class'].'"></i>'.$att_other['title'],$att);
                        }else {
                            if (isset($att_other['icon_class']))
                                $html .=  anchor($att_other['url'], '<i class="fa fa-fw '.$att_other['icon_class'].'"></i>'.$att_other['title'],$att);
                            else
                                $html .=  anchor($att_other['url'], '<i class="fa fa-fw fa-external-link"></i>'.$att_other['title'],$att);
                        }
                        $html .='</li>';
                    }

                    $att=array();
                    if (!empty($att_other2) && is_array($att_other2)) {
                        $html .='<li>';
                        $att['title'] = $att_other2['title'];
                        $att['class'] = $att_other2['class'];

                        if (isset($att_other2['onclick']))
                            $att['onclick'] = $att_other2['onclick'];

                        if (($att_other2['url'] != "" && $att_other2['url'] !="#") OR strtolower(substr($att_other2['url'],0,8))== "javascript") {
                            $att_other2['url'] .= $paramId;
                            $html .=  '<a href="'.$att_other2['url'].'" title="'.$att['title']. '" class="'.$att['class'].'" '.(isset($att['onclick']) ? 'onclick="'.$att['onclick'].'"' : '').'>'.
                                '<i class="fa fa-fw '.$att_other2['icon_class'].'"></i>'.$att_other2['title'].
                                '</a>';
                        } else {
                            if (isset($att_other2['icon_class']))
                                $html .=  anchor($att_other2['url'], '<i class="fa fa-fw '.$att_other2['icon_class'].'"></i>'.$att_other2['title'],$att);
                            else
                                $html .=  anchor($att_other2['url'], '<i class="fa fa-fw fa-external-link"></i>'.$att_other2['title'],$att);
                        }
                        $html .='</li>';
                    }
    $html .= '  </ul>
            </div>';
    
    return $html;
}

function getBulan($bln){
    switch ($bln){
        case 1: 
            return "Januari";
            break;
        case 2:
            return "Februari";
            break;
        case 3:
            return "Maret";
            break;
        case 4:
            return "April";
            break;
        case 5:
            return "Mei";
            break;
        case 6:
            return "Juni";
            break;
        case 7:
            return "Juli";
            break;
        case 8:
            return "Agustus";
            break;
        case 9:
            return "September";
            break;
        case 10:
            return "Oktober";
            break;
        case 11:
            return "November";
            break;
        case 12:
            return "Desember";
            break;
    }
}
