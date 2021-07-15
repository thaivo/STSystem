<?php

function getUserNameById($id){
    $xml = simplexml_load_file("xml/Users.xml");
    $name = $xml->xpath("//User[@UserId='$id']/Name/First/text()")[0]. ' ';
    if($xml->xpath("//User[@UserId='$id']/Name/Middle/text()"))
    {
        $name .= $xml->xpath("//User[@UserId='$id']/Name/Middle/text()")[0].' ';
    }
    $name .=  $xml->xpath("//User[@UserId='$id']/Name/Last/text()")[0];
    return $name;
}