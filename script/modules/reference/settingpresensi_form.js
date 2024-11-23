"use strict";
$(document).ready(function () {
    let elCompanyId = $("#compid");
    let elMenuId = $("#id_menu");

    elCompanyId.select2({
        allowClear: false,
        placeholder: "- Pilih -"
    });
    elCompanyId.val(elCompanyId.attr('value')).trigger('change');
    elCompanyId.on('select2:select', function (e) {
    });

    elMenuId.select2({
        allowClear: false,
        placeholder: "- Pilih -"
    });
    elMenuId.val(elMenuId.attr('value')).trigger('change');
    elMenuId.on('select2:select', function (e) {
    });


    $('#start_date').datepicker({
        autoclose: true,
        format: 'dd-mm-yyyy'
    });

    $('#end_date').datepicker({
        autoclose: true,
        format: 'dd-mm-yyyy'
    });

    $("#start_date").inputmask("99-99-9999");
    $("#end_date").inputmask("99-99-9999");


});
