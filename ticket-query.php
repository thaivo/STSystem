<?php
require_once 'ticket-query.php';
require_once 'user-query.php';
require_once 'utilities.php';
$ticketStatuses = array("Resolved", "In progress", "Closed", "Reopened", "Open");
$xml = simplexml_load_file("xml/SupportTickets.xml");
function createListOptionElementsForTicketStatus($st): string
{
    global $ticketStatuses;
    $result = "";
    foreach ($ticketStatuses as $status){
        $selected = '';
        if ($status == $st){
            $selected = "selected";
        }

        $result .= '<option id="ticketStatus_'.str_replace(" ","",$status).'" value="'.$status.'" '.$selected.'>'.$status.'</option>';
        //Reference: https://stackoverflow.com/questions/2000656/using-href-links-inside-option-tag
        //$result .= '<option id="ticketStatus_'.str_replace(" ","",$status).'" value="ticket-listing.php" '.$selected.'>'.$status.'</option>';
    }
    return $result;
}
function getTicketById($id){
    global $xml;
    return $xml->xpath("//SupportTicket[@Id='$id']")[0];
}

function getMessagesStrByMessagesObj($messages,$echo = false): string
{
    $listOfMessages = '';
    foreach ($messages->children() as $message) {
        $listOfMessages .= '<li><div class="card m-2"><div class="card-header d-flex flex-row"><div class="flex-fill">';
        $listOfMessages .= 'From: ' . getUserFullNameById($message['UserId']);
        $listOfMessages .= '</div><div class="flex-fill">';
        $listOfMessages .= 'Date: ' . $message->Date;
        $listOfMessages .= '</div></div><div class="card-body"><p class="card-text">';
        $listOfMessages .= $message->Content;
        $listOfMessages .= '</p></div></div></li>';
    }
    if ($echo){
        echo $listOfMessages;
    }
    return $listOfMessages;
}

function getTicketsByOwnerId($ownerId){
    global $xml;
    return $xml->xpath("//SupportTicket[@OwnerId='$ownerId']");
}

function updateTicketStatusByTicketId($ticketId, $ticketStatus): bool|string
{
    global $xml;
    $selectedTicket = $xml->xpath("//SupportTicket[@Id='$ticketId']")[0];
    $attributeName = "Status";
    $selectedTicket->attributes()->Status = $ticketStatus;
    return $xml->saveXML("xml/SupportTickets.xml");
}

function createTicket($ticketSubject, $ticketContent, $ownerId): bool|string
{
    //Assume
    $newTicketId = generateNewTicketId();
    //TODO:
    //global $xml;
    //$tickets = $xml->SupportTickets;
    $xml = simplexml_load_file("xml/SupportTickets.xml");
    $newTicket = $xml->addChild('SupportTicket');
    $newTicket->addAttribute('Id',$newTicketId);
    $newTicket->addAttribute('Status','Open');
    $newTicket->addAttribute('OwnerId',$ownerId);
    $newTicket->addChild('Subject',$ticketSubject);
    $messages = $newTicket->addChild('Messages');
    $message = $messages->addChild('Message');
    $message->addAttribute('UserId',$ownerId);
    $message->addChild('Date',getCurrentDateStr());
    $message->addChild('Content',$ticketContent);
    return $xml->saveXML("xml/SupportTickets.xml");
}


function generateNewTicketId(): int
{
    $xml = simplexml_load_file("xml/SupportTickets.xml");
    //$result = $xml->xpath("//User[last()]/@UserId");//ISSUE: cannot load last user in xml file because result is null
    $result = $xml->xpath("//SupportTicket[last()-1]/@Id")[0];//NOTE: last User is at (last()-1) index
    //var_dump($result);
    $currentTicketId = $result[0];
    //var_dump($currentUserId);
    //$print = $xml->xpath("//User[last()-1]")[0];//runnable
    //$UserId = $print->attributes()['UserId'];

    //NOTE: In here $UserId's type is object but $UserId is value of an integer when printing
    //echo "type of UserId: ".gettype($currentUserId).'and value of UserId is '.$currentUserId;
    return intval($currentTicketId)+1;
}
/*<option value="Resolved" selected>Resolved</option>
                <option value="In progress">In progress</option>
                <option value="Closed">Closed</option>
                <option value="Reopened">Reopened</option>*/