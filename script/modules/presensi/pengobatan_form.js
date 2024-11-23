"use strict";
$(document).ready(function () {

    $("[data-politespace]").politespace();

    let elCompanyId = $("#compid");
    let elEmployeeId = $("#nik");
    let elTipePengobatanId = $("#pengobatan_id");
    let elNamaKuitansiId = $("#nama_kuitansi");
    let elEmpNik  = $("#emp_nik").val();

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

    elEmployeeId.select2({
        allowClear: false,
        placeholder: "- Pilih -"
    });
    elEmployeeId.val(elEmployeeId.attr('value')).trigger('change');
    elEmployeeId.on('select2:select', function (e) {
        elNamaKuitansiId.attr('value', ''); 
        elNamaKuitansiId.val('');
        build_nama_kuitansi(elCompanyId.val(),e.params.data.id);
    });
    if (elEmployeeId.val() !== "") {
        build_nama_kuitansi();
    }

    elTipePengobatanId.select2({
        allowClear: false,
        placeholder: "- Pilih -"
    });
    elTipePengobatanId.val(elTipePengobatanId.attr('value')).trigger('change');

    elNamaKuitansiId.select2({
        allowClear: false,
        placeholder: "- Pilih -"
    });
    elNamaKuitansiId.val(elNamaKuitansiId.attr('value')).trigger('change');

    function build_employee(p_COMPID) {
        if (p_COMPID == null) p_COMPID = elCompanyId.val();
        elEmployeeId.html('');

        $.post(base_url + "presensi/pengobatan/get_node_employee", { COMPID: p_COMPID  }, function (data) {
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

    function build_nama_kuitansi(p_COMPID, p_NIK) {
        if (p_COMPID == null) p_COMPID = elCompanyId.val();
        if (p_NIK == null) {
            p_NIK = elEmployeeId.val();
            if(p_NIK == null){
                p_NIK = elEmpNik;
            }
        }
        $.post(base_url + "presensi/pengobatan/get_node_nmkuitansi", { COMPID: p_COMPID, NIK: p_NIK }, function (data) {
            elNamaKuitansiId.select2ToTree({
                treeData: {
                    dataArr: data,
                    valFld: "seq",
                    labelFld: "nama_kel",
                    incFld: "children",
                    dftVal: null
                },
                allowClear: false,
                placeholder: '- Pilih Nama Kuitansi -',
                multiple: false,
                width: '100%'
            });
            elNamaKuitansiId.val(elNamaKuitansiId.attr('value')).trigger('change');
        }, "json");
    }

    $('#tgl_kuitansi').datepicker({
        autoclose: true,
        format: 'dd-mm-yyyy'
    });

    $('#tgl_aju').datepicker({
        autoclose: true,
        format: 'dd-mm-yyyy'
    });

    $('#tgl_aju').datepicker().on('changeDate', function (ev) {
        var start = $("#tgl_kuitansi").datepicker("getDate");
        var end = $("#tgl_aju").datepicker("getDate");
        var days = (end - start) / (1000 * 60 * 60 * 24) + 1;
        if(days<=0){
            $('#tgl_kuitansi').datepicker('setDate', null);
            $('#tgl_aju').datepicker('setDate', null);
            $("#jml").val("");
        }else{
            $("#jml").val(days);
        }
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




});
