"use strict";
var pathArray = window.location.pathname.split('/');
var lastday = function(y,m){
       return  new Date(y, m, 0).getDate();
   }
$(document).ready(function () {
    $('#start_date').datepicker({
        format: 'dd-mm-yyyy',
        clearBtn: true,
        autoclose: true,
        todayHighlight: true,
        readonly: false
    });
    $('#end_date').datepicker({
        format: 'dd-mm-yyyy',
        clearBtn: true,
        autoclose: true,
        todayHighlight: true,
        readonly: false
    });

   if($('#id').val() != ''){
      // $('#periode_tahun').datepicker({
      //    format: "yyyy",
      //    viewMode: "years", 
      //    minViewMode: "years",
      //    // minDate: '12-01-2020',
      //    // maxDate: new Date()
      // });
      
     
      
      // $('#tglMonAkhir').datepicker({
      //    format: 'dd-mm-yyyy',
      //    clearBtn: true,
      //    autoclose: true,
      //    language: 'id',
      //    // todayHighlight: true,
      //    readonly: false
      // });
   }



    // table akses_input_awal
    
    var dtList = new Tabulator("#dt-list", {
       
         columns: [{
               title: "#",
               field: "aksi",
               headerSort: false,
               formatter: "html",
               width: "10%"
            },
            {
               title: "Periode (Tahun)",
               field: "periode_tahun",
               sorter: "string",
               width: "25%"
            },
            {
               title: "Periode (Bulan)",
               field: "periode_bulan",
               sorter: "string",
               width: "25%"
            },
            {
               title: "Tanggal Mulai",
               field: "start_date",
               sorter: "string",
               width: "20%"
            },
            {
               title: "Tanggal Selesai",
               field: "end_date",
               sorter: "string",
               width: "20%"
            }
         ],
         locale: 'id',
         ajaxURL: base_url + "reference/masa_akses_input/lists3/"+pathArray[6],
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
               startRow = 0;
               endRow = 0;
            }
            let recordsFiltered = parseInt(response.recordsFiltered);
            let recordsTotal = parseInt(response.recordsTotal);

            $("#table-footer .tabulator-startrow").text(startRow);
            $("#table-footer .tabulator-endrow").text(endRow);
            $("#table-footer .tabulator-totalrow").text(recordsFiltered);

            let elTotalFilteredRow = $("#table-footer .tabulator-totalfilteredrow");
            elTotalFilteredRow.text("");
            if (recordsTotal > recordsFiltered) {
               elTotalFilteredRow.text(" (disaring dari " + recordsTotal +
                     " entri keseluruhan)");
            }
            return response;
         },
         footerElement: '<div id="table-footer" class="pull-left tabulator-info">' +
            'Menampilkan <span class="tabulator-startrow"></span> - <span class="tabulator-endrow"></span> dari ' +
            '<span class="tabulator-totalrow"></span> entri<span class="tabulator-totalfilteredrow"></span></div>',
         pagination: "remote",
         paginationSize: 25,
         paginationButtonCount: 10,
         paginationDataSent: {
            sorters: "order"
         },
         selectable: false
   });

   let searchThread = null;
   let elSearch = $("#tb-search");
   if (elSearch != null) {
         elSearch.keyup(function (e) {
            if ($(this).val().length < 3 && e.keyCode > 13) {
               return;
            }
            clearTimeout(searchThread);
            searchThread = setTimeout(function () {
               dtList.setFilter("", "like", elSearch.val());
            }, 600);
         });
   }
   // end table akses_input_awal

    $('#periode_risiko_id').select2();

    $('#periode_risiko_id').on('change', function(){
       var value = $('#periode_risiko_id').val();
       $.ajax({
            url : base_url + "reference/masa_akses_input/get_periode",
            type: "POST",
            dataType: "JSON",
            data : {id_periode : value},
               success: function(data) {
                  console.log(data);
                  $('#start_date').val(data.start_date);
                  $('#end_date').val(data.end_date);
               },
               error: function (jqXHR, textStatus, errorThrown){
                  alert('Error get data from ajax');
               }
      });
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

  $('#periode_bulan').on('change', function(){
      var x = $(this).val();
      var year =  $('#periode_tahun').val();
      if(x < 10){
         x = "0"+x;
      }

      var ids = $('#periode_risiko_id').val();
      $.ajax({
            url : base_url + "reference/masa_akses_input/get_periode",
            type: "POST",
            dataType: "JSON",
            data : {id_periode : ids},
               success: function(data) {
                  var per_awal = data.start_date.split('-');
                     per_awal = per_awal[1];
                  var per_akhir = data.end_date.split('-');
                     per_akhir = per_akhir[1];

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
         
                  $('.tanggals').datepicker('update', year+'-'+x+'-01');
               },
               error: function (jqXHR, textStatus, errorThrown){
                  alert('Error get data from ajax');
               }
      });
  });

  $('#simpanMon').on('click', function(){
      simpanMon();
      setTimeout(function () {
         dtList.setFilter("", "like", "");
      }, 600);
      
  });


});



function setBulan(awal, akhir, datac){
   console.log(datac);
   var bulan = [{'idx' : '1', 'nama' : 'Januari'},
                {'idx' : '2', 'nama' : 'Februari'},
                {'idx' : '3', 'nama' : 'Maret'},
                {'idx' : '4', 'nama' : 'April'},
                {'idx' : '5', 'nama' : 'Mei'},
                {'idx' : '6', 'nama' : 'Juni'},
                {'idx' : '7', 'nama' : 'Juli'},
                {'idx' : '8', 'nama' : 'Agustus'},
                {'idx' : '9', 'nama' : 'September'},
                {'idx' : '10', 'nama' : 'Oktober'},
                {'idx' : '11', 'nama' : 'November'},
                {'idx' : '12', 'nama' : 'Desember'}];
   var option = '';
   if(datac == "" || datac == null){
      option += "<option value=''> - </option>";
   }
    
   if(datac == "" || datac == null){
      for (var i = parseInt(awal); i <= parseInt(akhir); i++) {
         if(datac == parseInt(bulan[i-1].idx)){
            option += "<option value="+bulan[i-1].idx+" selected>"+bulan[i-1].nama+"</option>";
         }else if(i == parseInt(bulan[i-1].idx)){
            option += "<option value="+bulan[i-1].idx+">"+bulan[i-1].nama+"</option>";
         } 
      }
   }else{
      for (var i = 0; i < bulan.length; i++) {
         if(datac == parseInt(bulan[i].idx)){
            option += "<option value="+bulan[i].idx+" selected>"+bulan[i].nama+"</option>";
         }
      }
   }

   $('#periode_bulan').html(option);
}

function insertModal(mon_id){
      clear_mon();
      var value = $('#periode_risiko_id').val();
       if(mon_id != "" && mon_id != null){
         $.ajax({
               url : base_url + "reference/masa_akses_input/get_monitoring",
               type: "POST",
               dataType: "JSON",
               data : {mon_id : mon_id},
                  success: function(data) {
                     var nil1 = data.start_date.split("-");
                     var nil2 = data.end_date.split("-");
                     $('#periode_tahun').val(nil1[2]);
                     
                     $('#tglMonAwal').val(data.start_date);
                     $('#tglMonAkhir').val(data.end_date);
                     $('#id_mon').val(data.akses_risiko_mon_id);

                     setBulan(nil1[1],nil2[1], data.periode_bulan);
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
               data : {id_periode : value},
                  success: function(data) {
                     var nil1 = data.start_date.split("-");
                     var nil2 = data.end_date.split("-");
                     $('#periode_tahun').val(nil1[2]);
                     setBulan(nil1[1],nil2[1]);
                     $('.modal-title').html("Insert Akses Input Risiko Monitoring");
                     $("#modalAkses_mon").modal({backdrop: 'static',keyboard:false});
                  },
                  error: function (jqXHR, textStatus, errorThrown){
                     alert('Error get data from ajax');
                  }
         });
       }
}

function clear_mon(){
   $('#id_mon').val('');
   $('#periode_bulan').val('');
   $('#tglMonAwal').val('');
   $('#tglMonAkhir').val('');
}

function hapus(mon_id){
   var result = confirm('Hapus data ?');
  if(result){
      $.ajax({
            url : base_url + "reference/masa_akses_input/simpan_updateMonitoring",
            type: "POST",
            dataType: "JSON",
            data : { mon_id: mon_id, is_delete : 1},
               success: function(data) {
                  location.reload(); 
               },
               error: function (jqXHR, textStatus, errorThrown){
                  alert('Error get data from ajax');
               }
      });
  }
}

function simpanMon(){
   var periode_id = $('#periode_risiko_id').val();
   var tahun   = $('#periode_tahun').val();
   var bulan   = $('#periode_bulan').val();
   var awal    = $('#tglMonAwal').val();
   var akhir   = $('#tglMonAkhir').val();
   var mon_id   = $('#id_mon').val();

   var tawal = awal.split("-");
   var takhir = akhir.split("-");

   var nawal = 0;
   var nakhir = 0;

   if(awal != "" && akhir != ""){
      nawal = parseInt(tawal[0]+tawal[1]+tawal[2]);
      nakhir = parseInt(takhir[0]+takhir[1]+takhir[2]);
   }
   
     if(bulan != ""){
      if(nakhir < nawal || nawal == 0 || nakhir == 0 ){
        
         alert('Tanggal Selesai tidak boleh lebih dari tanggal Mulai !');
         // alert('Tanggal Selesai tidak boleh lebih dari tanggal Mulai !');
      }else{
          $.ajax({
               url : base_url + "reference/masa_akses_input/simpan_updateMonitoring",
               type: "POST",
               dataType: "JSON",
               data : {periode_id : periode_id, mon_id: mon_id, periode_bulan : bulan, start_date : awal,
                       end_date : akhir, is_delete : 0},
                  success: function(data) {
                     if(data){
                        // $("#dt-list").Tabulator().redraw(true);
                        $("#modalAkses_mon").modal('hide');
                     }else{
                        alert('Bulan sudah ada di list');
                     }
                  },
                  error: function (jqXHR, textStatus, errorThrown){
                     alert('Error get data from ajax');
                  }
         });
      }
     }else{
      alert('Pilih bulan terlebih dahulu !');
     }
}