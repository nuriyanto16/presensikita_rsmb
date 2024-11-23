"use strict";

jQuery(document).ready(function ($) {
    $('#dt-list').DataTable({
        responsive: true,
        searching: true,
        paging: true,
        lengthChange: false,
        order: [[0, 'desc']]
    });
    $('table tbody tr').click(function () {
        window.location = $(this).attr('href');
        return false;
    });
});
