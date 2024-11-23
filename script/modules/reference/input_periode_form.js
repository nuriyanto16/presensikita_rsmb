"use strict";
$(document).ready(function () {
    let elCompanyId = $("#company_code");
    let elParentPosition = $("#parent_position_code");
    let elOrgCode = $("#org_code");

    elCompanyId.select2({
        allowClear: false,
        placeholder: "- Pilih -"
    });
    elCompanyId.val(elCompanyId.attr('value')).trigger('change');
    elCompanyId.on('select2:select', function (e) {
        elParentPosition.attr('value', ''); elOrgCode.attr('value', '');
        elParentPosition.val(''); elOrgCode.val('');
        build_parent(e.params.data.id);
        build_unit(e.params.data.id);
    });
    if (elCompanyId.val() !== "") {
        build_parent(); build_unit();
    }

    $('#start_date').datepicker({
        format: 'dd-mm-yyyy',
        clearBtn: true,
        autoclose: true,
        todayHighlight: true,
        readonly: false
    });
    $('#end_date').datepicker({
        format: 'dd-mm-yyyy',
        clearBtn: true,
        autoclose: true,
        todayHighlight: true,
        readonly: false
    });

    function build_parent(p_compId) {
        if (p_compId == null) p_compId = elCompanyId.val();

        $.post(base_url + "reference/position/get_node", { COMP_CODE: p_compId }, function (data) {
            elParentPosition.html('');
            elParentPosition.select2ToTree({
                treeData: {
                    dataArr: data,
                    valFld: "id",
                    labelFld: "position_desc",
                    incFld: "children",
                    dftVal: null
                },
                allowClear: true,
                placeholder: '- Pilih Parent -',
                multiple: false,
                width: '100%'
            });
            elParentPosition.val(elParentPosition.attr('value')).trigger('change');
        }, "json");
    }

    function build_unit(p_compId) {
        if (p_compId == null) p_compId = elCompanyId.val();
        elOrgCode.html('');
        elOrgCode.val(elOrgCode.attr('value'));

        $.post(base_url + "reference/position/get_node_org", { COMP_CODE: p_compId }, function (data) {
            elOrgCode.select2ToTree({
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
            elOrgCode.val(elOrgCode.attr('value')).trigger('change');
        }, "json");
    }
});
