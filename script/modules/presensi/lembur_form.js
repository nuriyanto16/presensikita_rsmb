"use strict";
let dtListKaryawan;

$(document).ready(function () {
   
    let elTipeIzinId = $("#id_abs_type");
    
    $('#start_date').datepicker({
        autoclose: true,
        format: 'dd-mm-yyyy'
    });

    $("#start_time").inputmask("99:99:99");
    $("#end_time").inputmask("99:99:99");

    elTipeIzinId.select2({
        allowClear: false,
        placeholder: "- Pilih -"
    });
    elTipeIzinId.val(elTipeIzinId.attr('value')).trigger('change');

    let preloaded = jQuery.parseJSON($("#hid_detail_attachment").val());
    $('.input-images-1').imageUploader(
        {
            id: 'upload_files',
            name: 'upload_files',   
            label: 'Drag, Drop atau Klik untuk upload foto lampiran',
            preloaded: preloaded,
            imagesInputName: 'images',
            preloadedInputName: 'old_images'
        }
    );
    //http://localhost/presensikita/uploads/izin/ABCDE1/ABCDE1.IZ.05.2020.000002_5EB28915DAD1B_20200506165325_201609002_ABCDE1.png
    //$('#uploaded-image .zoomImg').attr('src', 'http://localhost/presensikita/uploads/izin/ABCDE1/ABCDE1.IZ.05.2020.000002_5EB28915DAD1B_20200506165325_201609002_ABCDE1.png');

    $('#btn-save').on('click', function (e) {
        e.preventDefault();
        if (confirm("Anda yakin akan menyimpan data ini?")) {
           
            let hidefile = $("#hid_detail_attachment").val();
           
            if(hidefile != '[]') {
                
                let ListDetAttach  = jQuery.parseJSON(hidefile);
                let jsonDetAttch = JSON.stringify(ListDetAttach);
                $("#hid_detail_attachment").val("");
                if (jsonDetAttch == '[]') jsonDetAttch = '';
                $("#hid_detail_attachment").val(jsonDetAttch);
                //$("input[name='hid_detail_attachment']").val(jsonDetAttch);
                
            }

            $("#actionf").val('save');
            $("#fmain").submit();
        }
    });

    $('#btn-approve').on('click', function (e) {
        e.preventDefault();
        if (confirm("Anda yakin akan menyetujui data ini?")) {
            let ListDetAttach  = jQuery.parseJSON($("#hid_detail_attachment").val());
            let jsonDetAttch = JSON.stringify(ListDetAttach);
            $("#hid_detail_attachment").val("");
            if (jsonDetAttch == '[]') jsonDetAttch = '';
            $("input[name='hid_detail_attachment']").val(jsonDetAttch);
            $("#actionf").val('approve');
            $("#fmain").submit();
        }
    });

    $('#btn-reject').on('click', function (e) {
        e.preventDefault();
        if (confirm("Anda yakin tidak setuju dengan pengajuan ini?")) {
            let ListDetAttach  = jQuery.parseJSON($("#hid_detail_attachment").val());
            let jsonDetAttch = JSON.stringify(ListDetAttach);
            $("#hid_detail_attachment").val("");
            if (jsonDetAttch == '[]') jsonDetAttch = '';
            $("input[name='hid_detail_attachment']").val(jsonDetAttch);
            $("#actionf").val('reject');
            $("#fmain").submit();
        }
    });



    //APPROVAL 2

    $('#btn-approve-ho').on('click', function (e) {
        e.preventDefault();
        if (confirm("Anda yakin akan menyetujui data ini?")) {
            let ListDetAttach  = jQuery.parseJSON($("#hid_detail_attachment").val());
            let jsonDetAttch = JSON.stringify(ListDetAttach);
            $("#hid_detail_attachment").val("");
            if (jsonDetAttch == '[]') jsonDetAttch = '';
            $("input[name='hid_detail_attachment']").val(jsonDetAttch);
            $("#actionf").val('approve-ho');
            $("#fmain").submit();
        }
    });

    $('#btn-reject-ho').on('click', function (e) {
        e.preventDefault();
        if (confirm("Anda yakin tidak setuju dengan pengajuan ini?")) {
            let ListDetAttach  = jQuery.parseJSON($("#hid_detail_attachment").val());
            let jsonDetAttch = JSON.stringify(ListDetAttach);
            $("#hid_detail_attachment").val("");
            if (jsonDetAttch == '[]') jsonDetAttch = '';
            $("input[name='hid_detail_attachment']").val(jsonDetAttch);
            $("#actionf").val('reject-ho');
            $("#fmain").submit();
        }
    });

    // CARI KARYAWAN

    dtListKaryawan = new Tabulator("#dt-listkaryawan", {
        height:300,
        columns: [
            {
                title: "NIP", field: "nik", sorter: "string",
                width: "200", headerFilter: "input"
            },
            {
                title: "Nama", field: "emp_name", sorter: "string",
                width: "250", headerFilter: "input"
            },
            {
                title: "Jabatan", field: "position_desc", sorter: "string",
                width: "200", headerFilter: "input"
            },
            {
                title: "Unit", field: "unitName", sorter: "string",
                width: "250", headerFilter: "input"
            },
            {
                title: "Unit Organisasi", field: "comp_name", sorter: "string",
                width: "250", headerFilter: "input",  formatter:"textarea"
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
            params.ref = true;
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
                var nik = rowData.nik;
                var nik_pegawai = rowData.pegawai_id;
                var emp_name = rowData.emp_name;
                var position_desc = rowData.position_desc;
                var unitName = rowData.unitName;
                var comp_name = rowData.comp_name;
                var compid = rowData.compId;
                
                //document.getElementById("nik").value = nik;
  
                $("#nik").val(nik_pegawai);
                $("#nik_pegawai").val(nik);
                $("#emp_name").val(emp_name);
                $("#position").val(position_desc);
                $("#unit").val(unitName);
                $("#comp_name").val(comp_name);
                $("#compid").val(compid);
                
                //$('#nik').prop('readonly',true);

                $('#modal_list_pegawai').modal('hide');
            }   
            
        }
    });
    //END CARI


});
