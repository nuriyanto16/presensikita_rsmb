"use strict";
$(document).ready(function () {
    let elCompanyId = $("#compid");

    elCompanyId.select2({
        allowClear: false,
        placeholder: "- Pilih -"
    });
    elCompanyId.val(elCompanyId.attr('value')).trigger('change');

    $('.allownumericwithdecimal').keyup(function () { 
        this.value = this.value.replace(/[^0-9\.-]/g,'');
    });
});
