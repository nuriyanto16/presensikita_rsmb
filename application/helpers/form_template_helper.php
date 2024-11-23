<?php defined('BASEPATH') OR exit('No direct script access allowed');

/* 
 * Custom form template to support bootstrap template.
 * 
 * @author Fazri <fazri@inov8-software.com>
 * @since 1.0
 */


if( !function_exists( 'radio_lists' ) ){
    
    function radio_lists($items){
        
        //echo '<div class="radio">';
        foreach($items as $item){
            echo '<label class="radio-inline">';
            echo form_radio($item['key']);
            echo $item['label'];
            echo '</label>';    
        }
        //echo '</div><!-- /.radio -->';
        
    }
    
}

if( !function_exists('render_inline_form') ){
    
    function render_inline_form( $items, $cols ){
        
        $col = explode(';', $cols);
        foreach( $items as $item ){
            
            $name = $item['default'];
            $label = $item['label'];
            $label_for = $item['name']; 
            $type = $item['type'];
            //$pass_length = $item['pass_length']?$item['pass_length']:'';
            $label_attr = array(
                            'class' => 'control-label col-md-'.$col[0]
                        );
            
            if(isset($item['pass_length'])){
                $pass_length = $item['pass_length'];
            }else{
                $pass_length = false;
            }
            
            echo '<div class="form-group">';
            
            echo lang( $label, $label_for, $label_attr );
            
            
            echo '<div class="col-md-'.$col[1].'">';
            
            switch($type){
                
                case 'text':
                    echo form_input($name);
                    break;
                
                case 'radio':
                    radio_lists($name);
                    break;
            }
            if(isset($item['desc'])){
                echo '<span class="help-block form-desc">'.sprintf($item['desc'],$pass_length).'</span>';
            }
            echo '</div><!-- /.col-md-'.$col[1].' -->';
            echo '</div><!-- /.form-group -->';
            
        }
        
    }
    
}



