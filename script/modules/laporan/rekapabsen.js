"use strict";
let dtList = null;
let dtListDetails = null;
$(document).ready(function () {

    let elPeriodeId = $("#periode_id");
    let elCompanyId = $("#compid");
    let elEmployeeId = $("#nik");
    let elbulanId = $("#bulan_id");
    let elUnitId = $("#unitid");
    let elBtnTampilkan = $('#btn-tampilkan');

    elbulanId.select2({
        allowClear: false,
        placeholder: "- Pilih Bulan -"
    });
    elbulanId.val(elbulanId.attr('value')).trigger('change');

    elPeriodeId.select2({
        allowClear: false,
        placeholder: "- Pilih Periode Tahun -"
    });
    elPeriodeId.val(elPeriodeId.attr('value')).trigger('change');

    elCompanyId.select2({
        allowClear: false,
        placeholder: "- Pilih Perusahaan -"
    });
    elCompanyId.val(elCompanyId.attr('value')).trigger('change');
    elCompanyId.on('select2:select', function (e) {
        elEmployeeId.attr('value', ''); 
        elEmployeeId.val('');
        build_employee(e.params.data.id, null);

        elUnitId.attr('value', ''); 
        elUnitId.val('');
        build_unit(e.params.data.id);

        //build_unit();

    });
    if (elCompanyId.val() !== "") {
        build_employee();
        
    }


    elUnitId.select2({
        allowClear: false,
        placeholder: "- Semua Unit Kerja -"
    });
    elUnitId.on('select2:select', function (e) {
        $("#nik_").val(e.params.data.id);

        elEmployeeId.attr('value', ''); 
        elEmployeeId.val('');
        build_employee(elCompanyId.val(), e.params.data.id);

    })
    function build_unit(p_COMPID) {
        if (p_COMPID == null) p_COMPID = elCompanyId.val();

        elUnitId.html('');

        $.post(base_url + "reference/employee/get_node_org", { COMPID: p_COMPID }, function (data) {
            elUnitId.select2ToTree({
                treeData: {
                    dataArr: data,
                    valFld: "id",
                    labelFld: "unitName",
                    incFld: "children",
                    dftVal: null
                },
                allowClear: false,
                placeholder: '- Pilih Unit Kerja -',
                multiple: false,
                width: '100%'
            });
            elUnitId.val(elUnitId.attr('value')).trigger('change');
        }, "json");
    }

    elEmployeeId.select2({
        allowClear: false,
        placeholder: "- Semua Karyawan -"
    });
    elEmployeeId.on('select2:select', function (e) {
        //$("#nik_").val(e.params.data.id);
    });

    function build_employee(p_COMPID, p_UNITID) {
        if (p_COMPID == null) p_COMPID = elCompanyId.val();
        if (p_UNITID == null) p_UNITID = elUnitId.val();
        elEmployeeId.html('');

        $.post(base_url + "reference/employee/get_node_employee", {
                UNITID : p_UNITID,
                COMPID : p_COMPID 
            }, 
            function (data) {
            elEmployeeId.select2ToTree({
                treeData: {
                    dataArr: data,
                    valFld: "emp_id",
                    labelFld: "emp_name",
                    incFld: "children",
                    dftVal: null
                },
                allowClear: false,
                placeholder: '- Semua Karyawan -',
                multiple: false,
                width: '100%'
            });
            elEmployeeId.val(elEmployeeId.attr('value')).trigger('change');
        }, "json");
    }



    //SUMMARY TABLE
    dtList = new Tabulator("#dt-list-summary", {
        columns: [
            {
                title: "Tahun", field: "tahun", sorter: "string",
                width: "8%",  align : "center"
            },{
                title: "Bulan", field: "bulan_nama", sorter: "string",
                width: "8%", headerFilter: "input"
            },{
                title: "NIK", field: "nik", sorter: "string",
                width: "8%", headerFilter: "input"
            },{
                title: "Nama", field: "emp_name", sorter: "string",
                width: "15%", headerFilter: "input", formatter:"textarea"
            },{
                title: "Unit Kerja", field: "unitName", sorter: "string",
                width: "15%", headerFilter: "input", formatter:"textarea"
            },{
                title: "Posisi", field: "position_desc", sorter: "string",
                width: "15%", headerFilter: "input", formatter:"textarea"
            },{
                title: "Jumlah <br/>Hadir", field: "jml_hadir", sorter: "string",
                width: "10%",  align : "center"
            },{
                title: "Jumlah <br/>Alpha", field: "jml_alpha", sorter: "string",
                width: "10%",  align : "center", cssClass: "text-center"
            },{
                title: "Jumlah <br/>Izin", field: "jml_izin", sorter: "string",
                width: "10%",  align : "center", cssClass: "text-center"
            },{
                title: "Jumlah <br/>Sakit", field: "jml_sakit", sorter: "string",
                width: "10%",  align : "center", cssClass: "text-center"
            },{
                title: "Jumlah <br/>Dinas Luar", field: "jml_dinas", sorter: "string",
                width: "10%",  align : "center", cssClass: "text-center"
            },{
                title: "Jumlah <br/>Jam Kerja", field: "jml_jam_kerja", sorter: "string",
                width: "10%",  align : "center", cssClass: "text-center"
            },{
                title: "Jumlah <br/>Kekurangan Jam", field: "jml_jam_kurang", sorter: "string",
                width: "14%",  align : "center", cssClass: "text-center"
            },{
                title: "Jumlah Pot<br/>Point Kehadiran", field: "jml_pot_point_kehadiran", sorter: "string",
                width: "14%",  align : "center", cssClass: "text-center"
            },{
                title: "Jumlah Pot<br/>Point Keterlambatan", field: "jml_pot_point_keterlambatan", sorter: "string",
                width: "14%",  align : "center", cssClass: "text-center"
            },{
                title: "Jumlah <br/>Lembur", field: "jml_jam_lembur", sorter: "string",
                width: "14%",  align : "center", cssClass: "text-center"
            },
        ],
        locale: 'id',
        placeholder: "Tidak ada data",
        ajaxURL: base_url + "laporan/rekapabsen/listssummary",
        ajaxConfig: "POST",
        ajaxSorting: true,
        ajaxFiltering: true,
        ajaxRequesting: function (url, params) {
            params.start = params.size * (params.page - 1);
            params.length = params.size;
        },
        ajaxResponse: function (url, params, response) {
            let pageSize = dtList.getPageSize();
            let pageNo = dtList.getPage();
            let startRow = (pageSize * (pageNo - 1)) + 1;
            let endRow = response.data.length + startRow - 1;
            if (response.data.length === 0) {
                startRow = 0; endRow = 0;
            }
            let recordsFiltered = parseInt(response.recordsFiltered);
            let recordsTotal = parseInt(response.recordsTotal);

            $("#table-footer .tabulator-startrow-summary").text(startRow);
            $("#table-footer .tabulator-endrow-summary").text(endRow);
            $("#table-footer .tabulator-totalrow-summary").text(recordsFiltered);

            let elTotalFilteredRow = $("#table-footer .tabulator-totalfilteredrow-summary");
            elTotalFilteredRow.text("");
            if (recordsTotal > recordsFiltered) {
                elTotalFilteredRow.text(" (disaring dari " + recordsTotal
                    + " entri keseluruhan)");
            }
            return response;
        },
        footerElement: '<div id="table-footer" class="pull-left tabulator-info">'
        + 'Menampilkan <span class="tabulator-startrow-summary"></span> - <span class="tabulator-endrow-summary"></span> dari '
        + '<span class="tabulator-totalrow-summary"></span> entri<span class="tabulator-totalfilteredrow-summary"></span></div>',
        pagination: "remote",
        paginationSize: 10,
        paginationButtonCount: 7,
        paginationDataSent: {
            sorters: "order"
        },
        selectable: false
    });


    //DETAIL TABLE
    dtListDetails = new Tabulator("#dt-list-details", {
        columns: [
            {
                title: "Tahun", field: "tahun", sorter: "string",
                width: "8%",  align : "center"
            },{
                title: "Bulan", field: "bulan_nama", sorter: "string",
                width: "8%", headerFilter: "input"
            },{
                title: "NIK", field: "nik", sorter: "string",
                width: "8%", headerFilter: "input"
            },{
                title: "Nama", field: "emp_name", sorter: "string",
                width: "15%", headerFilter: "input"
            },{
                title: "Unit Kerja", field: "unitName", sorter: "string",
                width: "15%", headerFilter: "input"
            },{
                title: "Posisi", field: "position_desc", sorter: "string",
                width: "15%", headerFilter: "input"
            },{
                title: "Tanggal", field: "tanggal", sorter: "string",
                width: "10%",  align : "center", cssClass: "text-center"
            },{
                title: "Kode <br/> jadwal", field: "kode_jadwal", sorter: "string",
                width: "8%",  align : "center", cssClass: "text-center"
            },{
                title: "Jam Masuk", field: "jam_masuk", sorter: "string",
                width: "10%",  align : "center", cssClass: "text-center"
            },{
                title: "Jam Pulang", field: "jam_pulang", sorter: "string",
                width: "10%",  align : "center", cssClass: "text-center"
            },{
                title: "Jadwal <br/> Masuk", field: "jdwl_masuk", sorter: "string",
                width: "10%",  align : "center", cssClass: "text-center"
            },{
                title: "Jadwal <br/> Pulang", field: "jdwl_pulang", sorter: "string",
                width: "10%",  align : "center", cssClass: "text-center"
            },{
                title: "Type Absen", field: "abs_type_desc", sorter: "string", formatter:"textarea", 
                width: "10%",  align : "center", cssClass: "text-center"
            },{
                title: "Keterangan", field: "keterangan", sorter: "string", formatter:"textarea", 
                width: "10%",  align : "center", cssClass: "text-center"
            },{
                title: "Ket. Libur", field: "ket_libur", sorter: "string", formatter:"textarea", 
                width: "10%",  align : "center", cssClass: "text-center"  
            },{
                title: "Jumlah <br/> Jam Kerja", field: "jml_jam_kerja", sorter: "string",
                width: "10%",  align : "center", cssClass: "text-center"
            },{
                title: "Jumlah <br/> Kekurangan Jam", field: "jml_jam_kurang", sorter: "string",
                width: "12%",  align : "center", cssClass: "text-center"
            },{
                title: "Status Terlambat", field: "jml_terlambat", sorter: "string",
                width: "10%",  align : "center", cssClass: "text-center"
            },
        ],
        locale: 'id',
        placeholder: "Tidak ada data",
        ajaxURL: base_url + "laporan/rekapabsen/listsdetail",
        ajaxConfig: "POST",
        ajaxSorting: true,
        ajaxFiltering: true,
        ajaxRequesting: function (url, params) {
            params.start = params.size * (params.page - 1);
            params.length = params.size;
        },
        ajaxResponse: function (url, params, response) {
            let pageSize = dtListDetails.getPageSize();
            let pageNo = dtListDetails.getPage();
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
        paginationSize: 30,
        paginationButtonCount: 7,
        paginationDataSent: {
            sorters: "order"
        },
        selectable: false
    });

    

    // action
    
    elBtnTampilkan.on('click', function (e) {

        setTimeout(function() {
            $("#preloader").fadeOut();
          }, 100);

        e.preventDefault();
    
        // dtList.setFilter("a.tahun", "=", elPeriodeId.val());
        // dtList.setFilter("a.compid", "=", elCompanyId.val());

        if(elPeriodeId.val() == '' || elbulanId.val() == '' || elCompanyId.val() == ''){
            alert("Silakan pilih filter !");
        }else{
            if(elEmployeeId.val() == null || elEmployeeId.val() == '' ){
                dtList.setFilter(
                    [
                        {field:"a.tahun", type:"=", value:elPeriodeId.val()}, 
                        {field:"a.bulan", type:"=", value:elbulanId.val()},  
                        {field:"a.compid", type:"=", value:elCompanyId.val()},
                        {field:"b.unitId", type:"=", value:elUnitId.val()}
                    ]
                );

                dtListDetails.setFilter(
                    [
                        {field:"a.tahun", type:"=", value:elPeriodeId.val()}, 
                        {field:"a.bulan", type:"=", value:elbulanId.val()},  
                        {field:"a.compid", type:"=", value:elCompanyId.val()},
                        {field:"b.unitId", type:"=", value:elUnitId.val()}
                    ]
                );


            }else{
                dtList.setFilter(
                    [
                        {field:"a.tahun", type:"=", value:elPeriodeId.val()}, 
                        {field:"a.bulan", type:"=", value:elbulanId.val()},  
                        {field:"a.compid", type:"=", value:elCompanyId.val()},
                        {field:"b.unitId", type:"=", value:elUnitId.val()},
                        {field:"a.emp_id", type:"=", value:(elEmployeeId.val() == null)  ? 0 : elEmployeeId.val()}
                    ]
                );

                dtListDetails.setFilter(
                    [
                        {field:"a.tahun", type:"=", value:elPeriodeId.val()}, 
                        {field:"a.bulan", type:"=", value:elbulanId.val()},  
                        {field:"a.compid", type:"=", value:elCompanyId.val()},
                        {field:"b.unitId", type:"=", value:elUnitId.val()},
                        {field:"a.emp_id", type:"=", value:(elEmployeeId.val() == null)  ? 0 : elEmployeeId.val()}
                    ]
                );
            }
        }



        //dtList.setData();    
        //dtList.redraw(true);

    });


        // action
    let elBtnGenerate= $('#btn-generate');
        elBtnGenerate.on('click', function (e) {
            e.preventDefault();
            let paramPost = $("#form").serialize();
        
    
            // get pie
            //resetPieData();
            $.ajax({
                type: "POST",
                url: base_url + "laporan/rekapabsen/generateabsen",
                data: paramPost,
                dataType: "json"
            }).done(function(data){
    
                alert(data.stat_generate);

                if(elEmployeeId.val() == null || elEmployeeId.val() == '' ){
                    dtList.setFilter(
                        [
                            {field:"a.tahun", type:"=", value:elPeriodeId.val()}, 
                            {field:"a.bulan", type:"=", value:elbulanId.val()},  
                            {field:"a.compid", type:"=", value:elCompanyId.val()},
                            {field:"b.unitId", type:"=", value:elUnitId.val()}
                        ]
                    );
    
                    dtListDetails.setFilter(
                        [
                            {field:"a.tahun", type:"=", value:elPeriodeId.val()}, 
                            {field:"a.bulan", type:"=", value:elbulanId.val()},  
                            {field:"a.compid", type:"=", value:elCompanyId.val()},
                            {field:"b.unitId", type:"=", value:elUnitId.val()}
                        ]
                    );
    
                }else{
                    dtList.setFilter(
                        [
                            {field:"a.tahun", type:"=", value:elPeriodeId.val()}, 
                            {field:"a.bulan", type:"=", value:elbulanId.val()},  
                            {field:"a.compid", type:"=", value:elCompanyId.val()},
                            {field:"a.emp_id", type:"=", value:(elEmployeeId.val() == null)  ? 0 : elEmployeeId.val()},
                            {field:"b.unitId", type:"=", value:elUnitId.val()}
                        ]
                    );
    
                    dtListDetails.setFilter(
                        [
                            {field:"a.tahun", type:"=", value:elPeriodeId.val()}, 
                            {field:"a.bulan", type:"=", value:elbulanId.val()},  
                            {field:"a.compid", type:"=", value:elCompanyId.val()},
                            {field:"a.emp_id", type:"=", value:(elEmployeeId.val() == null)  ? 0 : elEmployeeId.val()},
                            {field:"b.unitId", type:"=", value:elUnitId.val()}
                        ]
                    );
                }

            }).always(function() {
                //chartRkapTahunLalu.update();
                //chartRkapTahunIni.update();
            });
        });

        $('#btnExportSummary').on('click', function (e) {

            var comp_id = elCompanyId.val();
            var periode_id = elPeriodeId.val();
            var bulan_id = elbulanId.val();
            var emp_id = elEmployeeId.val();
            var unit_id = elUnitId.val();
            var type_print = "xls";

            if(emp_id == null ||emp_id== '' ){
                emp_id = 0;
            }
    
            if(comp_id!="" && periode_id!="" && bulan_id!="" ){
                var url = base_url + "laporan/rekapabsen/getExportSummary?comp_id="+comp_id+
                                                            "&unit_id="+unit_id+
                                                            "&periode_id="+periode_id+
                                                            "&bulan_id="+bulan_id+
                                                            "&emp_id="+emp_id+
                                                            "&type="+type_print;
    
                var win = window.open(url, '_blank');
                win.focus();
            }else{
                alert("Silakan lengkapi data !");
            }
            
        });


        $('#btnExportDetail').on('click', function (e) {

            var comp_id = elCompanyId.val();
            var periode_id = elPeriodeId.val();
            var bulan_id = elbulanId.val();
            var emp_id = elEmployeeId.val();
            var unit_id = elUnitId.val();
            var type_print = "xls";
            var varian = "1";

            if(emp_id == null ||emp_id== '' ){
                emp_id = 0;
            }
    
            if(comp_id!="" && periode_id!="" && bulan_id!="" ){
                var url = base_url + "laporan/rekapabsen/getExportDetail?comp_id="+comp_id+
                                                            "&unit_id="+unit_id+
                                                            "&periode_id="+periode_id+
                                                            "&bulan_id="+bulan_id+
                                                            "&emp_id="+emp_id+
                                                            "&type="+type_print+
                                                            "&varian="+varian;
    
                var win = window.open(url, '_blank');
                win.focus();
            }else{
                alert("Silakan lengkapi data !");
            }
            
        });

        $('#btnExportSummaryPdf').on('click', function (e) {

            var comp_id = elCompanyId.val();
            var periode_id = elPeriodeId.val();
            var bulan_id = elbulanId.val();
            var emp_id = elEmployeeId.val();
            var unit_id = elUnitId.val();
            var type_print = "pdf";

            if(emp_id == null ||emp_id== '' ){
                emp_id = 0;
            }
    
            if(comp_id!="" && periode_id!="" && bulan_id!="" ){
                var url = base_url + "laporan/rekapabsen/getExportSummary?comp_id="+comp_id+
                                                            "&unit_id="+unit_id+
                                                            "&periode_id="+periode_id+
                                                            "&bulan_id="+bulan_id+
                                                            "&emp_id="+emp_id+
                                                            "&type="+type_print;
    
                var win = window.open(url, '_blank');
                win.focus();
            }else{
                alert("Silakan lengkapi data !");
            }
            
        });

        $('#btnExportDetailPdf').on('click', function (e) {

            var comp_id = elCompanyId.val();
            var periode_id = elPeriodeId.val();
            var bulan_id = elbulanId.val();
            var emp_id = elEmployeeId.val();
            var unit_id = elUnitId.val();
            var type_print = "pdf";
            var varian = "1";

            if(emp_id == null ||emp_id== '' ){
                emp_id = 0;
            }

            if (emp_id != 0){
                if(comp_id!="" && periode_id!="" && bulan_id!="" ){
                    var url = base_url + "laporan/rekapabsen/getExportDetail?comp_id="+comp_id+
                                                                "&unit_id="+unit_id+
                                                                "&periode_id="+periode_id+
                                                                "&bulan_id="+bulan_id+
                                                                "&emp_id="+emp_id+
                                                                "&type="+type_print+
                                                                "&varian="+varian;
        
                    var win = window.open(url, '_blank');
                    win.focus();
                }else{
                    alert("Silakan lengkapi data !");
                }
            }else{
                alert("Untuk export pdf tipe ini direkomndasikan untuk filter 1 Karyawan !");
            }
            
        });


        $('#btnExportDetailV2').on('click', function (e) {

            var comp_id = elCompanyId.val();
            var periode_id = elPeriodeId.val();
            var bulan_id = elbulanId.val();
            var emp_id = elEmployeeId.val();
            var unit_id = elUnitId.val();
            var type_print = "xls";
            var varian = "2";

            if(emp_id == null ||emp_id== '' ){
                emp_id = 0;
            }
            
            if(comp_id!="" && periode_id!="" && bulan_id!="" ){
                var url = base_url + "laporan/rekapabsen/getExportDetail?comp_id="+comp_id+
                                                            "&unit_id="+unit_id+
                                                            "&periode_id="+periode_id+
                                                            "&bulan_id="+bulan_id+
                                                            "&emp_id="+emp_id+
                                                            "&type="+type_print+
                                                            "&varian="+varian;
    
                var win = window.open(url, '_blank');
                win.focus();
            }else{
                alert("Silakan lengkapi data !");
            }
            
        });

        $('#btnExportDetailPdfV2').on('click', function (e) {

            var comp_id = elCompanyId.val();
            var periode_id = elPeriodeId.val();
            var bulan_id = elbulanId.val();
            var emp_id = elEmployeeId.val();
            var unit_id = elUnitId.val();
            var type_print = "pdf";
            var varian = "2";

            if(emp_id == null ||emp_id== '' ){
                emp_id = 0;
            }

            if(comp_id!="" && periode_id!="" && bulan_id!="" ){
                var url = base_url + "laporan/rekapabsen/getExportDetail?comp_id="+comp_id+
                                                            "&unit_id="+unit_id+
                                                            "&periode_id="+periode_id+
                                                            "&bulan_id="+bulan_id+
                                                            "&emp_id="+emp_id+
                                                            "&type="+type_print+
                                                            "&varian="+varian;;
    
                var win = window.open(url, '_blank');
                win.focus();
            }else{
                alert("Silakan lengkapi data !");
            }
            
            
        });


});
