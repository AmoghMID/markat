<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php init_head(); ?>
<div id="wrapper">

    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="panel_s">
                    <div class="panel-body _buttons">
                        <h3><span><?php echo get_menu_option(c_menu(), 'Räumung/Beräumung') ?></span>
                            <?php if (has_permission('menu', '', 'edit')):
                                ?>
                                <a id="edit-menu" href="#"><i class="fa fa-pencil"></i></a>
                            <?php endif; ?></h3>
                    </div>

                    <div class="panel-body">
                        <div class="row" id="rb-table">
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-12">
                                        <p class="bold"><?php echo _l('filter_by'); ?></p>
                                    </div>
                                </div>
                                <div class="row"><!--
                                        <div class="col-md-2 leads-filter-column">
                                            <?php
                                    /*                                        $belegt = array(array('id' => '0', 'value' => 'Nein'), array('id' => '1', 'value' => 'Ja'));
                                                                            echo render_select('belegt', $belegt, array('value', 'value'), '', '', array('data-width' => '100%', 'data-none-selected-text' => 'Belegt?'), array()); */ ?>
                                        </div>-->

                                    <div class="col-md-2 leads-filter-column">
                                        <?php echo render_select('name', $name, array('fullname', 'fullname'), '', '', array('data-width' => '100%', 'data-none-selected-text' => 'Name')); ?>
                                    </div>
                                    <div class="col-md-2 leads-filter-column">
                                        <?php echo render_select('strabe', $strabe, array('strabe_m', 'strabe_m'), '', '', array('data-width' => '100%', 'data-none-selected-text' => 'Straße'), array()); ?>
                                    </div>
                                    <div class="col-md-2 leads-filter-column">
                                        <?php echo render_select('schlaplatze', $schlaplatze, array('hausnummer_m', 'hausnummer_m'), '', '', array('data-width' => '100%', 'data-none-selected-text' => 'Nr.'), array()); ?>
                                    </div>
                                    <div class="col-md-2 leads-filter-column">
                                        <?php echo render_select('plz', $plz, array('plz', 'plz'), '', '', array('data-width' => '100%', 'data-none-selected-text' => 'PLZ'), array()); ?>
                                    </div>
                                    <div class="col-md-2 leads-filter-column">
                                        <?php echo render_select('stadt', $stadt, array('stadt', 'stadt'), '', '', array('data-width' => '100%', 'data-none-selected-text' => 'Stadt'), array()); ?>
                                    </div>
                                    <div class="col-md-2 leads-filter-column">
                                        <?php echo render_date_input('beraumung', '', '', array('data-width' => '100%', 'placeholder' => 'Beraumung'), array()); ?>
                                    </div>

                                    <div class="col-md-2 leads-filter-column">
                                        <?php echo render_date_input('baubeginn', '', '', array('data-width' => '100%', 'placeholder' => 'Baubeginn'), array()); ?>
                                    </div>

                                    <div class="col-md-2 leads-filter-column">
                                        <?php echo render_date_input('ruckraumung', '', '', array('data-width' => '100%', 'placeholder' => 'Ruckraumung'), array()); ?>
                                    </div>

                                    <div class="col-md-2 leads-filter-column">
                                        <?php echo render_date_input('bauende', '', '', array('data-width' => '100%', 'placeholder' => 'Bauende'), array()); ?>
                                    </div>

                                </div>
                            </div>

                            <div class="clearfix"></div>
                            <hr class="hr-panel-heading"/>
                        </div>
                        <?php echo form_hidden('custom_view'); ?>
                        <div id="export-rb">
                            <?php $this->load->view('admin/rb/table_html'); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="contact_data"></div>
<?php init_tail(); ?>

<script>
    $(function () {

        $('.table').on('click', '.data-act', function (e) {
            e.preventDefault();
            var $td = $(this);
            if ($td.find('.datepicker').length < 1) {
                var text = $(this).html();
                var $input = $('<input class="form-control datepicker" value="' + text + '">');
                $td.html('').append($input);
                $input.datetimepicker({
                    onChangeDateTime: exampleFunction
                });
                init_datepicker();
            }
        })


        function exampleFunction() {
            console.log("Date Selected")
        }

        var table_rb = $('.table-rb');
        // Add additional server params $_POST
        var LeadsServerParams = {
            "strabe": "[name='strabe']",
            "schlaplatze": "[name='schlaplatze']",
            "mobiliert": "[name='mobiliert']",
            "etage": "[name='etage']",
            "name": "[name='name']",
            "plz": "[name='plz']",
            "stadt": "[name='stadt']",
            "beraumung": "[name='beraumung']",
            "baubeginn": "[name='baubeginn']",
            "ruckraumung": "[name='ruckraumung']",
            "bauende": "[name='bauende']",
            "project": "[name='project']",
            "flugel": "[name='flugel']",
        };

        belegunTableServer = leadsTableNotSortable = [];
        var filterArray = [];
        var ContractsServerParams = {};
        
        $.each($('._hidden_inputs._filters input'), function () {
            ContractsServerParams[$(this).attr('name')] = '[name="' + $(this).attr('name') + '"]';
        });

        var _table_api = initDataTable(table_rb, admin_url + 'rb/table', undefined, undefined, LeadsServerParams, [0, 'desc'], filterArray);

        $.each(LeadsServerParams, function (i, obj) {
            $('#' + i).on('change', function () {
                table_rb.DataTable().ajax.reload()
                    .columns.adjust()
                    .responsive.recalc();
            });
        });
        //new $.fn.dataTable.FixedHeader( _table_api );
       

    });


</script>
<!--link herf="https://cdn.datatables.net/fixedheader/3.1.7/css/fixedHeader.dataTables.min.css"></link>
<link herf="https://cdn.datatables.net/responsive/2.2.5/css/responsive.dataTables.min.css"></link>
<link herf="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css"></link-->
</body>
</html>
