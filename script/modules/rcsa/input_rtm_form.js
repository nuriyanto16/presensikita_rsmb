"use strict";

$(document).ready(function () {
    // let elCompanyId = $("#comp_id");
    // elCompanyId.select2({
    //     allowClear: false,
    //     placeholder: "- Pilih -"
    // });
    // elCompanyId.val(elCompanyId.attr('value')).trigger('change');

    $('#rcsa_tgl').datepicker({
        format: 'dd-mm-yyyy',
        clearBtn: true,
        autoclose: true,
        todayHighlight: true,
        readonly: false
    });

    let elPeriodeRisiko = $("#periode_risiko_id");
    elPeriodeRisiko.select2({
        allowClear: false,
        placeholder: "- Pilih -"
    });
    elPeriodeRisiko.val(elPeriodeRisiko.attr('value')).trigger('change');

    let elJenisRisiko = $("#jenis_risiko_id");
    build_jenis_risiko();
    function build_jenis_risiko() {
        elJenisRisiko.html('');
        elJenisRisiko.val(elJenisRisiko.attr('value'));

        $.post(base_url + "rcsa/input_rtm/get_node_jenis_risiko", {}, function (data) {
            elJenisRisiko.html('');
            elJenisRisiko.select2ToTree({
                treeData: {
                    dataArr: data,
                    valFld: "id",
                    labelFld: "jenis_risiko_nama",
                    incFld: "children",
                    dftVal: null
                },
                allowClear: false,
                placeholder: '- Pilih -',
                multiple: false,
                width: '100%'
            });
            elJenisRisiko.val(elJenisRisiko.attr('value')).trigger('change');
        }, "json");
    }

    $("[data-politespace]").politespace();

    let elNilaiLC = $("#nilai_lc");
    function changeNilaiLC(elL, elC, elLC) {
        let nilaiL = parseInt(elC.val());
        let nilaiC = parseInt(elC.val());
        let nilaiLC = nilaiL*nilaiC;
        elLC.val(nilaiLC);
    }

    let elNilaiL = $("#nilai_l");
    elNilaiL.select2({
        allowClear: false,
        placeholder: "- Pilih -",
        minimumResultsForSearch: Infinity
    });
    elNilaiL.val(elNilaiL.attr('value')).trigger('change');
    elNilaiL.on('select2:select', function () {
        changeNilaiLC(elNilaiL, elNilaiC, elNilaiLC);
    });

    let elNilaiC = $("#nilai_c");
    elNilaiC.select2({
        allowClear: false,
        placeholder: "- Pilih -",
        minimumResultsForSearch: Infinity
    });
    elNilaiC.val(elNilaiC.attr('value')).trigger('change');
    elNilaiC.on('select2:select', function () {
        changeNilaiLC(elNilaiL, elNilaiC, elNilaiLC);
    });

    let elTargetLC = $("#target_lc");
    let elTargetL = $("#target_l");
    elTargetL.select2({
        allowClear: false,
        placeholder: "- Pilih -",
        width: "100%",
        minimumResultsForSearch: Infinity
    });
    elTargetL.val(elTargetL.attr('value')).trigger('change');
    elTargetL.on('select2:select', function () {
        changeNilaiLC(elTargetL, elTargetC, elTargetLC);
    });

    let elTargetC = $("#target_c");
    elTargetC.select2({
        allowClear: false,
        placeholder: "- Pilih -",
        width: "100%",
        minimumResultsForSearch: Infinity
    });
    elTargetC.val(elTargetC.attr('value')).trigger('change');
    elTargetC.on('select2:select', function () {
        changeNilaiLC(elTargetL, elTargetC, elTargetLC);
    });

    let elPerlakuanRisiko = $("#perlakuan_risiko_id");
    elPerlakuanRisiko.select2({
        allowClear: true,
        placeholder: "- Pilih -"
    });
    elPerlakuanRisiko.val(elPerlakuanRisiko.attr('value')).trigger('change');

    // table penyebab
    let dataPenyebab = '';
    let newIcon = function() {
        return "<button class='btn-primary' type='button' id='btn-add-penyebab'><i class='fa fa-plus'></i></button>";
    };
    let fmEditIcon = function(value, data, cell, row, options) {
        let fmBtnEdit = "<button class='btn-warning' type='button' title='edit'><i class='fa fa-pencil' title='edit'></i></button>";
        let fmBtnDelete = "<button class='btn-danger' type='button' title='delete'><i class='fa fa-trash' title='delete'></i></button>";
        return fmBtnEdit + "&nbsp;" + fmBtnDelete;
    };
    let dtListPenyebab = new Tabulator("#dt-list-penyebab", {
        columns: [
            {
                titleFormatter: newIcon, headerSort: false, formatter: fmEditIcon,
                width: "15%", align: "center", cssClass: "text-center",
                cellClick: function(e, cell) {
                    if (e.target.title === 'delete') {
                        if (confirm("Anda yakin akan menghapus data penyebab?")) {
                            cell.getRow().delete();
                        }
                    } else if (e.target.title === 'edit') {
                        let rowData = cell.getRow().getData();
                        elPenyebabRisiko.val(rowData.penyebab);
                        elPenyebabId.val(rowData.rcsa_penyebab_id);
                        elPenyebabSeq.val(rowData.rcsa_penyebab_seq);
                        elModalPenyebab.modal('show');
                    }
                }
            },
            {
                title: "Penyebab", field: "penyebab", sorter: "string", width: "85%",
                headerSort: false
            }
        ],
        locale: 'id',
        placeholder: "Tidak ada data",
        responsiveLayout:"collapse",
        pagination: "local",
        paginationSize: 10,
        paginationButtonCount: 2,
        paginationDataSent: {
            sorters: "order"
        },
        selectable: false
    });
    let elModalPenyebab = $('#modal-rcsa-penyebab');
    let elPenyebabRisiko = $('#penyebab_risiko');
    let elPenyebabId = $('input[name="rcsa_penyebab_id"]');
    let elPenyebabSeq = $('input[name="rcsa_penyebab_seq"]');
    let valRcsaPenyebab = $("input[name='rcsa_penyebab']").val();
    if (valRcsaPenyebab !== '') {
        dataPenyebab = $.parseJSON(valRcsaPenyebab);
        dtListPenyebab.setData(dataPenyebab);
    }
    $('#btn-add-penyebab').click(function () {
        elPenyebabId.val(""); elPenyebabSeq.val(""); elPenyebabRisiko.val("");
        elModalPenyebab.modal('show');
    });
    $('#btn-save-rcsa-penyebab').click(function () {
        let penyebabRisiko = elPenyebabRisiko.val();
        if (penyebabRisiko === '') return;

        dataPenyebab = dtListPenyebab.getData();
        if (elPenyebabSeq.val() === '') {
            let seqA = 1;
            if (dataPenyebab.length >= 1) seqA = dataPenyebab[dataPenyebab.length-1].rcsa_penyebab_seq + 1;
            dataPenyebab.push({
                rcsa_penyebab_seq: seqA,
                penyebab: penyebabRisiko,
                rcsa_penyebab_id: null
            });
        } else {
            let objIndex = dataPenyebab.findIndex((obj => obj.rcsa_penyebab_seq === parseInt(elPenyebabSeq.val())));
            if (objIndex >= 0) dataPenyebab[objIndex].penyebab = penyebabRisiko;
        }

        dtListPenyebab.replaceData(dataPenyebab);
        elModalPenyebab.modal('hide');
    });
    elModalPenyebab.on('shown.bs.modal', function() {
        elPenyebabRisiko.focus();
    });

    // on save
    $('#btn-save').on('click', function (e) {
        e.preventDefault();

        dataPenyebab = dtListPenyebab.getData();
        if (dataPenyebab && dataPenyebab.length > 0) {
            $("input[name='rcsa_penyebab']").val(JSON.stringify(dataPenyebab));
        }
        $("#actionf").val('save');
        $("#fmain").submit();
    });

    // on send
    $('#btn-send').on('click', function (e) {
        e.preventDefault();

        if (confirm("Anda yakin akan mengirim data RCSA?")) {
            dataPenyebab = dtListPenyebab.getData();
            if (dataPenyebab && dataPenyebab.length > 0) {
                $("input[name='rcsa_penyebab']").val(
                    JSON.stringify(dataPenyebab));
            }
            $("#actionf").val('send');
            $("#fmain").submit();
        }
    });
});
