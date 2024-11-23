"use strict";
let dtList = null;
$(document).ready(function () {

    $('#start_date').datepicker({
        autoclose: true,
        format: 'dd-mm-yyyy'
    });

    $('#end_date').datepicker({
        autoclose: true,
        format: 'dd-mm-yyyy'
    });

    dtList = new Tabulator("#dt-list", {
        columns: [
            {
                title: "#", field: "aksi", headerSort: false, formatter: "html",
                width: "10%"
            },
            {
                title: "NIK", field: "NIK", sorter: "string",
                width: "8%", headerFilter: "input"
            },
            {
                title: "Nama", field: "EMP_NAME", sorter: "string",
                width: "15%", headerFilter: "input"
            },
            {
                title: "Tanggal", field: "TGL_ABS", sorter: "string",
                width: "13%", headerFilter: "input", align : "left"
            },
            {
                title: "Masuk", field: "JAM_IN", sorter: "string",
                width: "7%", headerFilter: "input", align : "left"
            },
            {
                title: "Pulang", field: "JAM_OUT", sorter: "string",
                width: "7%", headerFilter: "input", align : "left"
            },
            {
                title: "Keterangan", field: "ABS_TYPE_DESC", sorter: "string",
                width: "10%", headerFilter: "input"
            },
            {
                title: "Posisi", field: "POSITION_DESC", sorter: "string",
                width: "15%", headerFilter: "input", formatter:"textarea"
            },
            {
                title: "Organisasi", field: "UNITNAME", sorter: "string",
                width: "15%", headerFilter: "input", formatter:"textarea"
            },
        ],
        locale: 'id',
        placeholder: "Tidak ada data",
        ajaxURL: base_url + "presensi/absensi/lists",
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
        dtList.setFilter("B.COMPID", "=", elFilterCompany.val());
    });
});
