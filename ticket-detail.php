<?php
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.3/css/all.css" integrity="sha384-SZXxX4whJ79/gErwcOYf+zWLeJdY/qpuqC4cAa9rOGUstPomtqpuNWT9wdPEn2fk" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
<?php
require_once 'header.php';
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
        <h1>Subject of message</h1>
    </div>
    <div class="row d-flex flex column justify-content-end">
        <label for="statuses" class="col-sm-1 col-form-label">
            Status:
        </label>
        <select id="statuses" class="form-select">
            <option value="Resolved">Resolved</option>
            <option value="In progress">In progress</option>
            <option value="Closed">Closed</option>
            <option value="Reopened">Reopened</option>
        </select>
    </div>
    <ul>
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
        </li>
    </ul>


    <form action="post" class="d-flex">
        <div class="form-floating mb-3 flex-fill">
            <textarea class="form-control" placeholder="Leave a message here" id="messageArea"></textarea>
            <label for="messageArea">Message</label>
        </div>

            <input id="submitMsgBtn" type="submit" class="btn align-self-start">

    </form>

</div>

</main>

<?php
require_once 'footer.php';
?>
</body>
</html>