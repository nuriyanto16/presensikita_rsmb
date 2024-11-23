"use strict";

jQuery(document).ready(function ($) {
    $('#dok_tgl').datepicker({
        format: 'dd-mm-yyyy',
        clearBtn: true,
        autoclose: true,
        todayHighlight: true,
        readonly: false,
        endDate: '0d'
    });

    let dPrev = $('#d_prev_file_dok');
    $('#documentViewer').FlowPaperViewer({
        config: {
            localeDirectory: base_url + "assets/plugins/flowpaper/locale/",

            Scale: 0.6,
            ZoomTransition: 'easeOut',
            ZoomTime: 0.5,
            ZoomInterval: 0.1,
            FitPageOnLoad: true,
            FitWidthOnLoad: true,
            FullScreenAsMaxWindow: false,
            ProgressiveLoading: false,
            MinZoomSize: 0.2,
            MaxZoomSize: 5,
            SearchMatchAll: false,
            InitViewMode: '',
            RenderingOrder: 'html5',
            StartAtPage: '',

            EnableWebGL: true,
            ViewModeToolsVisible: true,
            ZoomToolsVisible: true,
            NavToolsVisible: true,
            CursorToolsVisible: true,
            SearchToolsVisible: true,
            WMode: 'transparent',
            localeChain: 'en_US'
        }
    });

    $('#modal-popupdok').on('shown.bs.modal', function() {
        $FlowPaper('documentViewer').load({
            PDFFile: dPrev.attr("data-target")
        });
    });

    dPrev.click(function () {
        $('#modal-popupdok').modal('show');
    });
});
