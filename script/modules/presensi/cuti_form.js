"use strict";
$(document).ready(function () {
    let elCompanyId = $("#compid");
    let elEmployeeId = $("#nik");
    let elTipeCutiId = $("#id_abs_type");

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

    elTipeCutiId.select2({
        allowClear: false,
        placeholder: "- Pilih -"
    });
    elTipeCutiId.val(elTipeCutiId.attr('value')).trigger('change');

    function build_employee(p_COMPID) {
        if (p_COMPID == null) p_COMPID = elCompanyId.val();
        elEmployeeId.html('');

        $.post(base_url + "presensi/cuti/get_node_employee", { COMPID: p_COMPID }, function (data) {
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


    $('#start_date').datepicker({
        autoclose: true,
        format: 'dd-mm-yyyy'
    });

    $('#end_date').datepicker({
        autoclose: true,
        format: 'dd-mm-yyyy'
    });

    $('#end_date').datepicker().on('changeDate', function (ev) {
        var start = $("#start_date").datepicker("getDate");
        var end = $("#end_date").datepicker("getDate");
        var days = (end - start) / (1000 * 60 * 60 * 24) + 1;
        if(days<=0){
            $('#start_date').datepicker('setDate', null);
            $('#end_date').datepicker('setDate', null);
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
    //http://localhost/presensikita/uploads/izin/ABCDE1/ABCDE1.IZ.05.2020.000002_5EB28915DAD1B_20200506165325_201609002_ABCDE1.png
    //$('#uploaded-image .zoomImg').attr('src', 'http://localhost/presensikita/uploads/izin/ABCDE1/ABCDE1.IZ.05.2020.000002_5EB28915DAD1B_20200506165325_201609002_ABCDE1.png');


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
