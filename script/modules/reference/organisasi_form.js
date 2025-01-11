"use strict";
let dtList = null;
let dtListJadwal = null;

$(document).ready(function () {
    let elCompanyId = $("#COMPID");
    var elMultipleJadwal = $("#multiple_kode_unit");

    elCompanyId.select2({
        allowClear: false,
        placeholder: "- Pilih -"
    });
    elCompanyId.val(elCompanyId.attr('value')).trigger('change');
    elCompanyId.on('select2:select', function (e) {
        build_parent(e.params.data.id);
    });
    if (elCompanyId.val() !== "") build_parent();

    let elCostCenterCode = $("#costcenter_code");
    elCostCenterCode.select2({
        allowClear: true,
        placeholder: "- Pilih -"
    });
    elCostCenterCode.val(elCostCenterCode.attr('value')).trigger('change');

    function build_parent(p_COMPID) {
        if (p_COMPID == null) p_COMPID = elCompanyId.val();

        $.post(base_url + "reference/organisasi/get_node", { COMPID: p_COMPID }, function (data) {
            let elParentUnitId = $("#parentUnitId");
            //elParentUnitId.html("");
            elParentUnitId.html('<option></option>');
            elParentUnitId.select2ToTree({
                treeData: {
                    dataArr: data,
                    valFld: "id",
                    labelFld: "unitName",
                    incFld: "children",
                    dftVal: null
                },
                allowClear: false,
                placeholder: '- Pilih Parent -',
                multiple: false,
                width: '100%'
            });
            elParentUnitId.val(elParentUnitId.attr('value')).trigger('change');
        }, "json");
    }

    //initialize table
    // dtListJadwal = new Tabulator("#dt-listjadwal"
    dtListJadwal = new Tabulator("#dt-listjadwal", {
        height:500,
        columns: [{
                title: "ID TP", field: "id_tp", width: "100"
            },{
                title: "Deskripsi", field: "deskripsi",
                width: "220"
            },{
                title: "Kode", field: "kode", sorter: "string",
                width: "130"
            },{
                title: "Jam Masuk", field: "hari_1_jam_in",
                width: "100", align: "center", cssClass: "text-center"
            },{
                title: "Jam Pulang", field: "hari_1_jam_out", 
                width: "100", align: "center", cssClass: "text-center"
            },{
                title: "Action",
                field: "action",
                formatter: function (cell, formatterParams, onRendered) {
                    return "<button class='btn btn-danger'>Hapus</button>";
                },
                width: 100,
                align: "center",
                cellClick: function (e, cell) {
                    const row = cell.getRow(); // Mendapatkan baris terkait
                    row.delete(); // Menghapus baris

                    const allData = dtListJadwal.getData(); // Mendapatkan data semua baris
                    const id_tpList = allData.map(item => item.id_tp); // Mengambil id_tp dari setiap baris
    
                    // Jika ada lebih dari satu ID, gabungkan dengan tanda ';', jika tidak biarkan saja
                    const id_tpString = id_tpList.length > 1 ? id_tpList.join(';') : id_tpList[0];
    
                    elMultipleJadwal.val(id_tpString);
                    
                }
            }
        ],
        locale: 'id',
        placeholder: "Tidak ada data",
        ajaxURL: base_url + "reference/timeprofile/listsUnit",
        ajaxConfig: "POST",
        ajaxSorting: true,
        ajaxFiltering: true,
        ajaxRequesting: function (url, params) {
            params.start = params.size * (params.page - 1);
            params.length = params.size;
            params.listjadwal = elMultipleJadwal.val();
        },
        pagination: "remote",
        paginationSize: 20,
        paginationButtonCount: 7,
        paginationDataSent: {
            sorters: "order"
        },
        selectable: true,
    });

    //TABLE JADWAL
    dtList = new Tabulator("#dt-list", {
        height:500,
        columns: [
            {
                title: "Deskripsi", field: "deskripsi", sorter: "string",
                width: "220", headerFilter: "input"
            },{
                title: "Kode", field: "kode", sorter: "string",
                width: "130", headerFilter: "input"
            },{
                title: "Jam Masuk", field: "hari_1_jam_in", headerSort: false, sorter: "string",
                width: "100", align: "center", cssClass: "text-center"
            },{
                title: "Jam Pulang", field: "hari_1_jam_out", headerSort: false, sorter: "string",
                width: "100", align: "center", cssClass: "text-center"
            },
        ],
        locale: 'id',
        placeholder: "Tidak ada data",
        ajaxURL: base_url + "reference/timeprofile/lists",
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
        // selectable: true,
        rowClick:function(e, row){
            let rowData = row.getData();
            if (rowData !== null) {
                var stat_pop = parseInt($('#flag_pop').val());
                if(stat_pop === 0){
                    var combineTp = elMultipleJadwal.val() +";"+rowData.id_tp;
                    elMultipleJadwal.val(combineTp);
                    dtList.setFilter(
                        [
                            {field:"a.compid", type:"=", value:elCompanyId.val()}, 
                        ]
                    );
                    $('#modal_jadwal').modal('hide');                                  
                }else{


                    var combineTp = elMultipleJadwal.val() +";"+rowData.id_tp;
                    const cleanedIdTpString = combineTp.startsWith(';') ? combineTp.slice(1) : combineTp;

                    elMultipleJadwal.val(cleanedIdTpString);
                    dtListJadwal.replaceData();
                    $('#modal_jadwal').modal('hide');  
                }
            }
        }
    });


    //END TABLE JADWAL

    //CARI JADWAL
    $('#btn-carijadwal').on('click', function (e) {
        $('#flag_pop').val(0);
        $('#modal_jadwal').modal('show');
        dtList.setFilter(
            [
                {field:"a.compid", type:"=", value:elCompanyId.val()}, 
            ]
        );
    });
});
