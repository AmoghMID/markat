<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php init_head(); ?>
<div id="wrapper">
    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="panel_s">

                    <div class="panel-body _buttons">
                        <h3><span><?php echo get_menu_option(c_menu(), 'Belegungsplan') ?></span>
                            <?php if (has_permission('menu', '', 'edit')):
                                ?>
                                <a id="edit-menu" href="#"><i class="fa fa-pencil"></i></a>
                            <?php endif; ?>
                        </h3>
                        <div style="display: flex">
                            <div><a href="#" class="btn btn-info mright5 pull-left display-block" data-toggle="modal"
                                    data-target="#newoccupation"><?php echo 'Erstellen'; ?></a></div>
                        </div>
                        <hr class="hr-panel-heading"/>
                        <div class="col-md-4" style="padding: 0">
                            <h3 style="margin-top:3px !important;">
                                Gesamt:<b><?php echo total_rows(db_prefix() . 'occupations'); ?></b></h3>
                            <div class="panel_s" style="margin: 0 !important;">
                                <div class="panel-body" style="padding: 8px">
                                    <?= widget_status_stats('occupations', $title); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="belegungsplan" class="panel-body my-container">
                        <!--             <div class="row mbot15">
                            <div class="col-md-8 col-md-offset-2">
                                <div class="row text-center sommary-wo">
                                    <div class="col-md-4 col-xs-6 ">
                                        <h3> Alle AQ's: <span
                                                    class="bold"> <?php /*echo total_rows(db_prefix() . 'wohnungen', ''); */ ?></span>
                                        </h3>
                                    </div>
                                    <div class="col-md-4 col-xs-6 ">
                                        <h3><i class="green-dd proint"></i> Frei: <span
                                                    class="bold"><?php /*echo total_rows(db_prefix() . 'wohnungen', 'belegt=1'); */ ?></span>
                                        </h3>
                                    </div>
                                    <div class="col-md-4 col-xs-6 ">
                                        <h3><i class="red-dd proint"></i> Belegt: <span
                                                    class="bold"><?php /*echo total_rows(db_prefix() . 'wohnungen', 'belegt=0'); */ ?></span>
                                        </h3>
                                    </div>
                                </div>
                            </div>
                        </div>-->

                        <div class="row" id="mieter-table">
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-12">
                                        <p class="bold"><?php echo _l('filter_by'); ?></p>
                                    </div>
                                </div>
                                <div class="row">
                                        <div class="col-md-3">
                                            <?php echo render_date_input('belegt_v', 'Belegt von');  ?>
                                        </div>
                                        <div class="col-md-3">
                                            <?php echo render_date_input('belegt_b', 'Belegt bis');  ?>
                                        </div>
                                    </div>
                                <div class="row">
                                    <!--                                    <div class="col-md-2 leads-filter-column">
                                        <?php
                                    /*                                        $belegt = array(array('id' => '0', 'value' => 'Nein'), array('id' => '1', 'value' => 'Ja'));
                                                                            echo render_select('belegt', $belegt, array('value', 'value'), '', '', array('data-width' => '100%', 'data-none-selected-text' => 'Frei?'), array()); */ ?>
                                    </div>
-->
                                    <div class="col-md-2 leads-filter-column">
                                        <?php echo render_select('strabe', $strabe, array('strabe', 'strabe'), '', '', array('data-width' => '100%', 'data-none-selected-text' => 'Straße'), array()); ?>
                                    </div>
                                    <div class="col-md-2 leads-filter-column">
                                        <?php echo render_select('hausnummer', $hausnummer, array('hausnummer', 'hausnummer'), '', '', array('data-width' => '100%', 'data-none-selected-text' => 'Nr.'), array()); ?>
                                    </div>
                                    <div class="col-md-2 leads-filter-column">
                                        <?php echo render_select('etage', $etage, array('etage', 'etage'), '', '', array('data-width' => '100%', 'data-none-selected-text' => 'Etage'), array()); ?>
                                    </div>
                                    <div class="col-md-2 leads-filter-column">
                                        <?php echo render_select('flugel', $flugel, array('flugel', 'flugel'), '', '', array('data-width' => '100%', 'data-none-selected-text' => 'Flügel'), array()); ?>
                                    </div>
                                    <div class="col-md-2 leads-filter-column">
                                        <?php echo render_select('schlaplatze', $schlaplatze, array('schlaplatze', 'schlaplatze'), '', '', array('data-width' => '100%', 'data-none-selected-text' => 'Schlafplätze'), array()); ?>
                                    </div>
                                    <div class="col-md-2 leads-filter-column">
                                        <?php echo render_select('mobiliert', $mobiliert, array('mobiliert', 'mobiliert'), '', '', array('data-width' => '100%', 'data-none-selected-text' => 'Möbliert'), array()); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                            <hr class="hr-panel-heading"/>
                        </div>
                        <style>
                            .green {
                                color: green !important
                                background: white;
                            }
                        </style>
                        <a href="#" class="bulk-actions-btn table-btn delete-all hide" id="sqdsqd"
                           data-table=".table-belegungsplan"><?php echo _l('Alle löschen'); ?></a>
                        <?php $this->load->view('admin/belegungsplan/table_html'); ?>

                        <div class="modal fade" id="newoccupation" tabindex="-1" role="dialog">
                            <div class="modal-dialog modal-md" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal"
                                                aria-label="Close"><span
                                                    aria-hidden="true">&times;</span></button>
                                        <h4 class="modal-title">
                                            <span>Erstellen </span><?php echo get_menu_option('belegungsplan', _l('Belegungsplan')); ?>
                                        </h4>
                                    </div>
                                    <div class="modal-body">
                                        <?php echo form_open(admin_url('belegungsplan/assign'), array('id' => 'dsds')); ?>
                                        <input type="hidden" value="0" name="belegungsplan_id" id="belegungsplan_id">
                                        <div class="row field-cloneb">
                                            <div class="col-md-6">
                                                <?php
                                                $value = ''; ?>
                                                <?php echo render_date_input('belegt_v', 'Belegt von', $value, array(), array(), '', 'startdate'); ?>
                                            </div>
                                            <div class="col-md-6">
                                                <?php $value = '' ?>
                                                <?php echo render_date_input('belegt_b', 'Belegt bis', $value, array(), array(), '', 'enddate'); ?>
                                            </div>
                                        </div>
                                        <br>
                                        <div class="row field-cloneb">
                                            <div class="col-md-6">
                                                <?php echo render_input('', 'Resttage', 0, 'number', array('readonly' => true), array(), '', 'resttage'); ?>
                                            </div>
                                            <div class="col-md-6">
                                                <?php echo render_input('', 'Ausstehend', 0, 'number', array('readonly' => true), array(), '', 'ausstehend'); ?>
                                            </div>
                                        </div>
                                        <br>

                                        <div class="row field-cloneb">
                                            <div class="col-md-6">
                                                <?php echo render_input('break_days', 'Break days', 0, 'number', array(), array(), '', 'break_days'); ?>
                                            </div>
                                        </div>
                                        <br>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <?php
                                                $mieters = $this->mieter_model->get_mieters();
                                                ?>
                                                <div class="select-placeholder form-group">
                                                    <label for="mieter" class="control-label" style="width: ;">
                                                        Mieter
                                                    </label>
                                                    <select class="selectpicker form-control" data-width="100%"
                                                            data-live-search="true"
                                                            name="mieter"  title="Nichts ausgewählt"
                                                            id="mieter"
                                                            data-show-subtext="true">
                                                        <?php foreach ($mieters as $mieter):
                                                            $occuped = $this->mieter_model->hasOccupations($mieter['id']);
                                                            $classAdd = $occuped ? "<i class='fa fa-check green'></i>" : "";
                                                            ?>
                                                            <?php $projektnv = ''; 
                                                                if(empty($mieter['projektname'])==false) { 
                                                                    $projektnv = ' ('.$mieter['projektname'].')';
                                                                } 
                                                            ?>

                                                            <option data-content="<?php echo $classAdd . ' ' .$mieter['fullname'] . ' ' . $mieter['nachname'] . ' ' . $mieter['vorname'] . ' ' . $mieter['strabe_m'] . ' ' . $mieter['hausnummer_m'].$projektnv ?>"
                                                                    value="<?= $mieter['id'] ?>"><?php echo  $mieter['fullname'] . ' ' . $mieter['nachname'] . ' ' . $mieter['vorname'] . ' ' . $mieter['strabe_m'] . ' ' . $mieter['hausnummer_m'].$projektnv ?>
                                                            </option>

                                                        <?php endforeach; ?>
                                                    </select>

                                                </div>
                                            </div>
                                            <style>.green {
                                                    color: green !important
                                                }</style>

                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-check">
                                                    <input type="checkbox" name="kein_m" class="form-check-input"
                                                           id="kein_m">
                                                    <label class="form-check-label" for="kein_m">Kein Mieter</label>
                                                </div>
                                            </div>
                                        </div>
                                        <br>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <?php echo render_select('wohnungen', array(), array('id', array('strabe', 'hausnummer', 'etage', 'flugel')), 'AQ', '', array('required' => true)); ?>
                                            </div>
                                        </div>
                                        <br>
                                        <div class="row">
                                            <div class="col-md-12 ">
                                                <label for="Weitere Einstellungen" class="control-label" style="width: ;">
                                                    Weitere Einstellungen
                                                </label>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4 ">
                                                <?php echo render_select('etage', $etage1, array('etage', 'etage'), '', '', array('data-width' => '100%', 'data-none-selected-text' => 'Etage'), array(),'','efilter'); ?>
                                            </div>
                                            <div class="col-md-4 ">
                                                <?php echo render_select('schlaplatze', $schlaplatze1, array('schlaplatze', 'schlaplatze'), '', '', array('data-width' => '100%', 'data-none-selected-text' => 'Schlafplätze'), array(),'','sfilter'); ?>
                                            </div>
                                            <div class="col-md-4 ">
                                                <?php echo render_select('mobiliert', $mobiliert1, array('mobiliert', 'mobiliert'), '', '', array('data-width' => '100%', 'data-none-selected-text' => 'Möbliert'), array(),'','mfilter'); ?>
                                            </div>
                                        </div>
                                        <br>
                                        <br>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="text-right">
                                                    <button type="submit"
                                                            class="btn btn-info"><?php echo _l('submit'); ?></button>
                                                </div>
                                            </div>
                                        </div>
                                        <?php echo form_close(); ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php init_tail(); ?>

<?php if (isset($_GET['ref_m'])) {
    ?>
    <script>
        $(function () {

            $('#newoccupation #mieter').val('<?= $_GET['ref_m'];?>');
            $('#newoccupation #mieter').selectpicker('refresh');
            $('#newoccupation').modal('show');
        });
    </script>
    <?php
} ?>

<script>
    $(function () {
        appValidateForm($('#dsds'), {belegt_v: 'required', belegt_b: 'required'});

        $("#kein_m").change(function () {
            if (this.checked) {
                $('#mieter').removeAttr('required');
            } else {
                $('#mieter').attr('required', true);
            }
        });

    });
</script>

<?php
foreach ($occupations as $occupation):
    $hisOccupations = $this->wohnungen_model->get_occupations($occupation['wohnungen']);


    ?>
    <div class="modal fade" id="calendarmx<?= $occupation['id'] ?>" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">

                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"
                            aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title"><?php echo _l('Kalender'); ?></h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="panel_s">
                                <div class="panel-body" style="overflow-x: auto;">
                                    <div class="dt-loader hide"></div>
                                    <div id="calendar_dd<?= $occupation['id'] ?>"></div>
                                </div>
                                <script>
                                    $(function () {
                                        var dd =  <?php echo json_encode($hisOccupations);?>;
                                        var data = [];
                                        var breackDay = [];
                                        for (let d of dd) {
                                            var stdate = moment(d.belegt_v).toDate();
                                            var b_mi = parseInt(d.break_days);
                                            var enddate = moment(d.belegt_b).toDate();

                                            var i = 0;
                                            var $progress_day = enddate;
                                            if (b_mi > 0) {
                                                while (i < b_mi) {
                                                    $progress_day = moment($progress_day).add(1, 'days').toDate();

                                                    if ($progress_day.getDay() == 0 || $progress_day.getDay() == 6) {
                                                    } else {
                                                        breackDay.push($progress_day.getTime());
                                                        i++;
                                                    }

                                                }

                                            }

                                            let ds = {name: d.fullname, startDate: stdate, endDate: enddate};
                                            data.push(ds);
                                        }

                                        $("#calendar_dd<?= $occupation['id'] ?>").calendar({
                                            enableContextMenu: true,
                                            language: 'de',
                                            enableRangeSelection: false,
                                            contextMenuItems: [/*
                                        {
                                            text: 'Update',
                                            click: editEvent
                                        },
                                        {
                                            text: 'Delete',
                                            click: deleteEvent
                                        }
                                    */],
                                            customDayRenderer: function (element, date) {
                                                if (breackDay.indexOf(date.getTime()) != -1) {
                                                    $(element).css('background-color', 'red');
                                                    $(element).css('color', 'white');
                                                    $(element).css('border-radius', '15px');
                                                }
                                            },
                                            mouseOnDay: function (e) {
                                                if (e.events.length > 0) {
                                                    var content = '';
                                                    content += '<div class="event-tooltip-content">'
                                                        + '<div class="event-name text-center"> <strong>Mieter</strong></div>'
                                                        + '<div class="event-name" style="color:' + e.events[0].color + '">  ' + e.events[0].name + '</div>'
                                                        + '</div>';

                                                    $(e.element).popover({
                                                        trigger: 'manual',
                                                        container: 'body',
                                                        html: true,
                                                        content: content
                                                    });

                                                    $(e.element).popover('show');
                                                }
                                            },
                                            mouseOutDay: function (e) {
                                                if (e.events.length > 0) {
                                                    $(e.element).popover('hide');
                                                }
                                            },
                                            dayContextMenu: function (e) {
                                                $(e.element).popover('hide');
                                            },
                                            dataSource: data
                                        });
                                    });
                                </script>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php
endforeach;
?>


</body>
</html>
