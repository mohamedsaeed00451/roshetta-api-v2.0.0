<?php

function getDateTimeFormat($dateTime) //Format Date Time Type [AM , PM]
{
    $format = new DateTime($dateTime);
    $date = $format->format('Y-m-d');
    $time = $format->format('h:i');
    $timeForType = $format->format('H:i');
    $type = (date('A',strtotime($timeForType)));

    $finalFormat = $date . ' ' . $time . ' ' . $type;

    return $finalFormat;
}
