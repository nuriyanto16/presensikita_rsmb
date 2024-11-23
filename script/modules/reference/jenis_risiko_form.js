"use strict";
$(document).ready(function () {
    let elParentPosition = $("#parent_id");
    build_parent();

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

    function build_parent() {
        $.post(base_url + "reference/jenis_risiko/get_node", function (data) {
            elParentPosition.html('');
            elParentPosition.select2ToTree({
                treeData: {
                    dataArr: data,
                    valFld: "id",
                    labelFld: "jenis_risiko_nama",
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
});
