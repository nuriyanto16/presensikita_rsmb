"use strict";

jQuery(document).ready(function ($) {
    // click find
    let btnCari = $("#btn-cari");
    btnCari.on('click', function (e) {
        e.preventDefault();
        $('#modal-popupposition').modal('show');
    });
    if ($('#position_code').val() !== '') {
        btnCari.prop('disabled', true);
    }

    // popup dok
    let ePopup = $('#dt-popup-position');
    let dtPopup = ePopup.DataTable({
        processing: true,
        serverSide: true,
        autoWidth: false,
        deferLoading: 0,
        select: {
            style: 'single'
        },
        ajax: {
            url: base_url + 'utility/conf_approval/position_unit_lists',
            type: 'post'
            , data: function (d) {
                d.filter_comp = $("#comp_code").val();
            }
        },
        columns: [
            {data: 'position_code', width: '15%'},
            {data: 'position_desc', width: '35%'},
            {data: 'unit_code', width: '15%'},
            {data: 'unit_name', width: '35%'}
        ],
        rowId: 'id'
    });
    $('#modal-popupposition').on('shown.bs.modal', function () {
        dtPopup.columns.adjust();
        dtPopup.ajax.reload();
    });

    // click get selected dok
    $('#btn-getdok').on('click', function (e) {
        e.preventDefault();
        let selectedData = null;
        $.each(dtPopup.rows('.selected').data(), function () {
            selectedData = this;
        });
        getDok(selectedData);
    });
    ePopup.find('tbody').on('dblclick', 'tr', function () {
        let selectedData = dtPopup.row(this).data();
        getDok(selectedData);
    });

    function getDok(data) {
        if (data == null) {
            return;
        }

        $('#position_code').val(data['position_code']);
        $('#position_desc').val(data['position_desc']);
        $('#unit_id').val(data['unit_code']);
        $('#unit_name').val(data['unit_name']);
        $('#modal-popupposition').modal('hide');
    }

    // on submit
    $('#btn-save').on('click', function () {
        $("#actionf").val('save');
        $("#fmain").submit();
    });
});
