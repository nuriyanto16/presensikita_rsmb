"use strict";
$(document).ready(function () {
    let elCompanyId = $("#compid");
    let elPositionCode = $("#position_code");
    let elUnitId = $("#unitId");

    elCompanyId.select2({
        allowClear: false,
        placeholder: "- Pilih -"
    });
    elCompanyId.val(elCompanyId.attr('value')).trigger('change');
    elCompanyId.on('select2:select', function (e) {
        elUnitId.attr('value', ''); elUnitId.val('');
        elPositionCode.attr('value', ''); elPositionCode.val('');
        build_position(e.params.data.id);
        build_unit(e.params.data.id);
    });
    if (elCompanyId.val() !== "") {
        build_position(); build_unit();
    }

    $('#hari_1').change(function() {
        (this.checked) ? $('#hari_1').val(1) : $('#hari_1').val(0);  
    });
    $('#hari_2').change(function() {
        (this.checked) ? $('#hari_2').val(1) : $('#hari_2').val(0);  
    });
    $('#hari_3').change(function() {
        (this.checked) ? $('#hari_3').val(1) : $('#hari_3').val(0);  
    });
    $('#hari_4').change(function() {
        (this.checked) ? $('#hari_4').val(1) : $('#hari_4').val(0);  
    });
    $('#hari_5').change(function() {
        (this.checked) ? $('#hari_5').val(1) : $('#hari_5').val(0);  
    });
    $('#hari_6').change(function() {
        (this.checked) ? $('#hari_6').val(1) : $('#hari_6').val(0);  
    });
    $('#hari_7').change(function() {
        (this.checked) ? $('#hari_7').val(1) : $('#hari_7').val(0);  
    });

    $("#hari_1_jam_in").inputmask("hh:mm:ss");
    $("#hari_2_jam_in").inputmask("hh:mm:ss");
    $("#hari_3_jam_in").inputmask("hh:mm:ss");
    $("#hari_4_jam_in").inputmask("hh:mm:ss");
    $("#hari_5_jam_in").inputmask("hh:mm:ss");
    $("#hari_6_jam_in").inputmask("hh:mm:ss");
    $("#hari_7_jam_in").inputmask("hh:mm:ss");

    $("#hari_1_jam_out").inputmask("hh:mm:ss");
    $("#hari_2_jam_out").inputmask("hh:mm:ss");
    $("#hari_3_jam_out").inputmask("hh:mm:ss");
    $("#hari_4_jam_out").inputmask("hh:mm:ss");
    $("#hari_5_jam_out").inputmask("hh:mm:ss");
    $("#hari_6_jam_out").inputmask("hh:mm:ss");
    $("#hari_7_jam_out").inputmask("hh:mm:ss");

    function build_position(p_COMPID) {
        if (p_COMPID == null) p_COMPID = elCompanyId.val();
        elPositionCode.html('');

        $.post(base_url + "reference/timeprofile/get_node_position", { COMPID: p_COMPID }, function (data) {
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

        $.post(base_url + "reference/timeprofile/get_node_org", { COMPID: p_COMPID }, function (data) {
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
});
