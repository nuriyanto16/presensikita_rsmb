$(document).ready(function(){

   let elCompanyId = $("#company_code");
   let elOrgCode = $("#unit_id");

      elCompanyId.select2({
            allowClear: false,
            placeholder: "- Pilih -"
      });

      elOrgCode.select2({
         allowClear: false,
         placeholder: "- Pilih -"
   });
   elCompanyId.val(elCompanyId.attr('value')).trigger('change');
   elCompanyId.on('select2:select', function (e) {
         // elParentPosition.attr('value', ''); elOrgCode.attr('value', '');
         // elParentPosition.val(''); elOrgCode.val('');
        
         build_unit(e.params.data.id);
   });
   if (elCompanyId.val() !== "") {
        build_unit();
   }

   $('.tanggals').datepicker({
      format   : 'dd-mm-yyyy',
      clearBtn : true,
      autoclose: true,
      language : 'id',
      readonly : false
   });

   function build_unit(p_compId) {
      if (p_compId == null) p_compId = elCompanyId.val();
      elOrgCode.html('');
      elOrgCode.val(elOrgCode.attr('value'));

      $.post(base_url + "reference/position/get_node_org", { compCode: p_compId }, function (data) {
          elOrgCode.select2ToTree({
              treeData: {
                  dataArr: data,
                  valFld: "id",
                  labelFld: "unitName",
                  incFld: "children",
                  dftVal: null
              },
              allowClear: false,
              placeholder: '- Pilih Organisasi -',
              multiple: false,
              width: '100%'
          });
          elOrgCode.val(elOrgCode.attr('value')).trigger('change');
      }, "json");
  }



   $('#periode_risiko_id').select2();

   $('#periode_risiko_id').on('change', function(){
      var value = $('#periode_risiko_id').val();
      if(value != ""){
         $.ajax({
               url : base_url + "reference/masa_akses_input/get_periode",
               type: "POST",
               dataType: "JSON",
               data : {id_periode : value},
                  success: function(data) {
                     $('#start_date').attr('readonly', false);
                     $('#end_date').attr('readonly', false);
                     $('#start_date').val(data.start_date);
                     $('#end_date').val(data.end_date);

                     $('.tanggals').datepicker('remove');
                     $('.tanggals').datepicker({
                        format   : 'dd-mm-yyyy',
                        clearBtn : true,
                        autoclose: true,
                        language : 'id',
                        setValue : data.start_date,
                        startDate: data.start_date,
                        endDate  : data.end_date,
                        readonly : false
                     });
                  },
                  error: function (jqXHR, textStatus, errorThrown){
                     alert('Error get data from ajax');
                  }
         });
      }else{
         $('.tanggals').datepicker('remove');
         $('#start_date').val("");
         $('#end_date').val("");
         $('#start_date').attr('readonly', true);
         $('#end_date').attr('readonly', true);
      }
   });

   $('#btn-save').submit(function() {
         var tglAwal = $('#start_date').val();
         var tglAkhir = $('#end_date').val();

         var nil1 = tglAwal.split("-");
         var nilai1 = nil1[2]+nil1[1]+nil1[0];
         var nil2 = tglAkhir.split("-");
         var nilai2 = nil2[2]+nil2[1]+nil2[0];
         alert(nilai1);
         if (nilai1 > nilai2) {
            alert('Tanggal Mulai tidak boleh melebihi Tanggal Selesai !');
            return false;
         } else {
            return true;
         }
   });
});

// function setUnit(unitId) {
//    $.ajax({
//        type: "POST",
//        url: base_url + 'utility/user_manage/getUnit',
//        dataType: "JSON",
//        data: {unitId: unitId},
//        success: function (data) {
//            $.each(data, function (unitId, unitName) {
//                $('#unit_id').val(data.unitId);
//                $('#unit').val(data.unitCode + " - " + data.unitName);
//                $('#modalunit').modal('hide');
//            });
//        }
//    });
//    return false;
// }