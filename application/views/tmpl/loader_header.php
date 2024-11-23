<?php
  
if (isset($loadhead['stylesheet']) && count($loadhead['stylesheet']) > 0) {
    
    
    foreach ($loadhead['stylesheet'] as $rel) {
        $media = explode("|",$rel);
        if (count($media) > 1){
            if ($media[1] == "m:screen"){
                print "<link rel=\"stylesheet\" href=\"". $media[0] ."\" type=\"text/css\" media=\"screen\" />";
            }
        }else{
            print "<link rel=\"stylesheet\" href=\"".$rel ."\" type=\"text/css\" />";
        }
    }
}

if (isset($loadhead['javascript']) && count($loadhead['javascript']) > 0) {
    foreach ($loadhead['javascript'] as $js) {
        print "<script type=\"text/javascript\" src=\"". $js ."\" ></script>";
    }
}

?>
