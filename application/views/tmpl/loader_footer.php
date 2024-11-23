<?php
if (isset($loadfoot['stylesheet']) && count($loadfoot['stylesheet']) > 0) {
    foreach ($loadfoot['stylesheet'] as $rel) {
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

if (isset($loadfoot['javascript']) && count($loadfoot['javascript']) > 0) {
    foreach ($loadfoot['javascript'] as $js) {
        print "<script type=\"text/javascript\" src=\"". $js ."\" ></script>";
    }
}

if (isset($loadfoot['tagjs']) && count($loadfoot['tagjs']) > 0) {
    foreach ($loadfoot['tagjs'] as $js) {
        print "<script type=\"text/javascript\">".$js."</script>";
    }
}

?>
 