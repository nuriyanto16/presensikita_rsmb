"use strict";
let dtList = null;

$(document).ready(function () {
    $('.allownumericwithdecimal').keyup(function () { 
        this.value = this.value.replace(/[^0-9\.-]/g,'');
    });

        //ATASAN LANGSUNG
    $('#btn-caripejabat').on('click', function (e) {
        $('#modal_peserta').modal('show');
    });


    //List Karyawan
    dtList = new Tabulator("#dt-list", {
        columns: [
            {
                title: "NIK", field: "nik", sorter: "string",
                width: "10%", headerFilter: "input"
            },
            {
                title: "Nama", field: "emp_name", sorter: "string",
                width: "24%", headerFilter: "input"
            },
            {
                title: "Email", field: "email", sorter: "string",
                width: "20%", headerFilter: "input"
            },
            {
                title: "Posisi", field: "position_desc", sorter: "string",
                width: "23%", headerFilter: "input"
            },
            {
                title: "Organisasi", field: "unitName", sorter: "string",
                width: "23%", headerFilter: "input"
            }
        ],
        locale: 'id',
        placeholder: "Tidak ada data",
        ajaxURL: base_url + "reference/employee/lists",
        ajaxConfig: "POST",
        ajaxSorting: true,
        ajaxFiltering: true,
        ajaxRequesting: function (url, params) {
            params.start = params.size * (params.page - 1);
            params.length = params.size;
        },
        ajaxResponse: function (url, params, response) {
            let pageSize = dtList.getPageSize();
            let pageNo = dtList.getPage();
            let startRow = (pageSize * (pageNo - 1)) + 1;
            let endRow = response.data.length + startRow - 1;
            if (response.data.length === 0) {
                startRow = 0; endRow = 0;
            }
            let recordsFiltered = parseInt(response.recordsFiltered);
            let recordsTotal = parseInt(response.recordsTotal);

            $("#table-footer .tabulator-startrow").text(startRow);
            $("#table-footer .tabulator-endrow").text(endRow);
            $("#table-footer .tabulator-totalrow").text(recordsFiltered);

            let elTotalFilteredRow = $("#table-footer .tabulator-totalfilteredrow");
            elTotalFilteredRow.text("");
            if (recordsTotal > recordsFiltered) {
                elTotalFilteredRow.text(" (disaring dari " + recordsTotal
                    + " entri keseluruhan)");
            }
            return response;
        },
        footerElement: '<div id="table-footer" class="pull-left tabulator-info">'
        + 'Menampilkan <span class="tabulator-startrow"></span> - <span class="tabulator-endrow"></span> dari '
        + '<span class="tabulator-totalrow"></span> entri<span class="tabulator-totalfilteredrow"></span></div>',
        pagination: "remote",
        paginationSize: 10,
        paginationButtonCount: 7,
        paginationDataSent: {
            sorters: "order"
        },
        selectable: true,
        rowClick:function(e, row){
            let rowData = row.getData();
            if (rowData !== null) {
                $('#NIK_ATASAN_HO').val(rowData.nik);
                $('#NAMA_ATASAN_HO').val(rowData.emp_name); 
                $('#modal_peserta').modal('hide');                 
            }
        }
    });
    //ATASAN LANGSUNG

});
