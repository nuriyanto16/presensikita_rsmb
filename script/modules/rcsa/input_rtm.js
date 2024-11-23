"use strict";
let dtList = null;

$(document).ready(function () {
    let monitoringIcon = function() {
        return "<button class='btn btn-sm btn-info'><i class='fa fa-eye'></i></button>";
    };

    dtList = new Tabulator("#dt-list", {
        columns: [
            {
                title: "#", field: "aksi", headerSort: false, formatter: "html",
                width: "9%", align: "center", cssClass: "text-center"
            },
            {
                title: "Periode", field: "periode_risiko_nama", sorter: "string",
                width: "8%", headerFilter: "input", align: "center", cssClass: "text-center"
            },
            {
                title: "Kode Risiko", field: "kode_risiko", sorter: "string",
                width: "15%", headerFilter: "input"
            },
            {
                title: "Tanggal", field: "rcsa_tgl", sorter: "date",
                width: "10%", align: "center", cssClass: "text-center"
            },
            {
                title: "Jenis Risiko", field: "jenis_risiko_nama", sorter: "string",
                width: "20%", headerFilter: "input"
            },
            {
                title: "Risiko", field: "risiko", sorter: "string",
                width: "25%", headerFilter: "input"
            },
            {
                title: "Status", cssClass: "text-center",
                columns: [{
                    title: "", field: "status_rcsa_nama", headerSort: false, sorter: "string",
                    width: "8%", align: "center", cssClass: "text-center"
                }, {
                    title: "#", headerSort: false, formatter: monitoringIcon,
                    width: "5%", align: "center", cssClass: "text-center",
                    cellClick: function (e, cell) {
                        $("input[name='rcsa_id']").val(cell.getRow().getData().id);
                        $("#modal_monitoring").modal("show");
                    }
                }]
            }
        ],
        locale: 'id',
        placeholder: "Tidak ada data",
        responsiveLayout:"collapse",
        ajaxURL: base_url + "rcsa/input_rtm/lists",
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

    let elFilterCompany = $('#filter_company');
    elFilterCompany.select2({
        placeholder: '- Pilih Company -'
    });

    let btnFilter = $('#btnFilter');
    btnFilter.on('click', function (e) {
        e.preventDefault();
        dtList.setFilter("a.comp_id", "=", elFilterCompany.val());
    });

    let dtListMonitoring = new Tabulator("#dt-listmonitoring", {
        columns: [
            {
                title: "No", formatter:"rownum", width: "5%",
                headerSort: false
            },
            {
                title: "Nama User", field: "user", sorter: "string",
                width: "20%", headerSort: false
            },
            {
                title: "Posisi", field: "position_desc", sorter: "string",
                width: "20%", headerSort: false
            },
            {
                title: "Organisasi", field: "unit_name", sorter: "string",
                width: "25%", headerSort: false
            },
            {
                title: "Tgl Approve", field: "rcsa_approve_tgl", sorter: "date",
                width: "15%", align: "center", cssClass: "text-center", headerSort: false
            },
            {
                title: "Status", field: "status", sorter: "string",
                width: "15%", align: 'center', cssClass: "text-center", headerSort: false
            },
            {
                title: "Keterangan", field: "catatan", sorter: "string",
                width: "15%", align: 'center', cssClass: "text-center", headerSort: false
            }
        ],
        locale: 'id',
        placeholder: "Tidak ada data",
        responsiveLayout:"collapse",
        ajaxURL: base_url + "rcsa/input_rtm/monitoring_lists",
        ajaxConfig: "POST",
        ajaxSorting: true,
        ajaxFiltering: true,
        ajaxRequesting: function (url, params) {
            params.start = params.size * (params.page - 1);
            params.length = params.size;
            params.id = $("input[name='rcsa_id']").val();
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
        selectable: false,
        rowFormatter:function(row){
            let data = row.getData();
            if (data.status === 'APPROVED'){
                //row.getElement().style.backgroundColor = "#A6A6DF";
                $(row.getElement()).addClass('success');
            } else if (data.status === 'REJECTED') {
                row.getElement().addClass('danger');
            } else if (data.blur) {
                $(row.getElement()).addClass('text-muted');
            } else {
                $(row.getElement()).addClass('info');
            }
        }
    });

    $('#modal_monitoring').on('shown.bs.modal', function() {
        dtListMonitoring.setData();
        dtListMonitoring.redraw(true);
    })
});
