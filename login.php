<?php
session_save_path('D:\ProgramStore\xampp\php\tmp');
session_start();
require_once "user-query.php";

if (isset($_POST['login'])){
    $passwordErrorMsg = '';
    $userNameErrorMsg = '';
    if (isset($_POST['username'])){
        if (doesUserNameExist($_POST['username'])){
            if (isset($_POST['password'])){
                if(verifyPasswordByUserName($_POST['username'],$_POST['password'])){
                    if (isAdmin($_POST['username'])){
                        $_SESSION['admin'] = '1';
                    }
                    //LESSON_LEARN:
                    //IN getUserIdByUserName
                    //Assume X is $xml->xpath("//User[LoginInfo/UserName/text()='$username']/@UserId")[0][0]
                    //X is an object so If not using intval function to get integer value of X
                    //And then assign return value from getUserIdByUserName to $_SESSION['user']
                    //When redirecting to another page, X is destroyed and $_SESSION['user'] that point to X is also NULL.
                    //ANd then, cannot accessing $_SESSION['user'] in another page, because it is NULL.
                    //that is the root cause and the reason for using intval function in getUserIdByUserName.
                    $_SESSION['user'] = getUserIdByUserName($_POST['username']);
                    header('Location: ticket-listing.php');
                    //Reference:https://stackoverflow.com/questions/9363760/301-or-302-redirection-with-php
                    //https://www.php.net/manual/en/function.header.php
                    exit();
                }
                else{
                    $passwordErrorMsg = "incorrect password";
                }
            }
            else{
                $passwordErrorMsg = "password is empty";
            }
        }
        else{
            $userNameErrorMsg = "username does not exist";
        }
    }
    else{
        $userNameErrorMsg = "username is empty";
    }
}
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
                <input type="text" name="username" id="username" class="form-control" placeholder="your username">
                <br><span><?= !isset($userNameErrorMsg)? '': $userNameErrorMsg; ?></span>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">
                    Password:
                </label>
                <input name="password" id="password" type="password" class="form-control" placeholder="your password">
                <br><span><?= !isset($passwordErrorMsg)? '': $passwordErrorMsg; ?></span>
            </div>
            <div class="text-end">
                <input id="login-btn" type="submit" class="btn me-2 mb-2" name="login" value="login">
            </div>
        </form>
        <a href="signup.php">Signup up</a>
    </div>
</div>
</main>
<?php
require_once 'footer.php';
?>
</body>
</html>
