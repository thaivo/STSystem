<?php
function submitMessage($ticketId, $message, $userId): bool|string
{
    date_default_timezone_set('America/Toronto');
    $currentDateTimeObject = new DateTime();
    $currentDateTimeStr = $currentDateTimeObject->format('Y-m-d').'T'.$currentDateTimeObject->format('H:i:s');
    $supportTicketsXmlDoc = simplexml_load_file('xml/SupportTickets.xml');
    $messages = $supportTicketsXmlDoc->xpath("//SupportTicket[@Id=$ticketId]/Messages")[0];
    $newMessage = $messages->addChild('Message');
    $newMessage->addAttribute('UserId', $userId);
    $newMessage->addChild('Date',$currentDateTimeStr);
    $newMessage->addChild('Content',$message);
    return $supportTicketsXmlDoc->saveXML('xml/SupportTickets.xml');
}

