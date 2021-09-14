<?php

function getUserFullNameById($id){
    //LESSON:should not initialize $xml as a global var
    // with this statement  $xml = simplexml_load_file("xml/Users.xml");
    //Because it would not load the new content of xml/Users.xml
    //global $xml;
    $xml = simplexml_load_file("xml/Users.xml");
    //$testId = "//User[@UserId=$id]/Name/First/text()";
    //echo 'testId = '.$testId;
    //var_dump($xml->xpath("//User[@UserId=$id]/Name/First/text()"));
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
    $xml = simplexml_load_file("xml/Users.xml");
    return $xml->xpath("//User/LoginInfo/UserName[text() = '$username']");
}

//$username was already checked before calling this function and it exists in xml file.
function verifyPasswordByUserName($username, $loginPassword){
    $xml = simplexml_load_file("xml/Users.xml");
    return password_verify($loginPassword, $xml->xpath("//User[LoginInfo/UserName/text() = '$username']/LoginInfo/Password/text()")[0]);
}

function isAdmin($username): bool
{
    $xml = simplexml_load_file("xml/Users.xml");
    $isAdmin = $xml->xpath("//User[@Admin='1' and LoginInfo/UserName/text()='$username']");
    if ($isAdmin && count($isAdmin) !== 0){
        return true;
    }
    return false;
}

function getUserIdByUserName($username){
    $xml = simplexml_load_file("xml/Users.xml");
    var_dump($xml->xpath("//User[LoginInfo/UserName/text()='$username']/@UserId")[0]);
    echo 'type is '.gettype($xml->xpath("//User[LoginInfo/UserName/text()='$username']/@UserId")[0][0]);

    return intval($xml->xpath("//User[LoginInfo/UserName/text()='$username']/@UserId")[0][0]);
}

function generateNewUserId(){
    $xml = simplexml_load_file("xml/Users.xml");
    $result = $xml->xpath("//User[last()]/@UserId")[0];//NOTE: last User is at (last()) index
    //var_dump($result);
    $currentUserId = $result[0];
    return intval($currentUserId)+1;
}

function createNewUser($username, $password, $firstName, $lastName, $email, $middleName = ''){
    $xml = simplexml_load_file("xml/Users.xml");
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

function getAllUsers($excludeAdmin = true): array|bool
{
    $xml = simplexml_load_file("xml/Users.xml");
    $xpath = '';
    if ($excludeAdmin === true){
        $xpath .= "//User[not(@Amin)]";
    }
    return $xml->xpath($xpath);


}

function createListOptionElementsForUsers($userSimpleXmlObjects): string
{
    //Reference:https://stackoverflow.com/questions/40363821/get-an-attribute-value-using-simplexml-for-php
    //https://electrictoolbox.com/php-simplexml-element-attributes/
    $result = '';
    foreach ($userSimpleXmlObjects as $user){
        $result .= '<option value="'.$user->attributes()->UserId.'">'.$user->Name->First.' '.$user->Name->Last.'( '.$user->LoginInfo->UserName.')</option>';
    }
    return $result;
}