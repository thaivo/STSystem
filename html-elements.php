<?php
function printHeadElement($title,$pathToJsFile=''){
    echo '<head>
            <meta charset="UTF-8">
            <meta name="viewport"
                  content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
            <meta http-equiv="X-UA-Compatible" content="ie=edge">
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
            <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.3/css/all.css" integrity="sha384-SZXxX4whJ79/gErwcOYf+zWLeJdY/qpuqC4cAa9rOGUstPomtqpuNWT9wdPEn2fk" crossorigin="anonymous">
            <link rel="stylesheet" type="text/css" href="css/style.css">
            <title>'.$title.'</title>';
    if(!empty($pathToJsFile)){
        echo '<script type="text/javascript" src="'.$pathToJsFile.'"></script>';
    }
    echo      '</head>';
}

function printHeaderElement($logoutInvisible = true){
     echo '<header id="header" class="nav nav-pills flex-row">
                <h2 class="p-2 bd-highlight flex-grow-1">Support Ticket System</h2>';
     if ($logoutInvisible === true){
         echo '<a id="logout" href="login.php" class="text-end p-2 bd-highlight">Logout</a>';
     }
     echo '</header>';
}

function printFooterElement(){
    echo '<footer id="footer">
    Thai Vo. &copy; 2021
</footer>';
}