"use strict";
let dtList = null;
$(document).ready(function () {
    dtList = new Tabulator("#dt-list", {
        columns: [
            {
                title: "Kode", field: "unitCode", sorter: "string",
                width: "25%", headerFilter: "input"
            },
            {
                title: "Nama", field: "unitName", sorter: "string",
                width: "43%", headerFilter: "input"
            },
            {
                title: "Alias", field: "unitAlias", sorter: "string",
                width: "20%"
            },
            {
                title: "#", field: "aksi", headerSort: false, formatter: "html",
                width: "10%", align: "center", cssClass: "text-center"
            },
        ],
        locale: 'id',
        placeholder: "Tidak ada data",
        height: '700px',
        ajaxURL: base_url + "reference/organisasi/lists",
        ajaxConfig: "POST",
        ajaxSorting: true,
        ajaxFiltering: true,
        ajaxRequesting: function (url, params) {
            params.start = params.size * (params.page - 1);
            params.length = params.size;
            params.comp_id = elFilterCompany.val();
        },
        dataTree: true,
        dataTreeChildField: "children",
        dataTreeChildIndent: 20,
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
        dtList.setFilter("u.COMPID", "=", elFilterCompany.val());
    });

    dtList.setData();
});
