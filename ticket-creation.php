<?php
require_once 'html-elements.php';
require_once 'user-query.php';
require_once 'ticket-query.php';
session_save_path('D:\ProgramStore\xampp\php\tmp');
session_start();
if (!isset($_SESSION['user'])){
    header("Location: login.php");
}
if (isset($_POST['submitNewTicket'])){
    $ownerId = $_SESSION['user'];
    if ($_SESSION['admin']){
        $ownerId = $_POST['owner'];//Admin help users to create their new ticket and then assign them as an owner
    }
    //TODO: start to create a ticket with $ownerId
    var_dump($_POST);
    $debugFile = fopen("debug.txt","w+");
    fwrite($debugFile,"THAI");

    echo "result of creating new ticket: ".createTicket($_POST['subjectField'],$_POST['contentField'], $ownerId);
    fclose($debugFile);
}
?>
<!doctype html>
<html lang="en">
<?php
printHeadElement('Ticket creation');
?>
<body>
<?php
printHeaderElement();
?>
<main>
    <h1> New Ticket</h1>
    <form method="post">
        <?php
        if (isset($_SESSION['admin'])){
            //TODO: Add drop-down list to show the list of normal user that is the owner. Admin can help users to create a new ticket that is owned by users.
            $owner = '<label for="owner" class="flex-fill bd-highlight align-middle form-label">Owner:</label>';
            $owner .= '<select id="owner" name="owner" class="form-select flex-fill bd-highlight align-middle statuses">';
            $userSimpleXmlObjects = getAllUsers();
            $owner .= createListOptionElementsForUsers($userSimpleXmlObjects);
            $owner .= '</select>';
            echo $owner;
        }
        ?>
        <div class="mb-3">
            <label for="subject" class="form-label">
                Subject
            </label>
            <input id="subject" name="subjectField" class="form-control" type="text" placeholder="your ticket subject">
        </div>
        <div class="mb-3">
            <label for="content" class="form-label">
                Content
            </label>
            <input id="content" name="contentField" class="form-control" type="text" placeholder="I would like to...">
        </div>

        <input type="submit" name="submitNewTicket" value="NewTicket">

    </form>
</main>
<?php
printFooterElement();
?>
</body>
</html>
