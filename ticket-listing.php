<?php
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <title>Document</title>
</head>
<body>
<?php
require_once 'header.php';
?>
<main class="container">
<h1>List of tickets</h1>
<div class="d-flex flex-column">
    <!--List of tickets-->
    <div class="card m-2">
        <h3 class="card-header">
            Subject: abc
        </h3>
        <div class="card-body">
            <p class="card-text">
                <a href="#" class="stretched-link">
                    Created by: John Doe
                </a>

            </p>
            <p class="card-text">Date time: 2021-05-26 10:30:20</p>

        </div>
    </div>
    <div class="card m-2">
        <h3 class="card-header">
            Subject: abc
        </h3>
        <div class="card-body d-sm-flex flex-sm-row">
            <p class="card-text flex-fill bd-highlight  align-middle">
                <a href="ticket-detail.php". class="stretched-link">
                    Created by: John Doe
                </a>
            </p>

            <p class="card-text flex-fill bd-highlight align-middle">Date time: 2021-05-26 10:30:20</p>
            <label for="status" class="flex-fill bd-highlight align-middle">Status:</label>
            <select id="status" class="form-select flex-fill bd-highlight align-middle">
                <option value="Resolved" selected>Resolved</option>
                <option value="In progress">In progress</option>
                <option value="Closed">Closed</option>
                <option value="Reopened">Reopened</option>
            </select>
        </div>
    </div>
</div>
</main>
<?php
require_once 'footer.php';
?>
</body>
</html>
