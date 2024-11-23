"use_strict";

$(document).ready(function() {  
       
   //init
   $('#dt-popup-instansi').DataTable({
        responsive: true,                                
        searching: true,
        paging : true ,
        //scrollY: '40vh',
        //scrollCollapse: true,                            
        'ajax': base_url + 'reference/common/get_instansi_ref/'
   });  
      
    $('#btn_cari_ins').click( function () {
        $('#modal-instansi').modal('show');            
    });
                                     
});

function GetSelectedInstansi(id){           
    var obj = document.getElementById(id);
    var data = obj.getAttribute('data-select');        
    var dataArr = data.split(";");    
       
    if (dataArr.length > 0 ) {               
        $("#inst_id").val(dataArr[0]);  
        $("#inst_name").val(dataArr[1]);                  
        $("#inst_address").val(dataArr[2]);
        $("#inst_phone").val(dataArr[3]);
        $("#inst_fax").val(dataArr[4]);
        $("#inst_email").val(dataArr[5]);
        $("#inst_postcode").val(dataArr[6]);
        $("#inst_city").val(dataArr[7]); 
        
        if (dataArr[0] > 0) {
            $("#inst_address").prop('readonly', true);
            $("#inst_phone").prop('readonly', true);
            $("#inst_fax").prop('readonly', true);
            $("#inst_email").prop('readonly', true);
            $("#inst_postcode").prop('readonly', true);
            $("#inst_city").prop('readonly', true);
        }
    }                
    $('#modal-instansi').modal('hide');
}
 