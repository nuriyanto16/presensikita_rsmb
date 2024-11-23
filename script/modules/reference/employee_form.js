"use strict";

var dataTimeProfile = [];
var dataTimeProfileModul = [];

var dataKeluarga= [];
var dataKeluargaModul = [];

var dataCutiAdjustment= [];
var dataCutiAdjustmentModul = [];
let dtListHistory =  null;

let dtList = null;

$(document).ready(function () {
    let elCompanyId = $("#COMPID");
    let elPositionCode = $("#position_code");
    let elUnitId = $("#unitId");
    let elKantorId = $("#kantor_id");
    let eljnskelaminId = $("#jns_kelamin");
    let elreligionId = $("#religion_id");
    let elstatusId = $("#status_nikah");
    let eljadwalId = $("#id_tp");

    let elPeriodeId = $("#periode_id");
    let elbulanId = $("#bulan_id");

    //List Jadwal 
    dtListHistory = new Tabulator("#dt-listjadwal", {
        height:"100%",
        columns: [{
                title: "Tanggal", field: "tanggal", sorter: "string",
                width: "100", align: "left"
            },{
                title: "Kode Jadwal", field: "kode", sorter: "string",
                width: "200", align: "left"
            },{
                title: "Keterangan", field: "deskripsi", sorter: "string",
                width: "300", align: "left"
            },{
                title: "Jadwal Masuk", field: "hari_1_jam_in", headerSort: false, sorter: "string",
                width: "200", align: "center", cssClass: "text-center"
            },{
                title: "Jadwal Pulang", field: "hari_1_jam_out", headerSort: false, sorter: "string",
                width: "200", align: "center", cssClass: "text-center"
            }
        ],
        locale: 'id',
        placeholder: "Tidak ada data",
        ajaxURL: base_url + "presensi/penjadwalan/listsHistoryJadwal",
        ajaxConfig: "POST",
        ajaxSorting: true,
        ajaxFiltering: true,
        ajaxRequesting: function (url, params) {
            params.start = params.size * (params.page - 1);
            params.length = params.size;
            params.nik = $('#nik').val();
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

            $("#tablelistjadwal-footer .tabulator-startrow").text(startRow);
            $("#tablelistjadwal-footer .tabulator-endrow").text(endRow);
            $("#tablelistjadwal-footer .tabulator-totalrow").text(recordsFiltered);

            let elTotalFilteredRow = $("#tablelistjadwal-footer .tabulator-totalfilteredrow");
            elTotalFilteredRow.text("");
            if (recordsTotal > recordsFiltered) {
                elTotalFilteredRow.text(" (disaring dari " + recordsTotal
                    + " entri keseluruhan)");
            }
            return response;
        },
        footerElement: '<div id="tablelistjadwal-footer" class="pull-left tabulator-info">'
        + 'Menampilkan <span class="tabulator-startrow"></span> - <span class="tabulator-endrow"></span> dari '
        + '<span class="tabulator-totalrow"></span> entri<span class="tabulator-totalfilteredrow"></span></div>',
        pagination: "remote",
        paginationSize: 31,
        paginationButtonCount: 7,
        paginationDataSent: {
            sorters: "order"
        },
        selectable: false
    });

    let btnFilter = $('#btn-tampilkan');
    btnFilter.on('click', function (e) {
        e.preventDefault();
        dtListHistory.setFilter("year(a.tp_start_date)", "=", elPeriodeId.val());
        dtListHistory.setFilter("month(a.tp_start_date)", "=", elbulanId.val());
        dtListHistory.replaceData()
        
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
                var stat_pop = parseInt($('#flag_pop').val());
                if(stat_pop === 0){
                    $('#nik_atasan').val(rowData.nik);
                    $('#nama_atasan_langsung').val(rowData.emp_name); 
                    $('#modal_peserta').modal('hide');                 
                }else{
                    $('#nik_atasan').val(rowData.nik);
                    $('#nama_atasan_langsung').val(rowData.emp_name); 
                    $('#modal_peserta').modal('hide');  
                }
            }
        }
    });
    //ATASAN LANGSUNG

    eljadwalId.select2({
        allowClear: false,
        placeholder: "- Pilih Jadwal -",
        width: '100%',
        dropdownParent: $("#modal-jadwal")
    });
    eljadwalId.val(eljadwalId.attr('value')).trigger('change');

    eljnskelaminId.select2({
        allowClear: false,
        placeholder: "- Pilih -"
    });
    eljnskelaminId.val(eljnskelaminId.attr('value')).trigger('change');

    elreligionId.select2({
        allowClear: false,
        placeholder: "- Pilih -"
    });
    elreligionId.val(elreligionId.attr('value')).trigger('change');

    elstatusId.select2({
        allowClear: false,
        placeholder: "- Pilih -"
    });
    elstatusId.val(elstatusId.attr('value')).trigger('change');

    elCompanyId.select2({
        allowClear: false,
        placeholder: "- Pilih -"
    });
    elCompanyId.val(elCompanyId.attr('value')).trigger('change');
    elCompanyId.on('select2:select', function (e) {
        elUnitId.attr('value', ''); elUnitId.val('');
        elPositionCode.attr('value', ''); elPositionCode.val('');
        elKantorId.attr('value', ''); elKantorId.val('');
        eljadwalId.attr('value', ''); eljadwalId.val('');
        build_position(e.params.data.id);
        build_unit(e.params.data.id);
        build_kantor(e.params.data.id);
        build_jadwal(e.params.data.id);
        dtList.setFilter(
            [
                {field:"a.compid", type:"=", value:elCompanyId.val()}, 
            ]
        );


    });
    if (elCompanyId.val() !== "") {
        build_position(); build_unit(); build_kantor(); build_jadwal();
    }

    function build_position(p_COMPID) {
        if (p_COMPID == null) p_COMPID = elCompanyId.val();
        elPositionCode.html('');

        $.post(base_url + "reference/employee/get_node_position", { COMPID: p_COMPID }, function (data) {
            elPositionCode.select2ToTree({
                treeData: {
                    dataArr: data,
                    valFld: "id",
                    labelFld: "position_desc",
                    incFld: "children",
                    dftVal: null
                },
                allowClear: false,
                placeholder: '- Pilih Posisi -',
                multiple: false,
                width: '100%'
            });
            elPositionCode.val(elPositionCode.attr('value')).trigger('change');
        }, "json");
    }

    function build_unit(p_COMPID) {
        if (p_COMPID == null) p_COMPID = elCompanyId.val();

        elUnitId.html('');
        elUnitId.val(elUnitId.attr('value'));

        $.post(base_url + "reference/employee/get_node_org", { COMPID: p_COMPID }, function (data) {
            elUnitId.html('');
            elUnitId.select2ToTree({
                treeData: {
                    dataArr: data,
                    valFld: "id",
                    labelFld: "unitName",
                    incFld: "children",
                    dftVal: null
                },
                allowClear: false,
                placeholder: '- Pilih Organisasi -',
                multiple: false,
                width: '100%'
            });
            elUnitId.val(elUnitId.attr('value')).trigger('change');
        }, "json");
    }

    function build_kantor(p_COMPID) {
        if (p_COMPID == null) p_COMPID = elCompanyId.val();

        elKantorId.html('');
        elKantorId.val(elKantorId.attr('value'));

        $.post(base_url + "reference/employee/get_node_kantor", { COMPID: p_COMPID }, function (data) {
            elKantorId.html('');
            elKantorId.select2ToTree({
                treeData: {
                    dataArr: data,
                    valFld: "id",
                    labelFld: "unitName",
                    incFld: "children",
                    dftVal: null
                },
                allowClear: false,
                placeholder: '- Pilih Kantor -',
                multiple: false,
                width: '100%'
            });
            elKantorId.val(elKantorId.attr('value')).trigger('change');
        }, "json");
    }

    function build_jadwal(p_COMPID) {
        if (p_COMPID == null) p_COMPID = elCompanyId.val();

        eljadwalId.html('');
        eljadwalId.val(eljadwalId.attr('value'));

        $.post(base_url + "reference/employee/get_node_jadwal", { COMPID: p_COMPID }, function (data) {
            eljadwalId.html('');
            eljadwalId.select2ToTree({
                treeData: {
                    dataArr: data,
                    valFld: "id",
                    labelFld: "unitName",
                    incFld: "children",
                    dftVal: null
                },
                allowClear: false,
                placeholder: '- Pilih Jadwal -',
                multiple: false,
                width: '100%'
            });
            eljadwalId.val(eljadwalId.attr('value')).trigger('change');
        }, "json");
    }


    //ATASAN LANGSUNG
    $('#btn-caripejabat').on('click', function (e) {
        $('#flag_pop').val(0);
        $('#modal_peserta').modal('show');
        //dtList.redraw(true);
    });


    $('#tgl_mulai_jadwal').datepicker({
        autoclose: true,
        format: 'dd-mm-yyyy'
    });

    $('#tgl_akhir_jadwal').datepicker({
        autoclose: true,
        format: 'dd-mm-yyyy'
    });

    $('#start_adj').datepicker({
        autoclose: true,
        format: 'dd-mm-yyyy'
    });

    $('#end_adj').datepicker({
        autoclose: true,
        format: 'dd-mm-yyyy'
    });

    $('#company_begin').datepicker({
        autoclose: true,
        format: 'dd-mm-yyyy'
    });

    $('#company_last').datepicker({
        autoclose: true,
        format: 'dd-mm-yyyy'
    });

    $('#tgl_lahir').datepicker({
        autoclose: true,
        format: 'dd-mm-yyyy'
    });

    $('#stat_sales').change(function() {
        (this.checked) ? $('#stat_sales').val(1) : $('#stat_sales').val(0);  
    });

    $("#periode").inputmask("9999");
    $("#jml_cuti").inputmask("99");
    $("#tgl_mulai_jadwal").inputmask("99-99-9999");
    $("#tgl_akhir_jadwal").inputmask("99-99-9999");
    $("#start_adj").inputmask("99-99-9999");
    $("#end_adj").inputmask("99-99-9999");
    $("#company_begin").inputmask("99-99-9999");
    $("#company_last").inputmask("99-99-9999");
    


    /* TIME PROFILE */



    $('#btn-tambahjadwal').on('click', function (e) {
        $('#modal-jadwal').modal('show');
    });

    $('#btn-pilihjadwal').on('click', getSelectedStafBANC);

    $('#modal-jadwal').on('shown.bs.modal', function (e) {
        // dtStaf.$('tr.active').removeClass('active');
        // dtStaf.ajax.reload();
        $('#id_tp').select2(
            {
                width: '100%',
                dropdownParent: $("#modal-jadwal")
            }
        );
    });


    // click get selected staf bac
    function getSelectedStafBANC() {
    
        var aItem = [];
        var resultFound = [];
        var id = null;
        var deskripsi_jadwal = null;
        var tgl_mulai_jadwal = null;
        var tgl_akhir_jadwal = null;


        id = $('#id_tp').val();
        var t = document.getElementById("id_tp");
        var deskripsi_jadwal = t.options[t.selectedIndex].text;
        tgl_mulai_jadwal = $('#tgl_mulai_jadwal').val();
        tgl_akhir_jadwal = $('#tgl_akhir_jadwal').val();

        // resultFound = $.grep(dataTimeProfileModul, function (e) {
        //     return e.id === id;
        // });
        if (id.length != 0 && tgl_mulai_jadwal.length != 0 && tgl_akhir_jadwal.length != 0 ) {
            var btnAct = "<a href='#' class='btn-removeitem-jadwal' title='Hapus staf dari modul'><span class='fa fa-fw fa-trash'></span></a>";
            //if (!allow_new) btnAct = '';
            aItem = {
                id: id,
                seq: 99999,
                deskripsi_jadwal: deskripsi_jadwal,
                tgl_mulai_jdwl: tgl_mulai_jadwal,
                tgl_akhir_jdwl: tgl_akhir_jadwal,
                btn: btnAct
            };
            dataTimeProfileModul.push(aItem);
            $('#id_tp').val('');
            $('#tgl_mulai_jadwal').val('');
            $('#tgl_akhir_jadwal').val('');


            var i = 1;
            $.each(dataTimeProfileModul, function () {
                this['seq'] = i++;
            });
    
            // // draw datatables
            dtTimeProfile.clear().rows.add(dataTimeProfileModul).draw();
            
            $('#modal-jadwal').modal('hide');

        }else{
            alert('Silakan lengkapi !');
        }

    }


    /* KELUARGA */

    // table tim work
    var listKeluarga = $('#dt-listKeluarga');
    var dtKeluarga = listKeluarga.DataTable({
        ordering: false,
        responsive: true,
        paging: false,
        searching: false,
        "info":  false,
        columns: [
            {data: 'seq_kel', class: 'text-center'},
            {data: 'nama_kel'},
            {data: 'relasi_kel'},
            {data: 'btn_kel', class: 'text-center', 'searchable': false, 'orderable':false}
        ]
    });


    $('#btn-tambahkeluarga').on('click', function (e) {
        $('#modal_keluarga').modal('show');
    });

    $('#btn-pilihkeluarga').on('click', getSelectedKeluarga);

    $('#modal_keluarga').on('shown.bs.modal', function (e) {
        // dtStaf.$('tr.active').removeClass('active');
        // dtStaf.ajax.reload();
    });


    // click get selected staf bac
    function getSelectedKeluarga() {
    
        var aItemKel = [];
        var resultFound = [];
        var id = null;
        var nama_kel = null;
        var relasi_kel = null;

        // id = $('#id_tp').val();
        // var t = document.getElementById("id_tp");
        var nama_kel = $('#nama_kel').val();
        relasi_kel = $('#relasi_kel').val();

        // resultFound = $.grep(dataKeluargaModul, function (e) {
        //     return e.id === id;
        // });
        if (relasi_kel.length != 0 && nama_kel.length != 0 ) {
            var btnActKel = "<a href='#' class='btn-kel-removeitem' title='Hapus staf dari modul'><span class='fa fa-fw fa-trash'></span></a>";
            //if (!allow_new) btnActKel = '';
            aItemKel = {
                id: id,
                seq_kel: 99999,
                nama_kel: nama_kel,
                relasi_kel: relasi_kel,
                btn_kel: btnActKel
            };
            dataKeluargaModul.push(aItemKel);
            $('#nama_kel').val('');
            $('#relasi_kel').val('');


            var i = 1;
            $.each(dataKeluargaModul, function () {
                this['seq_kel'] = i++;
            });
    
            // // draw datatables
            dtKeluarga.clear().rows.add(dataKeluargaModul).draw();
            
            $('#modal_keluarga').modal('hide');

        }else{
            alert('Silakan lengkapi atau data duplikat !');
        }

    }


    var hidKeluarga = $("input[name='hid_keluarga']").val();
    if (hidKeluarga != '') {
         dataKeluargaModul = $.parseJSON(hidKeluarga);
        var btnActKel = "<a href='#' class='btn-kel-removeitem' title='Hapus staf dari modul'><span class='fa fa-fw fa-trash'></span></a>";
        //if (!allow_new) btnActKel = '';
        $.each(dataKeluargaModul, function () {
            this['btn_kel'] = btnActKel;
        });
    }

    // remove staf from modul
    listKeluarga.find('tbody').on('click', 'a.btn-kel-removeitem', function (e) {
        e.preventDefault();
        var row = $(this).closest("tr");
        dataKeluargaModul.splice(row.index(), 1);
        var i = 1;
        $.each(dataKeluargaModul, function () {
            this['seq_kel'] = i++;
        });

        dataKeluarga.length = 0;
        dtKeluarga.clear().rows.add(dataKeluargaModul).draw();
    });

    // /* END KELUARGA */


    /* CUTI ADJUSTMENT */

    // table tim work
    var listCutiAdjustment = $('#dt-listCutiAdjustment');
    var dtCutiAdjustment = listCutiAdjustment.DataTable({
        ordering: false,
        serverSide: false,
        autoWidth: false,
        responsive: true,
        paging: false,
        searching: false,
        columns: [
            {data: 'seq_cutiadj', width: '7%', class: 'text-center'},
            {data: 'periode', width: '13%'},
            {data: 'jml_cuti', width: '15%'},
            {data: 'remark_adj', width: '15%'},
            {data: 'start_adj', width: '21%'},
            {data: 'end_adj', width: '21%'},
            {data: 'btnActCutiAdj', width: '6%', class: 'text-center', 'searchable': false, 'orderable':false}
        ]
    });


    $('#btn-tambahcutiadjustment').on('click', function (e) {
        $('#modal-cutiadjustment').modal('show');
    });

    $('#btn-pilihcutiadjustment').on('click', getSelectedCutiAdjustment);

    $('#modal-cutiadjustment').on('shown.bs.modal', function (e) {
        // dtStaf.$('tr.active').removeClass('active');
        // dtStaf.ajax.reload();
    });


    // click get selected staf bac
    function getSelectedCutiAdjustment() {
    
        var aItemCutiAdj = [];
        var resultFound = [];
        var periode = null;
        var jml_cuti = null;
        var jml_cuti_ = null;
        var remark_adj = null;
        var start_adj = null;
        var end_adj = null;

        var row_id = $('#seq_cutiadj').val();
        periode = $('#periode').val();
        jml_cuti_ = $('#jml_cuti').val();
        jml_cuti = jml_cuti_.replace("_", ""); 
        remark_adj = $('#remark_adj').val();
        start_adj = $('#start_adj').val();
        end_adj = $('#end_adj').val();
        var idx = row_id - 1;

        // resultFound = $.grep(dataCutiAdjustmentModul, function (e) {
        //     return e.id === id;
        // });
        if (periode.length  != 0 && start_adj.length != 0 && end_adj.length != 0 ) {
            var seq_cutiadj = 0;
            var btnActCutiAdj = "<a href='#' class='btncutiadj-edititem' title='Edit penyesuaian cuti'><span class='fa fa-fw fa-pencil'></span></a>";
            btnActCutiAdj += "<a href='#' class='btncutiadj-removeitem' title='Hapus penyesuaian cuti dari list'><span class='fa fa-fw fa-trash'></span></a>";
            //if (!allow_new) btnAct = '';
            if(row_id < 1 || row_id == null){
                // insert item
                var num = dataCutiAdjustmentModul.length;
                var seq_cutiadj = num + 1;
            }else{
                // update item
                seq_cutiadj = row_id;
                remove_item(idx);
            }
            
            //if (!allow_new) btnActCutiAdj = '';
            aItemCutiAdj = {
                seq_cutiadj: seq_cutiadj,
                periode: periode,
                jml_cuti: jml_cuti,
                remark_adj: remark_adj,
                start_adj: start_adj,
                end_adj: end_adj,
                btnActCutiAdj: btnActCutiAdj
            };
            dataCutiAdjustmentModul.push(aItemCutiAdj);
            $('#periode').val('');
            $('#jml_cuti').val('');
            $('#remark_adj').val('');
            $('#start_adj').val('');
            $('#end_adj').val('');

            var i = 1;
            $.each(dataCutiAdjustmentModul, function () {
                this['seq_cutiadj'] = i++;
            });
    
            // // draw datatables
            dtCutiAdjustment.clear().rows.add(dataCutiAdjustmentModul).draw();
            
            $('#modal-cutiadjustment').modal('hide');

        }else{
            alert('Silakan lengkapi !');
        }

    }

    function remove_item(index){
        dataCutiAdjustmentModul.splice(index, 1);
        var i = 1;
        $.each(dataCutiAdjustmentModul, function () {
            this['seq_cutiadj'] = i++;
        });
    }

    var hidCutiAdjustment = $("input[name='hid_cutiadjustment']").val();
    if (hidCutiAdjustment != '') {
         dataCutiAdjustmentModul = $.parseJSON(hidCutiAdjustment);
        var btnActCutiAdj = "<a href='#' class='btncutiadj-removeitem' title='Hapus staf dari modul'><span class='fa fa-fw fa-trash'></span></a>";
        //if (!allow_new) btnActCutiAdj = '';
        $.each(dataCutiAdjustmentModul, function () {
            this['btnActCutiAdj'] = btnActCutiAdj;
        });
    }

    // remove staf from modul
    listCutiAdjustment.find('tbody').on('click', 'a.btncutiadj-removeitem', function (e) {
        e.preventDefault();
        var row = $(this).closest("tr");
        dataCutiAdjustmentModul.splice(row.index(), 1);
        var i = 1;
        $.each(dataCutiAdjustmentModul, function () {
            this['seq_cutiadj'] = i++;
        });

        dataCutiAdjustment.length = 0;
        dtCutiAdjustment.clear().rows.add(dataCutiAdjustmentModul).draw();
    });


    listCutiAdjustment.find('tbody').on('click', 'a.btncutiadj-edititem', function (e) {
        e.preventDefault();
        var row = $(this).closest("tr");
        var num = row.index() + 1;


        $.each(dtCutiAdjustment.rows().data(), function () {
            if(num == this['seq_cutiadj']){
                $("#seq_cutiadj").val(this['seq_cutiadj']);
                $("#periode").val(this['periode']);
                $("#jml_cuti").val(this['jml_cuti']);
                $("#remark_adj").val(this['remark_adj']);
                $("#start_adj").val(this['start_adj']);
                $("#end_adj").val(this['end_adj']);
            }
        });

        $('#modal-cutiadjustment').modal('show');
            
    });

    // /* END CUTI ADJUSTMENT */
    $("#fmain").submit(function(e){
        // PARSE TO JSON JADWAL
        $("#hid_jadwal").val("");
        var jsonJadwal = '';
        if (dataTimeProfileModul && dataTimeProfileModul.length > 0) {
            var postJadwal = dataTimeProfileModul;
            $.each(postJadwal, function () {
                this['btn'] = '';
            });

            jsonJadwal = JSON.stringify(postJadwal);
        }
        if (jsonJadwal == '[]') jsonJadwal = '';
        $("input[name='hid_jadwal']").val(jsonJadwal);


        // PARSE TO JSON KELUARGA
        $("#hid_keluarga").val("");
        var jsonKeluarga = '';
        if (dataKeluargaModul && dataKeluargaModul.length > 0) {
            var postKeluarga = dataKeluargaModul;
            $.each(postKeluarga, function () {
                this['btn_kel'] = '';
            });

            jsonKeluarga = JSON.stringify(postKeluarga);
        }
        if (jsonKeluarga == '[]') jsonKeluarga = '';
        $("input[name='hid_keluarga']").val(jsonKeluarga);


        // PARSE TO JSON KELUARGA
        $("#hid_cutiadjustment").val("");
        var jsonCutiAdjustment = '';
        if (dataCutiAdjustmentModul && dataCutiAdjustmentModul.length > 0) {
            var postCutiAdjustment = dataCutiAdjustmentModul;
            $.each(postCutiAdjustment, function () {
                this['btn_cutiadj'] = '';
            });

            jsonCutiAdjustment = JSON.stringify(postCutiAdjustment);
        }
        if (jsonCutiAdjustment == '[]') jsonCutiAdjustment = '';
        $("input[name='hid_cutiadjustment']").val(jsonCutiAdjustment);


    });

});
