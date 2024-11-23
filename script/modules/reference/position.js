"use strict";
let dtList = null;
$(document).ready(function () {
    dtList = new Tabulator("#dt-list", {
        columns: [
            {
                title: "Kode", field: "position_code", sorter: "string",
                width: "50%", headerFilter: "input"
            },
            {
                title: "Nama", field: "position_desc", sorter: "string",
                width: "50%", headerFilter: "input"
            },
            // {
            //     title: "Organisasi", field: "unitName", sorter: "string",
            //     width: "23%", headerFilter: "input"
            // },
            // {
            //     title: "Valid From", field: "valid_from", sorter: "date",
            //     width: "12%"
            // },
            // {
            //     title: "Valid To", field: "valid_to", sorter: "date",
            //     width: "10%"
            // },
            // {
            //     title: "#", field: "aksi", headerSort: false, formatter: "html",
            //     width: "9%"
            // }
        ],
        locale: 'id',
        placeholder: "Tidak ada data",
        height: '800px',
        ajaxURL: base_url + "reference/position/lists",
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
        // footerElement: '<div id="table-footer" class="pull-left tabulator-info">'
        // + 'Menampilkan <span class="tabulator-startrow"></span> - <span class="tabulator-endrow"></span> dari '
        // + '<span class="tabulator-totalrow"></span> entri<span class="tabulator-totalfilteredrow"></span></div>',
        pagination: "remote",
        paginationSize: 9999,
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

    let elFilterCompany = $('#filter_company');
    elFilterCompany.select2({
        placeholder: '- Pilih Company -'
    });

    let btnFilter = $('#btnFilter');
    btnFilter.on('click', function (e) {
        e.preventDefault();
        dtList.setFilter("company_code", "=", elFilterCompany.val());
    });
});
