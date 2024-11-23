"use strict";
$(document).ready(function () {
    let elCompanyId = $("#COMPID");
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
});
