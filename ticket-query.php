<?php
$ticketStatuses = array("Resolved", "In progress", "Closed", "Reopened");
function createListOptionElements($st){
    global $ticketStatuses;
    $result = "";
    foreach ($ticketStatuses as $status){
        $selected = '';
        if ($status == $st){
            $selected = "selected";
        }
        $result .= '<option value="'.$status.'" '.$selected.'>'.$status.'</option>';
    }
    return $result;
}

/*<option value="Resolved" selected>Resolved</option>
                <option value="In progress">In progress</option>
                <option value="Closed">Closed</option>
                <option value="Reopened">Reopened</option>*/