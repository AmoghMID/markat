<?php defined('BASEPATH') or exit('No direct script access allowed');

$table_data = array(
    'ID',
    'Name',
    'Straße ',
    'Nr. ',
    'PLZ ',
    'Stadt ',
    'Beräumung ',
    'Baubeginn ',
    'Rückräumung ',
    'Bauende',
    'Aktiviert'
);

render_datatable($table_data, (isset($class) ? $class : 'rb'), [], [
    'data-last-order-identifier' => 'rb',
    'data-default-order' => get_table_last_order('rb'),
]);

