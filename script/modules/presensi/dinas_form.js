"use strict";
let dtList = null;

var dataPeserta= [];
var dataPesertaModul = [];


$(document).ready(function () {
    let elCompanyId = $("#compid");
    let elEmployeeId = $("#nik");
    let elTipeIzinId = $("#id_abs_type");

    $("[data-politespace]").politespace();

    elCompanyId.select2({
        allowClear: false,
        placeholder: "- Pilih -"
    });
    elCompanyId.val(elCompanyId.attr('value')).trigger('change');
    elCompanyId.on('select2:select', function (e) {
        elEmployeeId.attr('value', ''); 
        elEmployeeId.val('');
        build_employee(e.params.data.id);
    });
    if (elCompanyId.val() !== "") {
        build_employee();
    }

    elTipeIzinId.select2({
        allowClear: false,
        placeholder: "- Pilih -"
    });
    elTipeIzinId.val(elTipeIzinId.attr('value')).trigger('change');

    function build_employee(p_COMPID) {
        if (p_COMPID == null) p_COMPID = elCompanyId.val();
        elEmployeeId.html('');

        $.post(base_url + "presensi/dinas/get_node_employee", { COMPID: p_COMPID }, function (data) {
            elEmployeeId.select2ToTree({
                treeData: {
                    dataArr: data,
                    valFld: "nik",
                    labelFld: "emp_name",
                    incFld: "children",
                    dftVal: null
                },
                allowClear: false,
                placeholder: '- Pilih Karyawan -',
                multiple: false,
                width: '100%'
            });
            elEmployeeId.val(elEmployeeId.attr('value')).trigger('change');
        }, "json");
    }

    $('#tgl_brkt').datepicker({
        autoclose: true,
        format: 'dd-mm-yyyy'
    });

    $('#tgl_plng').datepicker({
        autoclose: true,
        format: 'dd-mm-yyyy'
    });

    $('#tgl_plng').datepicker().on('changeDate', function (ev) {
        var start = $("#tgl_brkt").datepicker("getDate");
        var end = $("#tgl_plng").datepicker("getDate");
        var days = (end - start) / (1000 * 60 * 60 * 24) + 1;
        if(days<=0){
            $('#tgl_brkt').datepicker('setDate', null);
            $('#tgl_plng').datepicker('setDate', null);
            $("#jml").val("");
        }else{
            $("#jml").val(days);
        }
    });
    if($("#id").val() == null || $("#id").val() == '' || $("input[name='id']").val() == '' || $("input[name='id']").val() == null){
        $( "#ak_hotel_nom" ).prop( "disabled", true );
        $( "#ak_hotel_ket" ).prop( "disabled", true );
        $( "#ak_tr_loc_nom" ).prop( "disabled", true );
        $( "#ak_tr_loc_ket" ).prop( "disabled", true );
        $( "#ak_susp_nom" ).prop( "disabled", true );
        $( "#ak_susp_ket" ).prop( "disabled", true );
    }

    ($('#ak_hotel').val()) ? $( "#ak_hotel_nom" ).prop( "disabled", false ) : $( "#ak_hotel_nom" ).prop( "disabled", true );  
    ($('#ak_hotel').val()) ? $( "#ak_hotel_ket" ).prop( "disabled", false ) : $( "#ak_hotel_ket" ).prop( "disabled", true );  
    ($('#ak_tr_loc').val()) ? $( "#ak_tr_loc_nom" ).prop( "disabled", false ) : $( "#ak_tr_loc_nom" ).prop( "disabled", true ); 
    ($('#ak_tr_loc').val()) ? $( "#ak_tr_loc_ket" ).prop( "disabled", false ) : $( "#ak_tr_loc_ket" ).prop( "disabled", true ); 
    ($('#ak_susp').val()) ? $( "#ak_susp_nom" ).prop( "disabled", false ) : $( "#ak_susp_nom" ).prop( "disabled", true ); 
    ($('#ak_susp').val()) ? $( "#ak_susp_ket" ).prop( "disabled", false ) : $( "#ak_susp_ket" ).prop( "disabled", true );  

    $('#all_bdgjkt').change(function() {
        (this.checked) ? $('#all_bdgjkt').val(1) : $('#all_bdgjkt').val(0);  
    });

    $('#all_lr_kota').change(function() {
        (this.checked) ? $('#all_lr_kota').val(1) : $('#all_lr_kota').val(0);  
    });

    $('#all_lr_negeri').change(function() {
        (this.checked) ? $('#all_lr_negeri').val(1) : $('#all_lr_negeri').val(0);  
    });

    $('#tr_k_pribadi').change(function() {
        (this.checked) ? $('#tr_k_pribadi').val(1) : $('#tr_k_pribadi').val(0);  
    });

    $('#tr_k_dinas').change(function() {
        (this.checked) ? $('#tr_k_dinas').val(1) : $('#tr_k_dinas').val(0);  
    });

    $('#tr_ka').change(function() {
        (this.checked) ? $('#tr_ka').val(1) : $('#tr_ka').val(0);  
    });

    $('#tr_pesawat').change(function() {
        (this.checked) ? $('#tr_pesawat').val(1) : $('#tr_pesawat').val(0);  
    });

    $('#tr_travel').change(function() {
        (this.checked) ? $('#tr_travel').val(1) : $('#tr_travel').val(0);  
    });

    $('#tr_bus').change(function() {
        (this.checked) ? $('#tr_bus').val(1) : $('#tr_bus').val(0);  
    });


    $('#ak_hotel').change(function() {
        (this.checked) ? $('#ak_hotel').val(1) : $('#ak_hotel').val(0);  
        (this.checked) ? $( "#ak_hotel_nom" ).prop( "disabled", false ) : $( "#ak_hotel_nom" ).prop( "disabled", true ); 
        (this.checked) ? $( "#ak_hotel_ket" ).prop( "disabled", false ) : $( "#ak_hotel_ket" ).prop( "disabled", true ); 
    });

    $('#ak_tr_loc').change(function() {
        (this.checked) ? $('#ak_tr_loc').val(1) : $('#ak_tr_loc').val(0);  
        (this.checked) ? $( "#ak_tr_loc_nom" ).prop( "disabled", false ) : $( "#ak_tr_loc_nom" ).prop( "disabled", true ); 
        (this.checked) ? $( "#ak_tr_loc_ket" ).prop( "disabled", false ) : $( "#ak_tr_loc_ket" ).prop( "disabled", true ); 
    });

    $('#ak_susp').change(function() {
        (this.checked) ? $('#ak_susp').val(1) : $('#ak_susp').val(0);  
        (this.checked) ? $( "#ak_susp_nom" ).prop( "disabled", false ) : $( "#ak_susp_nom" ).prop( "disabled", true ); 
        (this.checked) ? $( "#ak_susp_ket" ).prop( "disabled", false ) : $( "#ak_susp_ket" ).prop( "disabled", true ); 
    });


    let preloaded = jQuery.parseJSON($("#hid_detail_attachment").val());
    $('.input-images-1').imageUploader(
        {
            id: 'upload_files',
            name: 'upload_files',   
            label: 'Drag, Drop atau Klik untuk upload foto lampiran',
            preloaded: preloaded,
            imagesInputName: 'images',
            preloadedInputName: 'old_images'
        }
    );

    $('#btn-save').on('click', function (e) {
        e.preventDefault();
        if (confirm("Anda yakin akan menyimpan data ini?")) {
            let ListDetAttach  = jQuery.parseJSON($("#hid_detail_attachment").val());
            let jsonDetAttch = JSON.stringify(ListDetAttach);
            $("#hid_detail_attachment").val("");
            if (jsonDetAttch == '[]') jsonDetAttch = '';
            $("input[name='hid_detail_attachment']").val(jsonDetAttch);

            // PARSE TO JSON KELUARGA
            $("#hid_peserta").val("");
            var jsonPeserta = '';
            if (dataPesertaModul && dataPesertaModul.length > 0) {
                var postPeserta = dataPesertaModul;
                $.each(postPeserta, function () {
                    this['btn_peserta'] = '';
                });

                jsonPeserta = JSON.stringify(postPeserta);
            }
            if (jsonPeserta == '[]') jsonPeserta = '';
            $("input[name='hid_peserta']").val(jsonPeserta);


            $("#actionf").val('save');
            $("#fmain").submit();
        }
    });

    $('#btn-approve').on('click', function (e) {
        e.preventDefault();
        if (confirm("Anda yakin akan menyetujui data ini?")) {
            let ListDetAttach  = jQuery.parseJSON($("#hid_detail_attachment").val());
            let jsonDetAttch = JSON.stringify(ListDetAttach);
            $("#hid_detail_attachment").val("");
            if (jsonDetAttch == '[]') jsonDetAttch = '';
            $("input[name='hid_detail_attachment']").val(jsonDetAttch);
            $("#actionf").val('approve');
            $("#fmain").submit();
        }
    });

    $('#btn-reject').on('click', function (e) {
        e.preventDefault();
        if (confirm("Anda yakin tidak setuju dengan pengajuan ini?")) {
            let ListDetAttach  = jQuery.parseJSON($("#hid_detail_attachment").val());
            let jsonDetAttch = JSON.stringify(ListDetAttach);
            $("#hid_detail_attachment").val("");
            if (jsonDetAttch == '[]') jsonDetAttch = '';
            $("input[name='hid_detail_attachment']").val(jsonDetAttch);
            $("#actionf").val('reject');
            $("#fmain").submit();
        }
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
                    $('#nm_pejabat').val(rowData.emp_name);
                    $('#jabatan').val(rowData.position_desc);   
                    $('#modal_peserta').modal('hide');                 
                }else{
                    getSelectedPeserta(rowData.id, rowData.nik, rowData.emp_name);
                }
            }
        }
    });

    var listPeserta = $('#dt-listPeserta');
    var dtPeserta = listPeserta.DataTable({
        ordering: false,
        serverSide: false,
        autoWidth: false,
        responsive: true,
        paging: false,
        searching: false,
        columns: [
            {data: 'seq_peserta', width: '7%', class: 'text-center'},
            {data: 'nik_karyawan', width: '21%'},
            {data: 'nama_karyawan', width: '45%'},
            {data: 'btn_peserta', width: '6%', class: 'text-center', 'searchable': false, 'orderable':false}
        ]
    });

    $('#btn-caripejabat').on('click', function (e) {
        $('#flag_pop').val(0);
        $('#modal_peserta').modal('show');
    });

    $('#btn-tambahpeserta').on('click', function (e) {
        $('#flag_pop').val(1);
        $('#modal_peserta').modal('show');
    });

    //$('#btn-pilihpeserta').on('click', getSelectedpeserta);

    $('#modal_peserta').on('shown.bs.modal', function (e) {
        dtList.setData();
        dtList.redraw(true);
    });

    $('#modal_peserta').on('hidden.bs.modal', function (e) {
        dtList.clearData();
    });

    // click get selected staf bac
    function getSelectedPeserta(idEmp, nikEmp, namaEmp) {
    
        var aItemPeserta = [];
        var resultFound = [];
        var id = idEmp;
        var nik_karyawan = nikEmp;
        var nama_karyawan = namaEmp;

        resultFound = $.grep(dataPesertaModul, function (e) {
            return e.nik_karyawan === nik_karyawan;
        });

        if (resultFound.length == 0 ) {
            var btnActPeserta = "<a href='#' class='btn-peserta-removeitem' title='Hapus staf dari modul'><span class='fa fa-fw fa-trash'></span></a>";
            //if (!allow_new) btnActPeserta = '';
            aItemPeserta = {
                id: id,
                seq_peserta: 99999,
                nik_karyawan: nik_karyawan,
                nama_karyawan: nama_karyawan,
                btn_peserta: btnActPeserta
            };
            dataPesertaModul.push(aItemPeserta);

            var i = 1;
            $.each(dataPesertaModul, function () {
                this['seq_peserta'] = i++;
            });
    
            // // draw datatables
            dtPeserta.clear().rows.add(dataPesertaModul).draw();
            
            $('#modal_peserta').modal('hide');

        }else{
            alert('Silakan lengkapi atau data duplikat !');
        }

    }


    var hidPeserta = $("input[name='hid_peserta']").val();
    if (hidPeserta != '') {
      dataPesertaModul = $.parseJSON(hidPeserta);
        var btnActPeserta = "<a href='#' class='btn-peserta-removeitem' title='Hapus staf dari modul'><span class='fa fa-fw fa-trash'></span></a>";
        //if (!allow_new) btnActPeserta = '';
        $.each(dataPesertaModul, function () {
            this['btn_peserta'] = btnActPeserta;
        });
    }

    // remove staf from modul
    listPeserta.find('tbody').on('click', 'a.btn-peserta-removeitem', function (e) {
        e.preventDefault();
        var row = $(this).closest("tr");
        dataPesertaModul.splice(row.index(), 1);
        var i = 1;
        $.each(dataPesertaModul, function () {
            this['seq_peserta'] = i++;
        });

        dataPeserta.length = 0;
        dtPeserta.clear().rows.add(dataPesertaModul).draw();
    });

    /* END KELUARGA */
    


});
