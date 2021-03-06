<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends AdminController
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('dashboard_model');/*
        $this->load->model('staff_model');
        $this->staff_model->update(array('lastname'=>'Fr&uuml;hling'),1);*/
    }

    /* This is admin dashboard view */
    public function index()
    {
        close_setup_menu();
        $this->load->model('departments_model');
        $this->load->model('todo_model');
        $data['departments'] = $this->departments_model->get();

        /*       if ($GLOBALS['current_user']->role == 2) {
                   redirect(admin_url() . 'clients');
               }*/

        $data['todos'] = $this->todo_model->get_todo_items(0);
        // Only show last 5 finished todo items
        $this->todo_model->setTodosLimit(5);
        $data['todos_finished'] = $this->todo_model->get_todo_items(1);
        $data['upcoming_events_next_week'] = $this->dashboard_model->get_upcoming_events_next_week();
        $data['upcoming_events'] = $this->dashboard_model->get_upcoming_events();
        $data['title'] = _l('dashboard_string');
        $this->load->model('currencies_model');
        $data['currencies'] = $this->currencies_model->get();
        $data['base_currency'] = $this->currencies_model->get_base_currency();
        $data['activity_log'] = $this->misc_model->get_activity_log();
        // Tickets charts
        $tickets_awaiting_reply_by_status = $this->dashboard_model->tickets_awaiting_reply_by_status();
        $tickets_awaiting_reply_by_department = $this->dashboard_model->tickets_awaiting_reply_by_department();

        $data['tickets_reply_by_status'] = json_encode($tickets_awaiting_reply_by_status);
        $data['tickets_awaiting_reply_by_department'] = json_encode($tickets_awaiting_reply_by_department);

        $data['tickets_reply_by_status_no_json'] = $tickets_awaiting_reply_by_status;
        $data['tickets_awaiting_reply_by_department_no_json'] = $tickets_awaiting_reply_by_department;

        $data['projects_status_stats'] = json_encode($this->dashboard_model->projects_status_stats());
        $data['leads_status_stats'] = json_encode($this->dashboard_model->leads_status_stats());
        $data['google_ids_calendars'] = $this->misc_model->get_google_calendar_ids();
        $data['bodyclass'] = 'dashboard invoices-total-manual';
        $this->load->model('announcements_model');
        $data['staff_announcements'] = $this->announcements_model->get();
        $data['total_undismissed_announcements'] = $this->announcements_model->get_total_undismissed_announcements();

        $this->load->model('projects_model');
        $data['projects_activity'] = $this->projects_model->get_activity('', hooks()->apply_filters('projects_activity_dashboard_limit', 20));
        add_calendar_assets();
        $this->load->model('utilities_model');
        $this->load->model('estimates_model');
        $data['estimate_statuses'] = $this->estimates_model->get_statuses();

        $this->load->model('proposals_model');
        $data['proposal_statuses'] = $this->proposals_model->get_statuses();

        $wps_currency = 'undefined';
        if (is_using_multiple_currencies()) {
            $wps_currency = $data['base_currency']->id;
        }
        $data['weekly_payment_stats'] = json_encode($this->dashboard_model->get_weekly_payments_statistics($wps_currency));

        $data['dashboard'] = true;

        $data['user_dashboard_visibility'] = get_staff_meta(get_staff_user_id(), 'dashboard_widgets_visibility');

        if (!$data['user_dashboard_visibility']) {
            $data['user_dashboard_visibility'] = [];
        } else {
            $data['user_dashboard_visibility'] = unserialize($data['user_dashboard_visibility']);
        }
        $data['user_dashboard_visibility'] = json_encode($data['user_dashboard_visibility']);

        $data = hooks()->apply_filters('before_dashboard_render', $data);
        $this->load->view('admin/dashboard/dashboard', $data);
    }

    /* Chart weekly payments statistics on home page / ajax */
    public function weekly_payments_statistics($currency)
    {
        if ($this->input->is_ajax_request()) {
            echo json_encode($this->dashboard_model->get_weekly_payments_statistics($currency));
            die();
        }
    }

    public function clean()
    {
        $this->db->truncate(db_prefix() . 'occupations');
        $this->db->truncate(db_prefix() . 'mieters');
        redirect(admin_url());
    }

    public function migrate_aq()
    {
        $this->load->model('wohnungen_model');
        $this->load->model('wohnungen_inventar_model');
        $aqs = $this->wohnungen_model->get();
        foreach ($aqs as $aq) {
            if ($aq['austattung']) {
                $austattung = unserialize($aq['austattung']);
                $a_qty = unserialize($aq['a_qty']);
                foreach ($austattung as $k => $item) {
                    $data = array('aq_id' => $aq['id'], 'inventar_id' => $item, 'qty' => $a_qty[$k]);
                    $this->wohnungen_inventar_model->add($data);
                }
            }
        }
        redirect(admin_url());


    }


    public function m_date()
    {

        $this->load->model('belegungsplan_model');

        $mieters = $this->belegungsplan_model->get();
        foreach ($mieters as $mieter) {
            $arrData = [];
            $arrData['belegt_b'] = $mieter['belegt_b'];
            $arrData['belegt_v'] = $mieter['belegt_v'];
            $this->belegungsplan_model->update($arrData, $mieter['id']);
        }
        redirect(admin_url());
    }

    public function update_menu()
    {

        update_option($_POST['menu_slug'], $_POST['name']);
        if ($_POST['menu_slug'] == 'all_contacts') {
            redirect(admin_url('clients/' . $_POST['menu_slug']));
        } else if ($_POST['menu_slug'] == 'inventarlistes') {
            redirect(admin_url('wohnungen/' . $_POST['menu_slug']));
        } else if ($_POST['menu_slug'] == 'move_inventory') {
            redirect(admin_url('wohnungen/' . $_POST['menu_slug']));
        } else {
            redirect(admin_url($_POST['menu_slug']));
        }
    }

    public function pdf()
    {

        try {
            $pdf = template_pdf();
        } catch (Exception $e) {
            $message = $e->getMessage();
            echo $message;
            if (strpos($message, 'Unable to get the size of the image') !== false) {
                show_pdf_unable_to_get_image_size_error();
            }
            die;
        }
        $type = 'I';
        $pdf->Output(mb_strtoupper(slug_it('$invoice_number')) . '.pdf', $type);
    }
}
