"use strict";

$(document).ready(function () {
    //--==== Init ===--// 
    var tbl_det_priv = $('#dt-listpriv').DataTable({
        ordering: false,
        responsive: true,
        info: false,
        searching: false,
        'bPaginate': false,
        sDom: 't',
        scrollX: true,
        columns: [
            {"width": "5%", "class": "align-center"},
            {"width": "30%"},
            {"width": "5%", "class": "align-center"},
            {"width": "5%", "class": "align-center"},
            {"width": "5%", "class": "align-center"},
            {"width": "5%", "class": "align-center"},
            {"width": "5%", "class": "align-center"}
        ],
        ajax: base_url + 'utility/privilege_manage/get_priv_by/0'
    });

    $('#role_id').select2({
        placeholder: '- Pilih Role -'
    }).on("change", function (e) {
        // mostly used event, fired to the original element when the value changes
        var $this = $(this);
        var newUrlPriv = base_url + 'utility/privilege_manage/get_priv_by/'
            + $this.val();
        $('#dt-listpriv').DataTable().ajax.url(newUrlPriv).load();
    });
    //--==== Event ===--//
});

function unSelectAllChk(obName) {
    var checkboxes = document.getElementsByName(obName);
    for (var i = 0, n = checkboxes.length; i < n; i++) {
        checkboxes[i].checked = false; //source.checked;
    }
}
