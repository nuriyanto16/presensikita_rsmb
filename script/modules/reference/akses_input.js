"use strict";
$(document).ready(function () {
    // table akses_input_awal
    let dtList = new Tabulator("#dt-list", {
        columns: [{
                title: "#",
                field: "aksi",
                headerSort: false,
                formatter: "html",
                width: "10%"
            },
            {
                title: "Nama Periode",
                field: "periode_nama",
                sorter: "string",
                width: "40%"
            },
            {
                title: "Tanggal Mulai",
                field: "start_date",
                sorter: "string",
                width: "25%"
            },
            {
                title: "Tanggal Selesai",
                field: "end_date",
                sorter: "string",
                width: "25%"
            }
        ],
        locale: 'id',
        ajaxURL: base_url + "reference/masa_akses_input/lists",
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
                startRow = 0;
                endRow = 0;
            }
            let recordsFiltered = parseInt(response.recordsFiltered);
            let recordsTotal = parseInt(response.recordsTotal);

            $("#table-footer .tabulator-startrow").text(startRow);
            $("#table-footer .tabulator-endrow").text(endRow);
            $("#table-footer .tabulator-totalrow").text(recordsFiltered);

            let elTotalFilteredRow = $("#table-footer .tabulator-totalfilteredrow");
            elTotalFilteredRow.text("");
            if (recordsTotal > recordsFiltered) {
                elTotalFilteredRow.text(" (disaring dari " + recordsTotal +
                    " entri keseluruhan)");
            }
            return response;
        },
        footerElement: '<div id="table-footer" class="pull-left tabulator-info">' +
            'Menampilkan <span class="tabulator-startrow"></span> - <span class="tabulator-endrow"></span> dari ' +
            '<span class="tabulator-totalrow"></span> entri<span class="tabulator-totalfilteredrow"></span></div>',
        pagination: "remote",
        paginationSize: 25,
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
    // end table akses_input_awal

    // table _akses_risiko_awal_unlock
    let dtList2 = new Tabulator("#dt-list2", {
        columns: [{
                title: "#",
                field: "aksi",
                headerSort: false,
                formatter: "html",
                width: "10%"
            },
            {
                title: "Nama Periode",
                field: "periode_nama",
                sorter: "string",
                width: "30%"
            },
            {
                title: "Organisasi",
                field: "unitNama",
                sorter: "string",
                width: "30%"
            },
            {
                title: "Tanggal Mulai",
                field: "start_date",
                sorter: "string",
                width: "15%"
            },
            {
                title: "Tanggal Selesai",
                field: "end_date",
                sorter: "string",
                width: "15%"
            }
        ],
        locale: 'id',
        ajaxURL: base_url + "reference/masa_akses_input/lists2",
        ajaxConfig: "POST",
        ajaxSorting: true,
        ajaxFiltering: true,
        ajaxRequesting: function (url, params) {
            params.start = params.size * (params.page - 1);
            params.length = params.size;
        },
        ajaxResponse: function (url, params, response) {
            let pageSize = dtList2.getPageSize();
            let pageNo = dtList2.getPage();
            let startRow = (pageSize * (pageNo - 1)) + 1;
            let endRow = response.data.length + startRow - 1;
            if (response.data.length === 0) {
                startRow = 0;
                endRow = 0;
            }
            let recordsFiltered = parseInt(response.recordsFiltered);
            let recordsTotal = parseInt(response.recordsTotal);

            $("#table-footer2 .tabulator-startrow").text(startRow);
            $("#table-footer2 .tabulator-endrow").text(endRow);
            $("#table-footer2 .tabulator-totalrow").text(recordsFiltered);

            let elTotalFilteredRow = $("#table-footer2 .tabulator-totalfilteredrow");
            elTotalFilteredRow.text("");
            if (recordsTotal > recordsFiltered) {
                elTotalFilteredRow.text(" (disaring dari " + recordsTotal +
                    " entri keseluruhan)");
            }
            return response;
        },
        footerElement: '<div id="table-footer2" class="pull-left tabulator-info">' +
            'Menampilkan <span class="tabulator-startrow"></span> - <span class="tabulator-endrow"></span> dari ' +
            '<span class="tabulator-totalrow"></span> entri<span class="tabulator-totalfilteredrow"></span></div>',
        pagination: "remote",
        paginationSize: 25,
        paginationButtonCount: 10,
        paginationDataSent: {
            sorters: "order"
        },
        selectable: false
    });

    let searchThread2 = null;
    let elSearch2 = $("#tb-search2");
    if (elSearch2 != null) {
        elSearch2.keyup(function (e) {
            if ($(this).val().length < 3 && e.keyCode > 13) {
                return;
            }
            clearTimeout(searchThread2);
            searchThread2 = setTimeout(function () {
                dtList2.setFilter("", "like", elSearch2.val());
            }, 600);
        });
    }
    // end table _akses_risiko_awal_unlock

    // table _akses_risiko_monitoring_unlock
    let dtList3 = new Tabulator("#dt-list3", {
        columns: [{
                title: "#",
                field: "aksi",
                headerSort: false,
                formatter: "html",
                width: "10%"
            },
            {
                title: "Periode (Tahun)",
                field: "periode_nama",
                sorter: "string",
                width: "20%"
            },
            {
                title: "Periode (Bulan)",
                field: "periode_bulan",
                sorter: "string",
                width: "20%"
            },
            {
                title: "Organisasi",
                field: "unitNama",
                sorter: "string",
                width: "20%"
            },
            {
                title: "Tanggal Mulai",
                field: "start_date",
                sorter: "string",
                width: "15%"
            },
            {
                title: "Tanggal Selesai",
                field: "end_date",
                sorter: "string",
                width: "15%"
            }
        ],
        locale: 'id',
        ajaxURL: base_url + "reference/masa_akses_input/lists4",
        ajaxConfig: "POST",
        ajaxSorting: true,
        ajaxFiltering: true,
        ajaxRequesting: function (url, params) {
            params.start = params.size * (params.page - 1);
            params.length = params.size;
        },
        ajaxResponse: function (url, params, response) {
            let pageSize = dtList3.getPageSize();
            let pageNo = dtList3.getPage();
            let startRow = (pageSize * (pageNo - 1)) + 1;
            let endRow = response.data.length + startRow - 1;
            if (response.data.length === 0) {
                startRow = 0;
                endRow = 0;
            }
            let recordsFiltered = parseInt(response.recordsFiltered);
            let recordsTotal = parseInt(response.recordsTotal);

            $("#table-footer3 .tabulator-startrow").text(startRow);
            $("#table-footer3 .tabulator-endrow").text(endRow);
            $("#table-footer3 .tabulator-totalrow").text(recordsFiltered);

            let elTotalFilteredRow = $("#table-footer3 .tabulator-totalfilteredrow");
            elTotalFilteredRow.text("");
            if (recordsTotal > recordsFiltered) {
                elTotalFilteredRow.text(" (disaring dari " + recordsTotal +
                    " entri keseluruhan)");
            }
            return response;
        },
        footerElement: '<div id="table-footer3" class="pull-left tabulator-info">' +
            'Menampilkan <span class="tabulator-startrow"></span> - <span class="tabulator-endrow"></span> dari ' +
            '<span class="tabulator-totalrow"></span> entri<span class="tabulator-totalfilteredrow"></span></div>',
        pagination: "remote",
        paginationSize: 25,
        paginationButtonCount: 10,
        paginationDataSent: {
            sorters: "order"
        },
        selectable: false
    });

    let searchThread3 = null;
    let elSearch3 = $("#tb-search3");
    if (elSearch3 != null) {
        elSearch3.keyup(function (e) {
            if ($(this).val().length < 3 && e.keyCode > 13) {
                return;
            }
            clearTimeout(searchThread3);
            searchThread3 = setTimeout(function () {
                dtList3.setFilter("", "like", elSearch3.val());
            }, 600);
        });
    }
    // end table _akses_risiko_awal_unlock

    // refresh tabulator
    $("a[data-toggle='tab']").on('shown.bs.tab', function(e) {
        dtList.redraw(true);
        dtList2.redraw(true);
        dtList3.redraw(true);
    });

    $('#cari1').on('click', function(){
        var value = $('#company').val();
        if (value == 0) {
            dtList2.setFilter("", "like", "");
            return;
        }
        clearTimeout(searchThread2);
        searchThread2 = setTimeout(function () {
            dtList2.setFilter("", "like", "compId~"+value);
        }, 600);
    });

    $('#cari2').on('click', function(){
        var value = $('#company2').val();
        if (value == 0) {
            dtList3.setFilter("", "like", "");
            return;
        }
        clearTimeout(searchThread3);
        searchThread3= setTimeout(function () {
            dtList3.setFilter("", "like", "compId~"+value);
        }, 600);
    });

    // $(".pilih").select2(); 
});
