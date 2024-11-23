var pathArray = window.location.pathname.split('/');
var lastday = function(y,m){
       return  new Date(y, m, 0).getDate();
   }

$(document).ready(function(){

   $('.tanggals').datepicker({
      format   : 'dd-mm-yyyy',
      clearBtn : true,
      autoclose: true,
      language : 'id',
      readonly : false
   });

   var mon_id = $('[name="id"]').val();
   if(mon_id){
      console.log(mon_id);
      getPeriode_bulan(mon_id);
   }

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
      var value = $(this).val();
      getPeriode_bulan();
   });

   $('#periode_bulan').on('change', function(){
         var x = $(this).val();
         // var year =  $('#periode_tahun').val();
         if(x < 10){
            x = "0"+x;
         }
         if(x > 0 || x != ""){
            var ids = $('#periode_risiko_id').val();
            $.ajax({
                  url : base_url + "reference/masa_akses_input/get_periode",
                  type: "POST",
                  dataType: "JSON",
                  data : {id_periode : ids},
                     success: function(data) {
                        
                        var nil1 = data.start_date.split('-');
                        var per_awal = nil1[1];
                        var nil2 = data.end_date.split('-');
                        var per_akhir = nil2[1];
                        var year = nil1[2]; 

                        var setStart = '01-'+x+'-'+year;
                        var setEnd = lastday(year, x)+'-'+x+'-'+year;
                        if(per_awal == x){
                           setStart = data.start_date;
                        }else if(per_akhir == x){
                           setEnd =  data.end_date
                        }

                        $('.tanggals').datepicker('remove');
                        $('.tanggals').datepicker({
                           format   : 'dd-mm-yyyy',
                           clearBtn : true,
                           autoclose: true,
                           language : 'id',
                           setValue : setStart,
                           startDate: setStart,
                           endDate  : setEnd,
                           readonly : false
                        });
                        $('#start_date').attr('readonly', false);
                        $('#end_date').attr('readonly', false);
                        $('.tanggals').datepicker('update', year+'-'+x+'-01');
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

function setUnit(unitId) {
   $.ajax({
       type: "POST",
       url: base_url + 'utility/user_manage/getUnit',
       dataType: "JSON",
       data: {unitId: unitId},
       success: function (data) {
           $.each(data, function (unitId, unitName) {
               $('#unit_id').val(data.unitId);
               $('#unit').val(data.unitCode + " - " + data.unitName);
               $('#modalunit').modal('hide');
           });
       }
   });
   return false;
}

function getPeriode_bulan(mon_id){
   
   var periode_id = $('#periode_risiko_id').val();
   if(mon_id != "" && mon_id != null){
     $.ajax({
           url : base_url + "reference/masa_akses_input/get_monitoring_unlock",
           type: "POST",
           dataType: "JSON",
           data : {mon_id : mon_id},
              success: function(data) {
                 var nil1 = data.start_date.split("-");
                 var nil2 = data.end_date.split("-");

                 $('#start_date').val(data.start_date);
                 $('#end_date').val(data.end_date);

                 setBulan(periode_id, data.periode_bulan);
                 $('.tanggals').datepicker('remove');
                 $('.tanggals').datepicker({
                    format   : 'dd-mm-yyyy',
                    clearBtn : true,
                    autoclose: true,
                    language : 'id',
                    setValue : "01-"+nil1[1]+"-"+nil1[2],
                    startDate: "01-"+nil1[1]+"-"+nil1[2],
                    endDate  : lastday(nil1[2], nil1[1])+"-"+nil1[1]+"-"+nil1[2],
                    readonly : false
                 });
        
                 // $('.tanggals').datepicker('update', nil1[2]+'-'+nil1[1]+'-01');
                 // $('#periode_bulan').val(data.periode_bulan);
                 $('.modal-title').html("Edit Akses Input Risiko Monitoring");
                 $("#modalAkses_mon").modal({backdrop: 'static',keyboard:false});
              },
              error: function (jqXHR, textStatus, errorThrown){
                 alert('Error get data from ajax');
              }
     });
   }else{
     $.ajax({
           url : base_url + "reference/masa_akses_input/get_periode",
           type: "POST",
           dataType: "JSON",
           data : {id_periode : periode_id},
              success: function(data) {
                 var nil1 = data.start_date.split("-");
                 var nil2 = data.end_date.split("-");
                 $('#periode_tahun').val(nil1[2]);
                 setBulan(periode_id);
                 $('.modal-title').html("Insert Akses Input Risiko Monitoring");
                 $("#modalAkses_mon").modal({backdrop: 'static',keyboard:false});
              },
              error: function (jqXHR, textStatus, errorThrown){
                 alert('Error get data from ajax');
              }
     });
   }
}

function setBulan(periode_id, datac){
   var bulan = ['-',
                'Januari',
                'Februari',
                'Maret',
                'April',
                'Mei',
                'Juni',
                'Juli',
                'Agustus',
                'September',
                'Oktober',
                'November',
                'Desember'];

      $.ajax({
         url : base_url + "reference/masa_akses_input/get_bulan",
         type: "POST",
         dataType: "JSON",
         data : {id_periode : periode_id},
            success: function(data) {
               var option = '';
               option += "<option value=''> - </option>";
               for (var i = 0; i < data.length; i++) {
                  if(datac == parseInt(data[i].periode_bulan)){
                     option += "<option value="+data[i].periode_bulan+" selected>"+bulan[data[i].periode_bulan]+"</option>";
                  }else{
                     option += "<option value="+data[i].periode_bulan+">"+bulan[data[i].periode_bulan]+"</option>";
                  }
               }

               $('#periode_bulan').html(option);
            },
            error: function (jqXHR, textStatus, errorThrown){
               alert('Error get data from ajax');
            }
      });
}