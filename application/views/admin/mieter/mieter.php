<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php init_head(); ?>
<div id="wrapper">
    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <h4 class="customer-profile-group-heading"
                    style="margin: 0"><?= get_menu_option('mieter', _l('Mieter')) ?></h4>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="panel_s" id="mieter">
                    <div class="panel-body">
                        <?php
                        echo form_open($this->uri->uri_string(), array('class' => 'dropzone zone-dsd', 'id' => 'mieter-form'));
                        $this->load->view('admin/mieter/form');
                        echo form_close(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php init_tail(); ?>
<!-- init table tasks -->
<script>
    // Add additional server params $_POST
    var LeadsServerParams = {
        "belegt": "[name='belegt']",
        "strabe": "[name='strabe']",
        "schlaplatze": "[name='schlaplatze']",
        "mobiliert": "[name='mobiliert']",
        "etage": "[name='etage']",
        "flugel": "[name='flugel']",
    };

    leadsTableNotSearchable = leadsTableNotSortable = [];
    var filterArray = [];
    var ContractsServerParams = {};
    $.each($('._hidden_inputs._filters input'), function () {
        ContractsServerParams[$(this).attr('name')] = '[name="' + $(this).attr('name') + '"]';
    });

    var table_wohnungen = $('.table-wohnungen');
    var _table_api = initDataTable(table_wohnungen, admin_url + 'wohnungen/table', undefined, undefined, LeadsServerParams, [0, 'desc'], filterArray);

    $.each(LeadsServerParams, function (i, obj) {
        $('select' + obj).on('change', function () {
            table_wohnungen.DataTable().ajax.reload()
                .columns.adjust()
                .responsive.recalc();
        });
    });
    mieterDropzone = new Dropzone("#mieter-form-drop-zone", appCreateDropzoneOptions({
        clickable: '.add-post-attachments',
        url: admin_url + "mieter/ajax_save", paramName: "files",
        autoProcessQueue: false,
        addRemoveLinks: true,
        uploadMultiple: true,
        parallelUploads: app.options.newsfeed_maximum_files_upload,
        maxFiles: 40,
        init: function () {
            mieterDropzone = this;

            this.on('sending', function (file, xhr, formData) {
                // Append all form inputs to the formData Dropzone will POST
                var data = $('#mieter-form').serializeArray();
                $.each(data, function (key, el) {
                    formData.append(el.name, el.value);
                });
            });

            this.on("success", function (file) {
            });
        },
        removedfile: function (file) {

            x = confirm('Do you want to delete?');
            if (!x) return false;
            if (mieter_id != 0) {
                file.previewElement.remove();
            }
        },
        dragover: function (file) {
            $('#mieter-form-drop-zone').addClass('dropzone-active');
        },
        complete: function (file) {
            console.log(file);
            window.location.href = file.xhr.responseText;
        },
        drop: function (file) {
            $('#mieter-form-drop-zone').removeClass('dropzone-active');
        }
    }));


    $('#mieter-form #submit').on("click", function (e) {
        e.preventDefault();
        e.stopPropagation();
        $(window).unbind('beforeunload');
        if (mieterDropzone.getQueuedFiles().length > 0) {
            mieterDropzone.processQueue();
        } else {
            $.ajax({
                url: admin_url + "mieter/ajax_save",
                data: $("#mieter-form").serialize(),
                type: "POST",
                dataType: 'json',
                success: function (e) {
                    window.location.href = e;
                },
                error: function (e) {
                    window.location.href = e.responseText;
                }
            });
        }
    });


    // Get file extension
    function checkFileExt(filename) {
        filename = filename.toLowerCase();
        return filename.split('.').pop();
    }

</script>
</body>
</html>
