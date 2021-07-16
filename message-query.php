<?php
function submitMessage($msgId,$currentDateTime, $message, $userId): bool|string
{
    $supportTicketsXmlDoc = simplexml_load_file('xml/SupportTickets.xml');
    $messages = $supportTicketsXmlDoc->xpath("//SupportTicket[@Id=$msgId]/Messages")[0];
    $newMessage = $messages->addChild('Message');
    $newMessage->addAttribute('UserId', $userId);
    $newMessage->addChild('Date',$currentDateTime);
    $newMessage->addChild('Content',$message);
    return $supportTicketsXmlDoc->saveXML('xml/SupportTickets.xml');

}

