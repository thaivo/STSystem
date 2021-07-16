<?php
require_once 'ticket-query.php';
require_once 'user-query.php';
$ticketStatuses = array("Resolved", "In progress", "Closed", "Reopened");
function createListOptionElements($st): string
{
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
function getTicketById($id){
    $xml = simplexml_load_file("xml/SupportTickets.xml");
    return $xml->xpath("//SupportTicket[@Id='$id']")[0];
}

function getMessagesStrByMessagesObj($messages,$echo = false): string
{
    $listOfMessages = '';
    foreach ($messages->children() as $message) {
        //var_dump($message);
        /*echo "user: ".$message['UserId'];
        echo "Date: ".$message->Date;
        echo "Content: ".$message->Content;*/
        $listOfMessages .= '<li>
                                <div class="card m-2">
                                    <div class="card-header d-flex flex-row">
                                        <div class="flex-fill">';
        $listOfMessages .= 'From: ' . getUserFullNameById($message['UserId']);
        $listOfMessages .= '</div><div class="flex-fill">';
        $listOfMessages .= 'Date: ' . $message->Date;
        $listOfMessages .= '</div>
        </div>
        <div class="card-body">
            <p class="card-text">';
        $listOfMessages .= $message->Content;
        $listOfMessages .= '</p></div></div></li>';
    }
    if ($echo){
        echo $listOfMessages;
    }
    return $listOfMessages;
}
/*<option value="Resolved" selected>Resolved</option>
                <option value="In progress">In progress</option>
                <option value="Closed">Closed</option>
                <option value="Reopened">Reopened</option>*/