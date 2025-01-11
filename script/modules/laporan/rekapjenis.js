"use strict";
let dtList = null;
let dtListDetails = null;
$(document).ready(function () {

    let elPeriodeId = $("#periode_id");
    let elCompanyId = $("#compid");
    let elEmployeeId = $("#nik");
    let elbulanId = $("#bulan_id");
    let elUnitId = $("#unitid");
    let elJenisId = $("#jenis_id");
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

    
    elBtnTampilkan.on('click', function (e) {

        setTimeout(function() {
            $("#preloader").fadeOut();
          }, 100);

        e.preventDefault();
    
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

    $('#btnExportDetail').on('click', function (e) {

        var comp_id = elCompanyId.val();
        var periode_id = elPeriodeId.val();
        var bulan_id = elbulanId.val();
        var emp_id = elEmployeeId.val();
        var unit_id = elUnitId.val();
        var jenis_id = elJenisId.val();
        var type_print = "xls";
        var varian = "1";
        

        if(emp_id == null ||emp_id== '' ){
            emp_id = 0;
        }

        if(comp_id!="" && periode_id!="" && bulan_id!="" ){
            var url = base_url + "laporan/rekapjenis/getExportDetail?comp_id="+comp_id+
                                                        "&unit_id="+unit_id+
                                                        "&periode_id="+periode_id+
                                                        "&bulan_id="+bulan_id+
                                                        "&emp_id="+emp_id+
                                                        "&type="+type_print+
                                                        "&varian="+varian+
                                                        "&jenis_id="+jenis_id;

            var win = window.open(url, '_blank');
            win.focus();
        }else{
            alert("Silakan lengkapi data !");
        }
        
    });

    
});
