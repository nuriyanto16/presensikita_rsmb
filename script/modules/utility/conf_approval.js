let dataTable;

$(document).ready(function () {
    dataTable = $('#dt-list').DataTable({
        responsive: true,
        searching: true,
        paging: true,
        ordering: true,
        serverSide: true,
        stateSave: false,
        pageLength: 25,
        order: [[1, "asc"]],
        ajax: {
            url: base_url + "utility/conf_approval/lists",
            type: "POST",
            cache: false,
            complete: function () {
                $("#dt-list_processing").css("display", "none");
            }
            , data: function (d) {
                d.filter_comp = $("#filter_comp").val();
                d.filter_dok = $("#filter_dok").val();
            }
        },
        columns: [{
            data: 'aksi', className: 'text-center', orderable: false
        }, {
            data: 'urutan', className: 'text-center', orderable: true
        }, {
            data: 'position_desc', className: 'text-left', orderable: true
        }, {
            data: 'unit_name', className: 'text-left', orderable: true
        }, {
            data: 'group_app', className: 'text-center', orderable: false
        }]
    });

    let btnFilter = $('#btnFilter');
    btnFilter.on('click', function (e) {
        e.preventDefault();
        dataTable.ajax.reload();
    });
});
