<?php
$xml = simplexml_load_file("xml/Users.xml");
function getUserFullNameById($id){
    global $xml;
    $name = $xml->xpath("//User[@UserId='$id']/Name/First/text()")[0]. ' ';
    if($xml->xpath("//User[@UserId='$id']/Name/Middle/text()"))
    {
        $name .= $xml->xpath("//User[@UserId='$id']/Name/Middle/text()")[0].' ';
    }
    $name .=  $xml->xpath("//User[@UserId='$id']/Name/Last/text()")[0];
    return $name;
}

function doesUserNameExist($username): array|bool
{
    global $xml;
    return $xml->xpath("//User/LoginInfo/UserName[text() = '$username']");
}

//$username was already checked before calling this function and it exists in xml file.
function verifyPasswordByUserName($username, $loginPassword){
    global $xml;
    return password_verify($loginPassword, $xml->xpath("//User[LoginInfo/UserName/text() = '$username']/LoginInfo/Password/text()")[0]);
}

function isAdmin($username): bool
{
    global $xml;
    $isAdmin = $xml->xpath("//User[@Admin='1' and LoginInfo/UserName/text()='$username']");
    if ($isAdmin && count($isAdmin) !== 0){
        return true;
    }
    return false;
}

function getUserIdByUserName($username){
    global $xml;
    var_dump($xml->xpath("//User[LoginInfo/UserName/text()='$username']/@UserId")[0]);
    echo 'type is '.gettype($xml->xpath("//User[LoginInfo/UserName/text()='$username']/@UserId")[0][0]);

    return intval($xml->xpath("//User[LoginInfo/UserName/text()='$username']/@UserId")[0][0]);
}

function generateNewUserId(){
    global $xml;
    //$result = $xml->xpath("//User[last()]/@UserId");//ISSUE: cannot load last user in xml file because result is null
    $result = $xml->xpath("//User[last()-1]/@UserId")[0];//NOTE: last User is at (last()-1) index
    //var_dump($result);
    $currentUserId = $result[0];
    //var_dump($currentUserId);
    //$print = $xml->xpath("//User[last()-1]")[0];//runnable
    //$UserId = $print->attributes()['UserId'];

    //NOTE: In here $UserId's type is object but $UserId is value of an integer when printing
    //echo "type of UserId: ".gettype($currentUserId).'and value of UserId is '.$currentUserId;
    return intval($currentUserId)+1;
}

function createNewUser($username, $password, $firstName, $lastName, $email, $middleName = ''){
    global $xml;
    $newUser = $xml->addChild('User');
    $newUser->addAttribute('UserId',generateNewUserId());
    $name = $newUser->addChild('Name');
    $name->addChild('First',$firstName);
    if (!empty($middleName)){
        $name->addChild('Middle',$middleName);
    }
    $name->addChild('Last',$lastName);
    $newUser->addChild('Email',$email);
    $loginInfo = $newUser->addChild('LoginInfo');
    $loginInfo->addChild('UserName',$username);
    $loginInfo->addChild('Password',password_hash($password,PASSWORD_DEFAULT));
    $xml->saveXML("xml/Users.xml");
}