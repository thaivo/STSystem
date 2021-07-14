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
    <link href="css/style.css" type="text/css" rel="stylesheet">
</head>
<body>
<?php
require_once 'header.php';
?>
<main>
<div class="container">
    <h1 class="visually-hidden">
        Login page
    </h1>
    <div id="login-form" class="input-group flex-nowrap border border-3 w-50">
        <form method="post" class="row g-3">
            <div class="mb-3">
                <label for="username" class="form-label">
                    Username:
                </label>
                <input type="text" id="username" class="form-control" placeholder="your username">
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">
                    Password:
                </label>
                <input id="password" type="password" class="form-control" placeholder="your password">
            </div>
            <div class="text-end">
                <input id="login-btn" type="submit" class="btn me-2 mb-2" name="submit" value="login">
            </div>
        </form>
    </div>
</div>
</main>
<?php
require_once 'footer.php';
?>
</body>
</html>
