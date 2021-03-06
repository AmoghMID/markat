<?php

defined('BASEPATH') or exit('No direct script access allowed');
require_once(APPPATH . 'libraries/php_image_magician.php');

$dimensions = $pdf->getPageDimensions();

$info_right_column = '';
$info_left_column = '';

// Add logo
$info_left_column .= pdf_logo_url();

// Write top left logo and right column info/text
pdf_multi_row($info_left_column, $info_right_column, $pdf, ($dimensions['wk'] / 2) - $dimensions['lm']);

$pdf->ln(10);

$organization_info = '<div style="color:#424242;">';

$organization_info .= format_organization_info();

$organization_info .= '</div>';

pdf_multi_row($organization_info, '', $pdf, ($dimensions['wk'] / 2) - $dimensions['lm']);
if ($task_tag == 'full') {
    $tblhtml = '<br><br><h2 style="text-align: center">Dokumentation</h2><br>';
} else {
    $tblhtml = '<br><br><h2 style="text-align: center">Detail ' . get_menu_option('tasks', _l('Tasks')) . '</h2><br>';
}
$tblhtml .= '<table> 
<tr><th colspan="3"><strong>Betreff</strong></th> </tr>  
<tr><td colspan="3">' . $task->name . '</td></tr> 
<tr><th colspan="3"><strong>Description</strong></th> </tr>  
<tr><th colspan="3">' . $task->description . '</th> </tr>  
<tr><th><strong>Startdatum</strong></th> <th></th> <th><strong>Enddatum </strong></th> </tr>  
<tr><td>' . date('d.m.Y', strtotime($task->startdate)) . '</td> <td></td><td>' . date('d.m.Y', strtotime($task->duedate)) . '</td> </tr>';
if ($task_tag !== 'full') {
    $tblhtml .= '<tr><td colspan="3"><strong>Checklistpoints</strong></td></tr>';
    foreach ($task->checklist_items as $k => $ac):
        $tblhtml .= '<tr><td colspan="3">' . $ac['description'] . '</td></tr>';
    endforeach;
} else {
    $tblhtml .= '<tr><th colspan="3"><strong>Dokumentation before:</strong></th></tr>';
    $maxcols = 3;
    $i = 0;
    if (count($task->comments) > 0) {
        $tblhtml .= '<tr>';
        foreach ($task->comments as $comment) {
            if ($comment['moment'] == 0 && count($comment['attachments']) > 0) {
                foreach ($comment['attachments'] as $attachment) {
                    if ($i == $maxcols) {
                        $i = 0;
                        $tblhtml .= "</tr><tr>";
                    }
                    $relPath = get_upload_path_by_type('task') . $attachment['rel_id'] . '/';
                    $fullPath = $relPath . $attachment['file_name'];
                    $fname = pathinfo($fullPath, PATHINFO_FILENAME);
                    $fext = pathinfo($fullPath, PATHINFO_EXTENSION);
                    $thumbPath = $relPath . $fname . '_thumb.' . $fext;
                    $tblhtml .= '<td style="padding: 20px; width: 33.33%"><img src="' . $thumbPath . '"/> </td>';

                    $i++;
                }

            }
        }
        //Add empty <td>'s to even up the amount of cells in a row:
        while ($i <= $maxcols) {
            $tblhtml .= "<td>&nbsp;</td>";
            $i++;
        }
        $tblhtml .= '</tr>';
    }
    $tblhtml .= '<tr><th colspan="3"><strong>Dokumentation after:</strong></th></tr>';

    $i = 0;
    if (count($task->comments) > 0) {
        $tblhtml .= '<tr>';
        foreach ($task->comments as $comment) {
            if ($comment['moment'] == 1 && count($comment['attachments']) > 0) {
                foreach ($comment['attachments'] as $attachment) {
                    if ($i == $maxcols) {
                        $i = 0;
                        $tblhtml .= "</tr><tr>";
                    }
                    $relPath = get_upload_path_by_type('task') . $attachment['rel_id'] . '/';
                    $fullPath = $relPath . $attachment['file_name'];
                    $fname = pathinfo($fullPath, PATHINFO_FILENAME);
                    $fext = pathinfo($fullPath, PATHINFO_EXTENSION);
                    $thumbPath = $relPath . $fname . '_thumb.' . $fext;
                    $tblhtml .= '<td style="padding: 20px; width: 33.33%"><img src="' . $thumbPath . '"/> </td>';

                    $i++;
                }

            }
        }
        //Add empty <td>'s to even up the amount of cells in a row:
        while ($i <= $maxcols) {
            $tblhtml .= "<td>&nbsp;</td>";
            $i++;
        }
        $tblhtml .= '</tr>';
    }
}
if (isset($task->signature)) {
    $imageContent = file_get_contents($task->signature);
    $path = tempnam(sys_get_temp_dir(), 'prefix');

    file_put_contents($path, $imageContent);
    $tblhtml .= '<br><br><br><p style="text-align: right"><img src="' . $path . '"></p>';
}
$tblhtml .= '  
</table><style> 
table {
    width: 100%;
    border-collapse: separate;
    border-spacing: 0 10px;
}
</style>';
$pdf->writeHTML($tblhtml, true, false, false, false, '');

function boolVald($bool)
{
    return $bool == -1 ? 'Nein' : 'Ja';
}