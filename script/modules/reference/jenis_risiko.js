"use strict";
let dtList = null;
$(document).ready(function () {
    dtList = new Tabulator("#dt-list", {
        columns: [
            {
                title: "No", field: "jenis_risiko_no", sorter: "string",
                width: "15%", headerFilter: "input"
            },
            {
                title: "Nama", field: "jenis_risiko_nama", sorter: "string",
                width: "45%", headerFilter: "input"
            },
            {
                title: "Start Date", field: "start_date", sorter: "date",
                width: "15%", align: "center", cssClass: "text-center"
            },
            {
                title: "End Date", field: "end_date", sorter: "date",
                width: "15%", align: "center", cssClass: "text-center"
            },
            {
                title: "#", field: "aksi", headerSort: false, formatter: "html",
                width: "10%", align: "center", cssClass: "text-center"
            }
        ],
        locale: 'id',
        placeholder: "Tidak ada data",
        height: '800px',
        ajaxURL: base_url + "reference/jenis_risiko/lists",
        ajaxConfig: "POST",
        ajaxSorting: true,
        ajaxFiltering: true,
        ajaxRequesting: function (url, params) {
            params.start = params.size * (params.page - 1);
            params.length = params.size;
        },
        dataTree: true,
        dataTreeChildField: "children",
        dataTreeChildIndent: 15,
        pagination: "remote",
        paginationSize: 99999,
        paginationButtonCount: 10,
        paginationDataSent: {
            sorters: "order"
        },
        selectable: false
    });
});
