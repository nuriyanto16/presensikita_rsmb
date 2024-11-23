"use strict";

var dataTimeProfile = [];
var dataTimeProfileModul = [];

let dtList = null;
let dtListHistory =  null;

$(document).ready(function () {
    let elCompanyId = $("#COMPID");
    let elPositionCode = $("#position_code");
    let elUnitId = $("#unitId");
    let elKantorId = $("#kantor_id");
    let elPeriodeId = $("#periode_id");
    let elbulanId = $("#bulan_id");
    var elMultipleJadwal = $("#multiple_kode_unit");

    // List Detail History Jadwal 

    // table Riwayat Pendidikan
    let dataPlt = '';
    let newIconPlt = function() {
        return "<button class='btn btn-primary' type='button' id='btn-add-jadwal'><i class='fa fa-plus'></i> Tambah</button>";
    };
    let fmEditIcon = function() {
        let fmBtnEdit = "<button class='btn-warning' type='button' title='edit'><i class='fa fa-pencil' title='edit'></i></button>";
        let fmBtnDelete = "<button class='btn-danger' type='button' title='delete'><i class='fa fa-trash' title='delete'></i></button>";
        return fmBtnEdit + "&nbsp;" + fmBtnDelete;
    };

    dtListHistory = new Tabulator("#dt-listjadwal", {
        height:"100%",
        columns: [
            {
                titleFormatter: newIconPlt, headerSort: false, formatter: fmEditIcon,
                width: "150", align: "center", cssClass: "text-center",
                cellClick: function(e, cell) {
                    if (e.target.title === 'delete') {
                        let rowData = cell.getRow().getData();
                        deleteJadwal(
                            rowData.tp_seq
                        );
                    } else if (e.target.title === 'edit') {
                        let rowData = cell.getRow().getData();
                            $('#mode').val("edit");
                            $('#tgl_mulai_jadwal').val(rowData.tanggal);
                            $('#id_tp').val(rowData.id_tp);
                            $('#kode').val(rowData.kode);
                            $('#deskripsi_jadwal').val(rowData.deskripsi);
                            $('#hari_1_jam_in').val(rowData.hari_1_jam_in);
                            $('#hari_1_jam_out').val(rowData.hari_1_jam_out);
                            $('#modal-jadwal').modal('show');
                    }
                }
            },{
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
            params.tahun = elPeriodeId.val();
            params.bulan = elbulanId.val();
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

    //List Karyawan
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
            }
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
            params.listjadwal = elMultipleJadwal.val();
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
                    $('#id_tp').val(rowData.id_tp);
                    $('#kode').val(rowData.kode);
                    $('#deskripsi_jadwal').val(rowData.deskripsi);
                    $('#hari_1_jam_in').val(rowData.hari_1_jam_in);
                    $('#hari_1_jam_out').val(rowData.hari_1_jam_out);
                    $('#modal_peserta').modal('hide');                                  
                }else{
                    $('#id_tp').val(rowData.id_tp);
                    $('#kode').val(rowData.kode);
                    $('#deskripsi_jadwal').val(rowData.deskripsi);
                    $('#hari_1_jam_in').val(rowData.hari_1_jam_in);
                    $('#hari_1_jam_out').val(rowData.hari_1_jam_out);
                    $('#modal_peserta').modal('hide');  
                }
            }
        }
    });
    //ATASAN LANGSUNG

    elbulanId.select2({
        allowClear: false,
        placeholder: "- Pilih Bulan -"
    });
    elbulanId.val(elbulanId.attr('value')).trigger('change');

    elPeriodeId.select2({
        allowClear: false,
        placeholder: "- Pilih Periode Tahun -"
    });
    elPeriodeId.val(elPeriodeId.attr('value')).trigger('change');


    elCompanyId.select2({
        allowClear: false,
        placeholder: "- Pilih -"
    });
    elCompanyId.val(elCompanyId.attr('value')).trigger('change');
    elCompanyId.on('select2:select', function (e) {
        elUnitId.attr('value', ''); elUnitId.val('');
        elPositionCode.attr('value', ''); elPositionCode.val('');
        elKantorId.attr('value', ''); elKantorId.val('');
        build_position(e.params.data.id);
        build_unit(e.params.data.id);
        build_kantor(e.params.data.id);
        dtList.setFilter(
            [
                {field:"a.compid", type:"=", value:elCompanyId.val()}, 
            ]
        );


    });
    if (elCompanyId.val() !== "") {
        build_position(); build_unit(); build_kantor(); 
    }

    function build_position(p_COMPID) {
        if (p_COMPID == null) p_COMPID = elCompanyId.val();
        elPositionCode.html('');

        $.post(base_url + "presensi/penjadwalan/get_node_position", { COMPID: p_COMPID }, function (data) {
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

        $.post(base_url + "presensi/penjadwalan/get_node_org", { COMPID: p_COMPID }, function (data) {
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

        $.post(base_url + "presensi/penjadwalan/get_node_kantor", { COMPID: p_COMPID }, function (data) {
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


    //ATASAN LANGSUNG
    $('#btn-carijadwal').on('click', function (e) {
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

    $("#periode").inputmask("9999");
    $("#jml_cuti").inputmask("99");
    $("#tgl_mulai_jadwal").inputmask("99-99-9999");
    $("#tgl_akhir_jadwal").inputmask("99-99-9999");    

    $("#hari_1_jam_in").inputmask("hh:mm:ss");
    $("#hari_2_jam_in").inputmask("hh:mm:ss");

    $("#deskripsi_jadwal" ).prop( "disabled", true );
    $("#kode" ).prop( "disabled", true );
    $("#hari_1_jam_in" ).prop( "disabled", true );
    $("#hari_1_jam_out" ).prop( "disabled", true );

    $('#modal-upload').on('shown.bs.modal', function (e) {
    });

    $('#upload-excel').on('click', function (e) {
        $('#modal-upload').modal('show');
    });

    // $("#file-upload").on("change", function() {
    //     var fileName = $(this).val().split("\\").pop();
    //     // $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
    //     console.log(fileName);
    //   });
    $('#upload-jadwal').on('click', inUploadJadwal);

    function inUploadJadwal(){
        var fileInput = document.getElementById('file-upload');
        var file = fileInput.files[0];
        var nikElement = document.getElementById('nik');
        var nik = nikElement.value;

        if (file) {
            var formData = new FormData(); // Use FormData to send files
    
            formData.append('excel_file', file);
            formData.append('nik', nik);
    
            $.ajax({
                type: "POST",
                url: base_url + "presensi/penjadwalan/upload_excel",
                data: formData,
                contentType: false, // Let jQuery handle the content type
                processData: false, // Prevent jQuery from processing the data
            }).done(function(data) {
                if(data.success = true){
                    $('#modal-upload').modal('hide');
                }else{
                    alert("Data gagal disimpan / sudah tersedia, silakan coba lagi !");
                }
            }).fail(function(xhr) {
                // Error handling code
                console.error(xhr.responseText);
            });
        }
    }
    /* TIME PROFILE */
    $('#btn-pilihjadwal').on('click', insUpdJadwalpegawai);

    $('#modal-jadwal').on('shown.bs.modal', function (e) {
    });

    $('#btn-add-jadwal').click(function () {
        $('#mode').val("new");
        $('#id_tp').val("");
        $('#kode').val("");
        $('#deskripsi_jadwal').val();
        $('#tgl_mulai_jadwal').val("");
        $('#tgl_mulai_jadwal').val("");
        $('#hari_1_jam_in').val("");
        $('#hari_1_jam_out').val("");
        $('#modal-jadwal').modal('show');
    });

    // click get selected staf bac
    function insUpdJadwalpegawai() {
    
        var tgl_mulai_jadwal = null;
        var tgl_akhir_jadwal = null;
        var mode = $('#mode').val();
        var nik = $('#nik').val();

        var id_tp = $('#id_tp').val();
        var tgl_mulai_jadwal = $('#tgl_mulai_jadwal').val();
        var tgl_akhir_jadwal = $('#tgl_mulai_jadwal').val();

        if (id_tp.length != 0 && tgl_mulai_jadwal.length != 0 && tgl_akhir_jadwal.length != 0 ) {

            let paramPost =  { 
                               mode : mode,
                               nik : nik, 
                               id_tp : id_tp,
                               tp_start_date : tgl_mulai_jadwal, 
                               tp_end_date : tgl_akhir_jadwal 
                            };
            $.ajax({
                type: "POST",
                url: base_url + "presensi/penjadwalan/insertUpdateJadwal",
                data: paramPost,
                dataType: "json"
            }).done(function(data){
                $('#id_tp').val("");
                $('#tgl_mulai_jadwal').val("");
                $('#tgl_akhir_jadwal').val("");
                if(data.status == 1){
                    dtListHistory.setFilter(
                        [
                            {field: "a.nik", type: "=", value: $('#nik').val()},
                        ]
                    );

                    $('#modal-jadwal').modal('hide');
                }else{
                    alert("Data gagal disimpan / sudah tersedia, silakan coba lagi !");
                }

            }).fail(function(xhr) {
                if (xhr.status === 400) {
    
                } else {
                    alert("Telah terjadi kesalahan, mohon hubungi Admin IT");
                }
            });
        
        }else{
            alert('Silakan lengkapi !');
        }   
    }

    //Delete Jadwal
    function deleteJadwal(id){

        var txt;
        var r = confirm("Apakah yakin data akan dihapus ?");
        if (r == true) {
            var nik = $('#nik').val();
            let paramPost =  { 
                mode : 'delete',
                nik : nik,
                tp_seq : id
            };

            $.ajax({
                type: "POST",
                url: base_url + "presensi/penjadwalan/deleteJadwal",
                data: paramPost,
                dataType: "json"
            }).done(function(data){
                if(data.status == "1"){
                    dtListHistory.setFilter(
                        [
                            {field: "a.nik", type: "=", value: $('#nik').val()},
                        ]
                    );

                    $('#modal-jadwal').modal('hide');
                }else{
                    alert("Data gagal disimpan / sudah tersedia, silakan coba lagi !");
                }

            }).fail(function(xhr) {
                if (xhr.status === 400) {
    
                } else {
                    alert("Telah terjadi kesalahan, mohon hubungi Admin IT");
                }
            });
    
    
        } else {
            txt = "You pressed Cancel!";
        }
    
    }

    let btnFilter = $('#btn-tampilkan');
    btnFilter.on('click', function (e) {
        e.preventDefault();
        // dtListHistory.setFilter("year(a.tp_start_date)", "=", elPeriodeId.val());
        // dtListHistory.setFilter("month(a.tp_start_date)", "=", elbulanId.val());
        dtListHistory.setFilter(
            [
                {field: "a.nik", type: "=", value: $("#nik").val()},
                {field: "year(a.tp_start_date)", type: "=", value: elPeriodeId.val()},
                {field: "month(a.tp_start_date)", type: "=", value: elbulanId.val()}
            ]
        );      
    });

    $('#btnExportDetailV22').on('click', function (e) {

        var comp_id = elCompanyId.val();
        var periode_id = elPeriodeId.val();
        var bulan_id = elbulanId.val();
        var emp_id = $("#emp_id").val();
        var unit_id = elUnitId.val();
        var type_print = "xls";
        var varian = "2";

        if(emp_id == null ||emp_id== '' ){
            emp_id = 0;
        }
        
        if(comp_id!="" && periode_id!="" && bulan_id!="" ){
            var url = base_url + "laporan/rekapabsen/getExportDetail?comp_id="+comp_id+
                                                        "&unit_id="+unit_id+
                                                        "&periode_id="+periode_id+
                                                        "&bulan_id="+bulan_id+
                                                        "&emp_id="+emp_id+
                                                        "&type="+type_print+
                                                        "&varian="+varian;

            var win = window.open(url, '_blank');
            win.focus();
        }else{
            alert("Silakan lengkapi data !");
        }
        
    });


    $('#btnExportDetailV2').on('click', function (e) {

        

        var comp_id = elCompanyId.val();
        var periode_id = elPeriodeId.val();
        var bulan_id = elbulanId.val();
        var emp_id = 0; //$("#emp_id").val();
        var unit_id = elUnitId.val();
        var type_print = "preview";

        if(emp_id == null ||emp_id== '' ){
            emp_id = 0;
        }

        if(comp_id!="" && periode_id!="" && bulan_id!="" ){
            var url = base_url + "laporan/rekapabsen/getExportDetail?comp_id="+comp_id+
                                                        "&unit_id="+unit_id+
                                                        "&periode_id="+periode_id+
                                                        "&bulan_id="+bulan_id+
                                                        "&emp_id="+emp_id+
                                                        "&type="+type_print;

            var win = window.open(url, '_blank');
            win.focus();
        }else{
            alert("Silakan lengkapi data !");
        }
        
    });

    let elBtnGenerate= $('#btn-generate');
    elBtnGenerate.on('click', function (e) {

        var comp_id = elCompanyId.val();
        var periode_id = elPeriodeId.val();
        var bulan_id = elbulanId.val();
        var emp_id = 0; //$("#emp_id").val();
        var unit_id = elUnitId.val();


        e.preventDefault();


        // get pie
        //resetPieData();
        $.ajax({
            type: "POST",
            url: base_url + "laporan/rekapabsen/generatejadwal",
            data: { comp_id: comp_id, 
                    periode_id : periode_id,
                    bulan_id : bulan_id,
                    emp_id : emp_id,
                    unit_id : unit_id,
                },
            dataType: "json"
        }).done(function(data){

            alert(data.stat_generate);
        }).always(function() {
            //chartRkapTahunLalu.update();
            //chartRkapTahunIni.update();
        });
    });


});
