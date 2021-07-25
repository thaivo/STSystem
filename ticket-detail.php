<?php
require_once 'ticket-query.php';
require_once 'user-query.php';
require_once 'html-elements.php';
//echo "ticket-detail.php: START require_one message-query.php";
require_once 'message-query.php';
//echo "ticket-detail.php: END require_one message-query.php";
session_save_path('D:\ProgramStore\xampp\php\tmp');
session_start();
if(!isset($_SESSION['user'])){
    header("location: login.php");
}
$listOfMessages = '';
$id = '';
$subject = '';
$selectedTicket ='';
//$userId = 1;//to test message submission when I need to pass php var to js var
$userId = intval($_SESSION['user']);
if($_GET['id'] !== null){
    $id = $_GET['id'];
    //echo "id: ".$id;
    $selectedTicket = getTicketById($id);
    $ownerId = $selectedTicket['OwnerId'];
    $userFullName = getUserFullNameById($ownerId);
    $subject = $selectedTicket->Subject;
    //echo "ticket-detail.php: START get listOfMessages";
    $listOfMessages = getMessagesStrByMessagesObj($selectedTicket->Messages);
    //echo "ticket-detail.php: END GET listOfMessages";
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
    }*/
}

if(isset($_POST['submitMsg'])){
    $msg = $_POST['message'];
    if (!empty($msg)){

        //hard-coding userId is 1
        $result = submitMessage($id,$msg,'1');
        if ($result){
            echo 'Submitted message successfully';
        }
        else{
            echo 'Failed to submit message';
        }
    }
}
?>


<!doctype html>
<html lang="en">
<!--<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.3/css/all.css" integrity="sha384-SZXxX4whJ79/gErwcOYf+zWLeJdY/qpuqC4cAa9rOGUstPomtqpuNWT9wdPEn2fk" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <script type="text/javascript" src="js/handler.js"></script>
</head>-->
<?php
printHeadElement($subject, 'js/handler.js');
?>
<body>
<?php
/*require_once 'header.php';*/
printHeaderElement();
?>
<main class="container">
    <div class="mt-2">
        <a id="back-btn" href="ticket-listing.php" class="btn border rounded-3" role="button" ">
        <i class="fas fa-arrow-left"></i>
        Back
        </a>
    </div>
<div class="d-flex flex-column">
    <div class="text-center">
        <?php
        echo '<h1>'.$subject.'</h1>';
        ?>
        <!--<h1>Subject of message</h1>-->
    </div>
    <div class="row d-flex flex-row justify-content-end">


            <?php
            if (isset($_SESSION['admin'])){
                echo '<label for="'.$id.'" class="col-sm-1 col-form-label">
                    Status:
                      </label>';
                echo '<select id="'.$id.'" class="form-select statuses"  onchange="changeStatus(this)">';
                echo createListOptionElements($selectedTicket['Status']);
                echo '</select>';
            }
            else{
                echo '<text id="status_ticket_normal_user" class="col-sm-1 align-bottom">'.$selectedTicket['Status'].'</text>';
            }

            ?>
            <!--<option value="Resolved">Resolved</option>
            <option value="In progress">In progress</option>
            <option value="Closed">Closed</option>
            <option value="Reopened">Reopened</option>-->

    </div>
    <ul id="list_messages">
        <?php
        echo $listOfMessages;
        ?>
    </ul>


    <form action="" method="post" class="d-flex" id="messageForm">
        <div class="form-floating mb-3 flex-fill">
            <textarea class="form-control" placeholder="Leave a message here" id="messageArea" name="message"></textarea>
            <label for="messageArea">Message</label>
        </div>

            <input id="submitMsgBtn" name="submitMsg" type="submit" class="btn align-self-start">

    </form>

</div>

</main>

<?php
/*require_once 'footer.php';*/
printFooterElement();
?>
</body>
<script async defer type="text/javascript">
    let messageForm = document.getElementById("messageForm");
    messageForm.addEventListener('submit',asyncSubmitMessage);
    function preventDefaultBehavior(event) {
        event.preventDefault();
    }
    function asyncSubmitMessage(event) {
        event.preventDefault();
        //let submitMsgBtn = document.getElementById("submitMsgBtn");
        let message = document.getElementById("messageArea");
        //messageForm.onsubmit =
        //submitMsgBtn.addEventListener('submit',function (event) {
        //let xmlHttpRequest = new XMLHttpRequest();
            xmlHttpRequest.onreadystatechange = function () {
                if (this.status === 200  && this.readyState === 4 ){
                    console.log("success to submit ticket");
                }
            }

            xmlHttpRequest.open("POST","submit-message.php");
            xmlHttpRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            let userId = <?php echo $userId  ?>;
            let ticketId = <?php echo $id ?>;
            console.log("ticketId: "+userId);

            console.log("ticket-detail.php:143 message.textContent: "+message.textContent);


            xmlHttpRequest.send("ticketId="+ticketId+"&userId="+userId+"&message="+message.value);
        //});
        //clear message:
        message.value = "";
    }
    /*let submitMsgBtn = document.getElementById("submitMsgBtn");
    let messageForm = document.getElementById("messageForm");
    //messageForm.onsubmit =
    //submitMsgBtn.addEventListener('submit',function (event) {
    submitMsgBtn.submit(function (event) {
        event.preventDefault();
        xmlHttpRequest.onreadystatechange = function () {
            if (this.status === 200  && this.readyState === 4 ){
                console.log("success to submit ticket");
            }
        }

        xmlHttpRequest.open("POST","submit-message.php");
        xmlHttpRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        let userId = <?php echo $userId  ?>;
        let ticketId = <?php echo $id ?>;
        console.log("ticketId: "+userId);
        console.log("ticket-detail.php:143");


        xmlHttpRequest.send("ticketId="+ticketId+"&userId="+userId+"&message="+messageForm.innerText);
    });*/
</script>
</html>
<!--<li>
            <div class="card m-2">
                <div class="card-header d-flex flex-row">
                    <div class="flex-fill">
                        From: user1
                    </div>
                    <div class="flex-fill">
                        Date: 2021 June, 10
                    </div>

                </div>
                <div class="card-body">
                    <p class="card-text">
                        content of reply

                    </p>
                </div>
            </div>
        </li>
        <li>
            <div class="card m-2">
                <div class="card-header d-flex flex-row">
                    <div class="flex-fill">
                        From: user1
                    </div>
                    <div class="flex-fill">
                        Date: 2021 June, 10
                    </div>

                </div>
                <div class="card-body">
                    <p class="card-text">
                        content of reply

                    </p>
                </div>
            </div>
        </li>-->