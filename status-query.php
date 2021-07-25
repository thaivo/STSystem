<?php
require_once 'ticket-query.php';
$_POST = json_decode(file_get_contents('php://input'),true);
if (isset($_POST['ticketId'])){
    echo updateTicketStatusByTicketId($_POST['ticketId'],$_POST['ticketStatus']);
}