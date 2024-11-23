"use strict";
$(document).ready(function () {
    $('#valid_from').datepicker({
        format: 'dd-mm-yyyy',
        clearBtn: true,
        autoclose: true,
        todayHighlight: true,
        readonly: false
    });
    $('#valid_to').datepicker({
        format: 'dd-mm-yyyy',
        clearBtn: true,
        autoclose: true,
        todayHighlight: true,
        readonly: false
    });
});
