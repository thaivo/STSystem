<?php
function getCurrentDateStr(): string
{
    date_default_timezone_set('America/Toronto');
    $currentDateTimeObject = new DateTime();
    return $currentDateTimeObject->format('Y-m-d').'T'.$currentDateTimeObject->format('H:i:s');
}
