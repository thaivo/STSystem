<?php
require_once 'message-query.php';
if (isset($_POST['ticketId'])){
    echo submitMessage($_POST['ticketId'],$_POST['message'],$_POST['userId']);
}
