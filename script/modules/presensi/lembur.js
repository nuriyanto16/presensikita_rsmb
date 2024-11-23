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

    build_company(0);

    dtList = new Tabulator("#dt-list", {
        rowFormatter:function(row){
            var dataRow = row.getData();
            if(dataRow.active == 0){
                row.getElement().style.backgroundColor = "#ff704d";
            }else{
                //row.getElement().style.backgroundColor = "#ff8533";
            }  
        },
        columns: [
            {
                title: "#", field: "aksi", headerSort: false, formatter: "html",
                width: "10%"
            },{
                title: "Unit<br/>Organisasi", field: "unit", sorter: "string",
                width: "15%", headerFilter: "input", formatter:"textarea"
            },{
                title: "Jabatan<br/>", field: "position", sorter: "string",
                width: "15%", headerFilter: "input", formatter:"textarea"
            },{
                title: "NIP<br/>&nbsp;", field: "nik_pegawai", sorter: "string",
                width: "15%", headerFilter: "input", align: "center"
            },{
                title: "Nama Pegawai<br/>&nbsp;", field: "emp_name", sorter: "string",
                width: "15%", headerFilter: "input", formatter:"textarea"
            },{
                title: "Tanggal <br/>", field: "tgl_awal_lembur", sorter: "string",
                width: "10%", headerFilter: "input", align: "center"
            },{
                title: "Jam <br/> Mulai", field: "wkt_awal", sorter: "string",
                width: "10%", headerFilter: "input", align: "center"
            },{
                title: "Jam <br/> Selesai", field: "wkt_akhir", sorter: "string",
                width: "10%", headerFilter: "input", align: "center"
            },{
                title: "Deskripsi Pekerjaan <br/>&nbsp;", field: "alasan_lembur", sorter: "string",
                width: "30%", headerFilter: "input", formatter:"textarea"
            },{
                title: "Status <br/>Pekerjaan", field: "desc_izin", sorter: "string",
                width: "13%", headerFilter: "input"
            },{
                title: "Status <br/>Atasan", field: "stat_pengajuan", sorter: "string",
                width: "10%", headerFilter: "input", formatter:"textarea",formatter:function(cell, formatterParams){
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
            },{
                title: "Status HO<br/>&nbsp;", field: "stat_pengajuan_ho", sorter: "string",
                width: "10%", headerFilter: "input", formatter:"textarea",formatter:function(cell, formatterParams){
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
        ajaxURL: base_url + "presensi/lembur/lists",
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
    // elFilterCompany.select2({
    //     placeholder: '- Pilih Instansi -'
    // });

    let btnFilter = $('#btnFilter');
    btnFilter.on('click', function (e) {
        e.preventDefault();
        dtList.setFilter("e.compid", "=", elFilterCompany.val());
    });

    let btnExport = $('#btnExport');
    btnExport.on('click', function (e) {

        var start_date = $('#start_date').val();
        var end_date = $('#end_date').val();   

        if(start_date == '' || end_date == ''){
            alert('Mohon diisi tanggal mulai & tanggal akhir');
        }else{
            var url = base_url + "presensi/lembur/getExportExcel/"+start_date+"/"+end_date;
            var win = window.open(url, '_blank');
            win.focus();
        }
        
    });

    function build_company(p_COMPID) {
        $.post(base_url + "reference/company/get_node_company", { COMPID: p_COMPID }, function (data) {
            let elParentUnitId = $("#filter_company");
            //elParentUnitId.html("");
            elParentUnitId.html('<option></option>');
            elParentUnitId.select2ToTree({
                treeData: {
                    dataArr: data,
                    valFld: "id",
                    labelFld: "compName",
                    incFld: "children",
                    dftVal: null
                },
                allowClear: false,
                placeholder: '- Pilih Instansi -',
                multiple: false,
                width: '100%'
            });
            elParentUnitId.val(elParentUnitId.attr('value')).trigger('change');
        }, "json");
    }


});
