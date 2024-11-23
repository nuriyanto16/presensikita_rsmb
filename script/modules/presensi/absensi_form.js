"use strict";
$(document).ready(function () {
    let elCompanyId = $("#COMPID");
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

    function build_position(p_COMPID) {
        if (p_COMPID == null) p_COMPID = elCompanyId.val();
        elPositionCode.html('');

        $.post(base_url + "presensi/absensi/get_node_position", { COMPID: p_COMPID }, function (data) {
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

        $.post(base_url + "presensi/absensi/get_node_org", { COMPID: p_COMPID }, function (data) {
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
