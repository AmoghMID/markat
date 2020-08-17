<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Belegungsplan extends AdminController
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('wohnungen_model');
        $this->load->model('mieter_model');
        $this->load->model('belegungsplan_model');
    }


    /* List all contracts */
    public function index()
    {
        close_setup_menu();
        $data['title'] = get_menu_option(c_menu(), 'Belegungsplan');
        $data['occupations'] = $this->belegungsplan_model->get_occupations();
        $data['strabe'] = $this->belegungsplan_model->get_grouped('strabe');
        $data['flugel'] = $this->belegungsplan_model->get_grouped('flugel');
        $data['schlaplatze'] = $this->belegungsplan_model->get_grouped('schlaplatze');
        $data['hausnummer'] = $this->belegungsplan_model->get_grouped('hausnummer');
        $data['mobiliert'] = $this->belegungsplan_model->get_grouped('mobiliert');
        $data['etage'] = $this->belegungsplan_model->get_grouped('etage');
        add_calendar_book_assets();
        $this->load->view('admin/belegungsplan/manage', $data);
    }


    public function table($clientid = '')
    {
        $this->app->get_table_data('belegungsplan', []);
    }


    public function assign()
    {
        if ($this->input->post()) {
            if ($_POST['belegungsplan_id'] == '0') {
                $id = $this->belegungsplan_model->add($this->input->post());
                if ($id) {
                    set_alert('success', _l('added_successfully', 'Belegungsplan'));
                    redirect(admin_url('belegungsplan'));
                }
            } else {
                $success = $this->belegungsplan_model->update($this->input->post(), $_POST['belegungsplan_id']);
                if ($success) {
                    set_alert('success', _l('updated_successfully', 'Belegungsplan'));
                }
                redirect(admin_url('belegungsplan'));
            }
        }
    }


    public function load_free_aq($start = null, $end = null, $etage = null, $schlaplatze = null, $mobiliert = null)
    {
        // Modified to Add Filter AQ Drop Down
        $aqs = $this->wohnungen_model->get_wohnungens();
        $belegungsplan = $this->belegungsplan_model->get_occupations();
        $etage = urldecode($etage);
        $schlaplatze = urldecode($schlaplatze);
        $mobiliert = urldecode($mobiliert);

        // Select option for  Erstellen Belegungsplan
        $optionsAQ = '<option value=""></option>';
        $optionsET = '<option value=""></option>';
        $optionsSC = '<option value=""></option>';
        $optionsMO = '<option value=""></option>';
        
        // Loop select all  AQ 
        foreach ($aqs as $k => $aq) {
            foreach ($belegungsplan as $b) {
                 // Condition Remove all AQ if date is not selected
                if( ( (empty($start) && empty($end) )|| ( (($start == null) || ($start == '')) && (($start == null) || ($start == '')) ) ) == True) 
                {  unset($aqs[$k]);  }
                
                // Condition Remove AQ based on ocupation dates 
                if ($b['wohnungen'] === $aq['id']) {
                    $bv = date("Y-m-d", strtotime($b['belegt_v']));
                    $bb = date("Y-m-d", strtotime('+' . $b['break_days'] . ' day', strtotime($b['belegt_b'])));
                    $vbv = date("Y-m-d", strtotime($start));
                    $vbb = date("Y-m-d", strtotime($end));
                    if (($vbv > $bb || $vbb < $bv) ){
                        $aqfilterflag = True;
                    } else{
                        unset($aqs[$k]); 
                    }
                }
            }
            
            // Condition is to filter the AQ based on passed Value of Etage -- by Amogh
            if ( ( ($etage == null) || ($etage == '') || ($etage == 'null') || (($aq['etage']) == $etage) ) == False )
            { 
                unset($aqs[$k]); 
            }

            // Condition is to filter the AQ based on passed Value of schlaplatze -- by Amogh
            if( (($schlaplatze == null) || ($schlaplatze == '') || ($schlaplatze == 'null') || ($aq['schlaplatze'] == $schlaplatze)) == False ) 
            {
                unset($aqs[$k]); 
            }
            
            // Condition is to filter the AQ based on passed Value of mobiliert -- by Amogh
            if ( (($mobiliert == null) || ($mobiliert == '') || ($mobiliert == 'null') ||  ($aq['mobiliert'] == $mobiliert)) == False ) 
            {
                unset($aqs[$k]); 
            }
            
            if(isset($aqs[$k])){
                // condition for adding project in AQ drop down 
                $projektnv = (empty($aq['project']))? ' ' : ' ('.$aq['project'].')' ;
                
                $optionsAQ .= '<option value="' . $aq['id'] . '">' . $aq['strabe'] . ' ' . $aq['hausnummer'] . ' ' . $aq['etage'] . ' ' . $k['flugel'] .' ' . $aq['schlaplatze'] .' ' . $aq['mobiliert'] .$projektnv.  ' </option>';
                // Comma is added to filter unique Value below
                $optionsET .= ',<option value="'.$aq['etage'].'">'.$aq['etage'].'</option>';
                $optionsSC .= ',<option value="'.$aq['schlaplatze'].'">'.$aq['schlaplatze'].'</option>';
                $optionsMO .= ',<option value="'.$aq['mobiliert'].'">'.$aq['mobiliert'].'</option>';
         
            }

            
        }


        // Removing comma and making array with unique value 
        $optionsET = implode('',array_unique(explode(',', $optionsET)));
        $optionsSC = implode('',array_unique(explode(',', $optionsSC)));
        $optionsMO = implode('',array_unique(explode(',', $optionsMO)));

        $optionAry = array(
            "optionsAQ"  => $optionsAQ,
            "optionsET"  => $optionsET,
            "optionsSC"  => $optionsSC,
            "optionsMO"  => $optionsMO,
            "etage"      => $etage,
            "schlaplatze"=> $schlaplatze,
            "mobiliert"  => $mobiliert

        );

        echo json_encode($optionAry);
        die();
    }
    


    public function load_aq($id)
    {
        $aq = $this->wohnungen_model->get($id);
        $options = '<option selected value="' . $aq->id . '">' . $aq->strabe . ' ' . $aq->hausnummer . ' ' . $aq->etage . ' ' . $aq->flugel . ' ' . $aq->schlaplatze . ' ' . $aq->mobiliert .' </option>';
        echo json_encode($options);
        die();
    }


    public function get($id)
    {
        $response = $this->belegungsplan_model->get($id);
        echo json_encode($response);
        die();
    }


    /* Change client status / active / inactive */
    public function change_status($id, $status)
    {
        if ($this->input->is_ajax_request()) {
            $this->belegungsplan_model->change_status($id, $status);
        }
    }


    /* Delete contract from database */
    public function delete($id)
    {
        /* if (!has_permission('contracts', '', 'delete')) {
             access_denied('contracts');
         }
         if (!$id) {
             redirect(admin_url('contracts'));
         }*/
        $response = $this->belegungsplan_model->delete($id);
        if ($response == true) {
            set_alert('success', _l('deleted', 'Wohnungen'));
        } else {
            set_alert('warning', _l('problem_deleting', 'wohnungen'));
        }
        redirect(admin_url('belegungsplan'));

    }

    public function bulk_delete()
    {
        $total_deleted = 0;
        if (isset($_POST['data'])) {
            if (isset($_POST['data'])) {
                $ids = $_POST['data'];
                foreach ($ids as $id) {
                    if ($this->belegungsplan_model->delete($id)) {
                        $total_deleted++;
                    }
                }
            }
            if (count($total_deleted) > 0) {
                set_alert('success', _l('deleted', get_menu_option('belegungsplan', 'Belegungsplan')));
            } else {
                set_alert('warning', _l('problem_deleting', 'Belegungsplan'));
            }
            echo admin_url('belegungsplan');
        } else {
            set_alert('warning', _l('problem_deleting', 'Belegungsplan'));
            echo false;
        }
    }


}
