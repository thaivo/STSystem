<?php
require_once "user-query.php";
require_once "html-elements.php";
session_start();
//session_destroy();
if (isset($_POST['logup'])){
    $passwordErrorMsg = '';
    $userNameErrorMsg = '';
    if (isset($_POST['username'])){
        if (!doesUserNameExist($_POST['username'])){
            if (isset($_POST['password'])){
                /*if(verifyPasswordByUserName($_POST['username'],$_POST['password'])){
                    if (isAdmin($_POST['username'])){
                        $_SESSION['admin'] = '1';
                    }
                    $_SESSION['user'] = getUserIdByUserName($_POST['username']);
                }
                else{
                    $passwordErrorMsg = "incorrect password";
                }*/
                if (!isset($_POST['firstname']))
                {
                    $firstNameErrorMsg = "please enter your first name";
                }
                if (!isset($_POST['lastname'])){
                    $lastNameErrorMsg = "please enter your last name";
                }
                if (!isset($_POST['email'])){
                    $emailErrorMsg = "please enter your email";
                }
                if (isset($_POST['firstname']) && isset($_POST['lastname']) && isset($_POST['lastname'])){
                    if (isset($_POST['middlename'])){
                        createNewUser($_POST['username'],$_POST['password'], $_POST['firstname'],$_POST['lastname'],$_POST['email'],$_POST['middlename']);
                    }
                    else{
                        createNewUser($_POST['username'],$_POST['password'], $_POST['firstname'],$_POST['lastname'],$_POST['email']);
                    }
                    header("Location: login.php");
                }
            }
            else{
                $passwordErrorMsg = "password is empty";
            }
        }
        else{
            $userNameErrorMsg = "username was already in use";
        }
    }
    else{
        $userNameErrorMsg = "username is empty";
    }
}
?>
<!doctype html>
<html lang="en">
<?php
printHeadElement("Registration page");
?>
<body>
<?php
printHeaderElement();
?>
<main>
<div class="container">
    <h1 class="visually-hidden">
        Login page
    </h1>
    <div id="logup-form" class="input-group flex-nowrap border border-3 w-50">
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
            <div class="mb-3">
                <label for="firstname" class="form-label">
                    First name:
                </label>
                <input type="text" name="firstname" id="firstname" class="form-control" placeholder="your firstname">

            </div>
            <div class="mb-3">
                <label for="lastname" class="form-label">
                    Last name:
                </label>
                <input name="lastname" id="lastname" type="text" class="form-control" placeholder="your lastname">

            </div>
            <div class="mb-3">
                <label for="middlename" class="form-label">
                    Middle name:
                </label>
                <input name="middlename" id="middlename" type="text" class="form-control" placeholder="your middlename">

            </div>
            <div class="mb-3">
                <label for="email" class="form-label">
                    Email:
                </label>
                <input name="email" id="email" type="email" class="form-control" placeholder="your email">

            </div>
            <div class="text-end">
                <input id="logup-btn" type="submit" class="btn me-2 mb-2" name="logup" value="Log up">
            </div>
        </form>
    </div>
</div>
</main>
<?php
printFooterElement();
?>
</body>
</html>
