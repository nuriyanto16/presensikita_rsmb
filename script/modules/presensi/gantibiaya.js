"use strict";
let dtList = null;
$(document).ready(function () {
    dtList = new Tabulator("#dt-list", {
        columns: [
            {
                title: "#", field: "aksi", headerSort: false, formatter: "html",
                width: "10%"
            },{
                title: "Perusahaan<br/>&nbsp;", field: "comp_name", sorter: "string",
                width: "20%", headerFilter: "input", formatter:"textarea"
            },{
                title: "Nama  Karyawan<br/>&nbsp;", field: "emp_name", sorter: "string",
                width: "15%", headerFilter: "input"
            },{
                title: "Tanggal <br/>Kuitansi", field: "tgl_kuitansi", sorter: "string",
                width: "10%", headerFilter: "input", align: "center"
            },{
                title: "Jenis <br/>Penggantian", field: "desc_gantib", sorter: "string",
                width: "12%", headerFilter: "input"
            },{
                title: "Keterangan <br/>&nbsp;", field: "ket_gantib", sorter: "string",
                width: "15%", headerFilter: "input", formatter:"textarea"
            },{
                title: "Nominal <br/>Kuitansi", field: "nom_kuitansi", sorter: "string",
                width: "10%", headerFilter: "input", 
            },{
                title: "Status <br/>&nbsp;", field: "stat_pengajuan", sorter: "string",
                width: "8%", headerFilter: "input", formatter:"textarea",formatter:function(cell, formatterParams){
                    var value = cell.getValue();
                    if(value == "DIAJUKAN"){
                        return "<span style='color:orange; font-weight:bold;'>" + value + "</span>";
                    }else if(value == "DISETUJUI"){
                        return "<span style='color:green; font-weight:bold;'>" + value + "</span>";
                    }else if(value == "DITOLAK"){
                        return "<span style='color:red; font-weight:bold;'>" + value + "</span>";
                    }else{
                        return value;
                    }
                }
            }
        ],
        locale: 'id',
        placeholder: "Tidak ada data",
        ajaxURL: base_url + "presensi/gantibiaya/lists",
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
        dtList.setFilter("e.compid", "=", elFilterCompany.val());
    });
});
