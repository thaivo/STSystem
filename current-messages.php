<?php
require_once 'ticket-query.php';
if(isset($_GET['id'])){
    $id = $_GET['id'];
    //echo 'message-query.php:17: '.$id;
    $selectedTicket = getTicketById($id);
    /*$ownerId = $selectedTicket['OwnerId'];
    $userFullName = getUserFullNameById($ownerId);
    $subject = $selectedTicket->Subject;*/

    $listOfMessages = getMessagesStrByMessagesObj($selectedTicket->Messages,true);

    /*foreach ($selectedTicket->Messages->children() as $message){
        $listOfMessages .= '<li>
                                <div class="card m-2">
                                    <div class="card-header d-flex flex-row">
                                        <div class="flex-fill">';
        $listOfMessages .= 'From: '.getUserFullNameById($message['UserId']);
        $listOfMessages .=              '</div><div class="flex-fill">';
        $listOfMessages .= 'Date: '.$message->Date;
        $listOfMessages .= '</div>
        </div>
        <div class="card-body">
            <p class="card-text">';
        $listOfMessages .= $message->Content;
        $listOfMessages .= '</p></div></div></li>';
        echo $listOfMessages;
    }*/
}