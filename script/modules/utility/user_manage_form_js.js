"use strict";
let tableListUser;

$(document).ready(function () {
    tableListUser = $('#dt-listuser').DataTable({
        processing: true,
        responsive: true,
        serverSide: true,
        searching: true,
        info: true,
        paging: true,
        fixedHeader: true,
        autoWidth: false,
        ajax: {
            url: base_url + "utility/user_manage/list_user",
            type: "POST"
        },
        columnDefs: [{
            targets: [0],
            className: 'text-left',
            orderable: false,
            width: 5,
            "searchable": false
        }, {
            targets: [1],
            className: 'text-left',
            orderable: true,
            "searchable": true
        }, {
            targets: [2],
            className: 'text-left',
            orderable: true,
            "searchable": false
        }, {
            targets: [3],
            className: 'text-left',
            orderable: true,
            "searchable": true
        }, {
            targets: [4],
            className: 'text-left',
            orderable: true,
            "searchable": false
        }, {
            targets: [5],
            className: 'text-left',
            orderable: true,
            "searchable": false
        }, {
            targets: [6],
            className: 'text-left',
            orderable: true,
            "searchable": false
        }, {
            targets: [7],
            className: 'text-left',
            orderable: true,
            "searchable": false
        }]
    });

    var table = $('#dt-pilihunit').DataTable({
        language: {
            emptyTable: "Tidak ada data yang ditemukan",
            lengthMenu: "Tampil _MENU_",
            zeroRecords: "Tidak ditemukan - Maaf",
            info: "Menampilkan halaman _PAGE_ dari _PAGES_",
            infoEmpty: "Tidak ada catatan yang tersedia",
            infoFiltered: "(disaring dari _MAX_ catatan total)",
            search: "Cari Kode"
        },
        paginate: {
            Next: 'Selanjutnya',
            Last: 'Terakhir',
            First: 'Pertama',
            Previous: 'Sebelumnya'
        },
        processing: true,
        serverSide: true,
        searching: true,
        info: true,
        paging: true,
        fixedHeader: true,

        ajax: {
            url: base_url + "utility/user_manage/listUnit",
            type: "POST"
        },

        columnDefs: [{
            targets: [0],
            className: 'text-left',
            orderable: false,
            visible: false
        }, {
            targets: [1], className: 'text-left', orderable: true, visible: true
        }, {
            targets: [2], className: 'text-left', orderable: true, visible: true
        }, {
            targets: [3], className: 'text-left', orderable: true, visible: true
        }]
    });

    $('#dt-pilihunit tbody').on('click', 'tr', function () {
        var data = table.row(this).data();
        setUnit(data[0]);
    });

    //init
    $('#dt-popup-instansi-mu').DataTable({
        responsive: true,
        searching: true,
        paging: true,
        ordering: false,
        'ajax': base_url + 'reference/common/get_instansi_ref/'
    });

    $('#btn_cari_ins_mu').click(function () {
        $('#modal-karyawan').modal('show');
    });

    $("#btn_sinkronisasi").click(function () {
        var conf = confirm(
            'Apakah anda yakin akan melakukan sinkronisasi data karyawan ?');
        if (!conf) {
            return false;
        }

        $('#dvloading').show();
        $.ajax({
            type: "POST",
            url: base_url + 'utility/user_manage/sinkronisasi',
            timeout: 300000,
            dataType: "JSON",
            success: function (data) {
                tableListUser.ajax.reload();
                alert("berhasil");
                $('#dvloading').hide();
            }
        });
    });

    $("select#photo").wSelect();

    $.ajaxSetup({
        type: "POST",
        url: base_url + "utility/user_manage/getCompany",
        cache: false
    });

    // $("#company").change(function () {
    //     var value = $(this).val();
    //     if (value > 0) {
    //         $.ajax({
    //             data: {modul: 'site', compId: value},
    //             success: function (respond) {
    //                 $("#site").html(respond);
    //             }
    //         })
    //     }
    // });

    // $("#positionId").change(function () {
    //     var value = $(this).val();
    //     if (value > 0) {
    //         $.ajax({
    //             type: "POST",
    //             url: base_url + "utility/user_manage/getJabatanWakil",
    //             cache: false,
    //             data: {positionId: value},
    //             success: function (respond) {
    //                 $("#representPositionId").html(respond);
    //             }
    //         })
    //     }
    // });

    // $(document).ready(function () {
    //     $('#site').on('change', function () {
    //         if (!!this.value) {
    //             table.column(1).search(this.value).draw();
    //             console.log(this.value);
    //         } else {
    //             table.column(1).search(this.value).draw();
    //             console.log(this.value);
    //         }
    //     });
    // });

    // let elem = document.getElementById("represent");
    // if (elem != null) {
    //     elem.onchange = function () {
    //         if (elem.checked) {
    //             $("#represent_position").show();
    //         } else {
    //             $("#represent_position").hide();
    //         }
    //     };
    // }


    // CARI KARYAWAN

    if ($("#dt-listkaryawan").length > 0) {

        var dtListKaryawan = new Tabulator("#dt-listkaryawan", {
            height:300,
            columns: [
                {
                    title: "Company", field: "comp_name", sorter: "string",
                    width: "250", headerFilter: "input"
                },{
                    title: "NIK", field: "nik", sorter: "string",
                    width: "150", headerFilter: "input"
                },
                {
                    title: "Nama", field: "emp_name", sorter: "string",
                    width: "250", headerFilter: "input"
                },
                {
                    title: "Posisi", field: "position_desc", sorter: "string",
                    width: "250", headerFilter: "input"
                },
                {
                    title: "Organisasi", field: "unitName", sorter: "string",
                    width: "250", headerFilter: "input"
                }
            ],
            locale: 'id',
            placeholder: "Tidak ada data",
            ajaxURL: base_url + "reference/employee/lists",
            ajaxConfig: "POST",
            ajaxSorting: true,
            ajaxFiltering: true,
            ajaxRequesting: function (url, params) {
                params.start = params.size * (params.page - 1);
                params.length = params.size;
            },
            ajaxResponse: function (url, params, response) {
                let pageSize = dtListKaryawan.getPageSize();
                let pageNo = dtListKaryawan.getPage();
                let startRow = (pageSize * (pageNo - 1)) + 1;
                let endRow = response.data.length + startRow - 1;
                if (response.data.length === 0) {
                    startRow = 0; endRow = 0;
                }
                let recordsFiltered = parseInt(response.recordsFiltered);
                let recordsTotal = parseInt(response.recordsTotal);

                $("#table-footer .tabulator-startrow").text(startRow);
                $("#table-footer .tabulator-endrow").text(endRow);
                $("#table-footer .tabulator-totalrow").text(recordsFiltered);

                let elTotalFilteredRow = $("#table-footer .tabulator-totalfilteredrow");
                elTotalFilteredRow.text("");
                if (recordsTotal > recordsFiltered) {
                    elTotalFilteredRow.text(" (disaring dari " + recordsTotal
                        + " entri keseluruhan)");
                }
                return response;
            },
            footerElement: '<div id="table-footer" class="pull-left tabulator-info">'
            + 'Menampilkan <span class="tabulator-startrow"></span> - <span class="tabulator-endrow"></span> dari '
            + '<span class="tabulator-totalrow"></span> entri<span class="tabulator-totalfilteredrow"></span></div>',
            pagination: "remote",
            paginationSize: 10,
            paginationButtonCount: 7,
            paginationDataSent: {
                sorters: "order"
            },
            selectable: true,
            rowClick:function(e, row){

                let rowData = row.getData();
                if (rowData !== null) {
                    var compId = rowData.compId;
                    var compName = rowData.comp_name;
                    var empId = rowData.emp_id;
                    var nik = rowData.nik;
                    var unitId = rowData.unitId;
                    var unitName = rowData.unitName;
                    var positionId = rowData.positionId;
                    var positionDesc = rowData.position_desc

                    $("#compId").val(compId);
                    $("#compName").val(compName);
                    $("#empId").val(empId);
                    $("#nik").val(nik);
                    $("#unitId").val(unitId);
                    $("#unit").val(unitName);
                    $("#positionId").val(positionId);
                    $("#positionDesc").val(positionDesc);

                    $('#modal-karyawan').modal('hide');
                }
                
            }
        });
        //END CARI

    }


});

function setUnit(unitId) {
    $.ajax({
        type: "POST",
        url: base_url + 'utility/user_manage/getUnit',
        dataType: "JSON",
        data: {unitId: unitId},
        success: function (data) {
            $.each(data, function (unitId, unitName) {
                $('[name="unitId"]').val(data.unitId);
                $('[name="unit"]').val(data.unitCode + " - " + data.unitName);
                $('#modalunit').modal('hide');
            });
        }
    });
    return false;
}

function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
            document.getElementById("show_gambar").style.display = "block";
            $('#show_gambar')
            .attr('src', e.target.result)
            .width(150);
            //console.log(input.files);
        };
        reader.readAsDataURL(input.files[0]);
    }
}
