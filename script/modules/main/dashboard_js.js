"use strict";

let modalForm;
let dataTable;
let map;
let showNop = "";
let showLatLng = null;
var markerCluster;
var markerCluster1

$(document).ready(function () {

    let elCompanyId = $("#compid");
    let elEmployeeId = $("#nik");

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
    elEmployeeId.on('select2:select', function (e) {
        //$("#nik_").val(e.params.data.id);
    });

    $('#start_date').datepicker({
        autoclose: true,
        format: 'dd-mm-yyyy'
    });

    $('#end_date').datepicker({
        autoclose: true,
        format: 'dd-mm-yyyy'
    });

    function build_employee(p_COMPID) {
        if (p_COMPID == null) p_COMPID = elCompanyId.val();
        elEmployeeId.html('');

        $.post(base_url + "presensi/izin/get_node_employee", { COMPID: p_COMPID }, function (data) {
            elEmployeeId.select2ToTree({
                treeData: {
                    dataArr: data,
                    valFld: "nik",
                    labelFld: "emp_name",
                    incFld: "children",
                    dftVal: null
                },
                allowClear: false,
                placeholder: '- Semua Karyawan -',
                multiple: false,
                width: '100%'
            });
            elEmployeeId.val(elEmployeeId.attr('value')).trigger('change');
        }, "json");
    }

    
});

modalForm = $('#ModalPreview');
