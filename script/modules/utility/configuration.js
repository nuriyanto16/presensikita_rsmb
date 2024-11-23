var dataTable;

$(document).ready(function() {
    
    var selected = [];  
    dataTable = $('#dt-configuration').DataTable({
        language : {
            emptyTable  : "Tidak ada data yang ditemukan",
            lengthMenu  : "Tampil _MENU_",
            zeroRecords : "Tidak ditemukan - Maaf",
            info        : "Menampilkan halaman _PAGE_ dari _PAGES_",
            infoEmpty   : "Tidak ada catatan yang tersedia",
            infoFiltered: "(disaring dari _MAX_ catatan total)",
            search      : "Cari"
        },
        paginate: {
            Next        : 'Selanjutnya',
            Last        : 'Terakhir',
            First       : 'Pertama',
            Previous    : 'Sebelumnya'
        },
        lengthMenu  : [[25, 50, 75, 100, -1], [25, 50, 75, 100, "Semua"]],
        responsive: true,
        searching: true,
        paging: true,
        ordering: true,
        processing  : true,
        serverSide  : true,
        ajax : {
            url  : base_url + "utility/configuration/getLists",
            type : "POST",
            cache : false,
            error: function(){  // error handling                
                $("#dt-configuration > tbody").append('<tr class="odd"><td valign="top" colspan="10" class="dataTables_empty">Data no available</td></tr>');
                $("#dt-configuration_processing").css("display","none");

            },
            complete: function() {
                $("#dt-list_processing").css("display","none");
            }
        },
        rowCallback: function(row, data, dataIndex){
             // Get row ID
             var rowId = data[0];
        }
    });
    
    $('#dt-configuration tbody').on('click', 'tr', function(e){
    });
   
   

});


