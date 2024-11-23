
var dataTable;

$(document).ready(function() {
    
    var selected = [];  
    dataTable = $('#dt-list').DataTable({
        responsive: true,
        searching: true,
        paging: true,
        ordering: true,
        processing  : true,
        serverSide  : true,
        ajax : {
            url  : base_url + "utility/log_activity/getLists",
            type : "POST",
            cache : false,
            error: function(){  // error handling                
                $("#dt-list > tbody").append('<tr class="odd"><td valign="top" colspan="10" class="dataTables_empty">Data no available</td></tr>');
                $("#dt-list_processing").css("display","none");

            },
            complete: function() {
                $("#dt-list_processing").css("display","none");
            }
//            ,data   : function( d ) {
//                d.dofilter = $("#dofilter").val();
//                d.filter_cat_id= $("#filter_cat_id").val();
//                d.filter_access_id= $('#filter_access_id').val();                                
//                d.filter_status_id= $('#filter_status_id').val();                                
//            }
        },
        rowCallback: function(row, data, dataIndex){
             // Get row ID
             var rowId = data[0];
               
//             if($.inArray(rowId, selected) !== -1){
//               
//                $(row).addClass("selected");
//             }
        }
    });
    
    $('#dt-list tbody').on('click', 'tr', function(e){
       
//        var $row = $(this).closest('tr');
//
//        // Get row data
//        var data = dataTable.row($row).data();
//
//        // Get row ID
//        var rowId = data[0];
//
//        // Determine whether row ID is in the list of selected row IDs 
//        var index = $.inArray(rowId, selected);
// 
//        if ( index === -1 ) {
//            selected.push( rowId );
//        } else {
//            selected.splice( index, 1 );
//        }
// 
//            
//        $(this).toggleClass('selected');
    });
   
   

});

