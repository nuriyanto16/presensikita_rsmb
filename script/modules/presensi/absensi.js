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
                title: "NIK", field: "nik", sorter: "string",
                width: "8%", headerFilter: "input"
            },
            {
                title: "Nama", field: "emp_name", sorter: "string",
                width: "15%", headerFilter: "input"
            },
            {
                title: "Tanggal", field: "tanggal", sorter: "string",
                width: "13%", headerFilter: "input", align : "left"
            },
            {
                title: "Tgl Finger", field: "tglfinger", sorter: "string",
                width: "13%", headerFilter: "input", align : "left"
            },
            {
                title: "Posisi", field: "position_desc", sorter: "string",
                width: "15%", headerFilter: "input", formatter:"textarea"
            },
            {
                title: "Unit Kerja", field: "unitname", sorter: "string",
                width: "15%", headerFilter: "input", formatter:"textarea"
            },
            {
                title: "FID", field: "fid", sorter: "string",
                width: "10%", headerFilter: "input", align : "left"
            },
            {
                title: "Machine ID", field: "machine_id", sorter: "string",
                width: "10%", headerFilter: "input", align : "left"
            },
            {
                title: "IP Machine", field: "ip", sorter: "string",
                width: "10%", headerFilter: "input", align : "left"
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

    // let btnFilter = $('#btnFilter');
    // btnFilter.on('click', function (e) {
    //     e.preventDefault();
    //     dtList.setFilter("b.compid", "=", elFilterCompany.val());
    // });
});
