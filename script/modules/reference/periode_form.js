"use strict";
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

    $('#btn-save').submit(function() {
      var tglAwal = $('#start_date').val();
      var tglAkhir = $('#end_date').val();

      var nil1 = tglAwal.split("-");
      var nilai1 = nil1[2]+nil1[1]+nil1[0];
      var nil2 = tglAkhir.split("-");
      var nilai2 = nil2[2]+nil2[1]+nil2[0];
      alert(nilai1);
      if (nilai1 > nilai2) {
         alert('Tanggal Berangkat tidak boleh melebihi Tanggal Kembali !');
          return false;
      } else {
          return true;
      }
  });
});
