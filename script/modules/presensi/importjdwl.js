"use strict";
let dtList = null;
$(document).ready(function () {

    // Ketika tombol dengan id 'btnShowModal' diklik
    $(document).on('click', '.btnShowModal', function() {
        // Mendapatkan ID dari tombol yang diklik
        var unitId = $(this).data('id');
        var unitName = $(this).data('unit-name');

        // Set ID unit yang dipilih pada form
        $('#kdunit').val(unitId);  // Set ID unit ke input form "kdunit"
        $('#namaunit').val(unitName);  // Set ID unit ke input form "unitName"
        
        // Menampilkan modal
        $('#parameterModaljadwal').modal('show');
    }); 
        

    dtList = new Tabulator("#dt-list", {
        columns: [
            {
                title: "Kode", field: "unitCode", sorter: "string",
                width: "10%", headerFilter: "input"
            },
            {
                title: "Nama", field: "unitName", sorter: "string",
                width: "70%", headerFilter: "input"
            },
            {
                title: "#", field: "aksi", headerSort: false, formatter: "html",
                width: "20%", align: "center", cssClass: "text-center"
            },
        ],
        locale: 'id',
        placeholder: "Tidak ada data",
        height: '700px',
        ajaxURL: base_url + "presensi/importjdwl/lists",
        ajaxConfig: "POST",
        ajaxSorting: true,
        ajaxFiltering: true,
        ajaxRequesting: function (url, params) {
            params.start = params.size * (params.page - 1);
            params.length = params.size;
            params.comp_id = elFilterCompany.val();
        },
        dataTree: true,
        dataTreeChildField: "children",
        dataTreeChildIndent: 20,
        // footerElement: '<div id="table-footer" class="pull-left tabulator-info">'
        // + 'Menampilkan <span class="tabulator-startrow"></span> - <span class="tabulator-endrow"></span> dari '
        // + '<span class="tabulator-totalrow"></span> entri<span class="tabulator-totalfilteredrow"></span></div>',
        pagination: "remote",
        paginationSize: 9999,
        paginationButtonCount: 10,
        paginationDataSent: {
            sorters: "order"
        },
        selectable: false
    });

    let searchThread = null;
    let elSearch = $("#tb-search");
    if (elSearch != null) {
        elSearch.keyup(function (e) {
            if ($(this).val().length < 3 && e.keyCode > 13) {
                return;
            }
            clearTimeout(searchThread);
            searchThread = setTimeout(function () {
                dtList.setFilter("", "like", elSearch.val());
            }, 600);
        });
    }

    let elFilterCompany = $('#filter_company');
    elFilterCompany.select2({
        placeholder: '- Pilih Company -'
    });

    let btnFilter = $('#btnFilter');
    btnFilter.on('click', function (e) {
        e.preventDefault();
        dtList.setFilter("u.COMPID", "=", elFilterCompany.val());
    });

    dtList.setData();



    $('#parameterForm').on('submit', function (e) {
        e.preventDefault(); // Menghindari refresh halaman

        // Menampilkan loading
        $('#loading').show();
        
        var formData = new FormData();
        formData.append('periode_id', $('#periode_id').val());
        formData.append('bulan_id', $('#bulan_id').val());
        formData.append('kdunit', $('#kdunit').val());
        formData.append('file', $('#fileUpload')[0].files[0]);

        $.ajax({
            url: base_url + "presensi/importjdwl/uploadjadwal",  // Ganti dengan URL endpoint An
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function (response) {
                $('#loading').hide(); // Menyembunyikan loading
                if (response.success) {
                    alert('Data berhasil diimpor: ' + response.message);
                    $('#parameterModaljadwal').modal('hide');  // Menutup modal setelah sukses
                } else {
                    alert('Terjadi kesalahan: ' + response.message);
                }
            },
            error: function () {
                $('#loading').hide();
                alert('Gagal mengirim data, coba lagi.');
            }
        });
    });
    




});




