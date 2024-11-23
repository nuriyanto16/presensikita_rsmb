"use strict";

$(document).ready(function() {  
       
   //init
    //$("select#photo").wSelect();
                                     
});

function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            document.getElementById("show_gambar").style.display="block";
            $('#show_gambar')
                .attr('src', e.target.result)
                .width(150);
                //console.log(input.files);
        };

        reader.readAsDataURL(input.files[0]);
    }
}
