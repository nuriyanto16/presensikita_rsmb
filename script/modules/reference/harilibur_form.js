"use strict";
$(document).ready(function () {
    let elCompanyId = $("#compid");

    elCompanyId.select2({
        allowClear: false,
        placeholder: "- Pilih -"
    });
    elCompanyId.val(elCompanyId.attr('value')).trigger('change');

    $('#tanggal').datepicker({
        autoclose: true,
        format: 'dd-mm-yyyy'
    });

});
