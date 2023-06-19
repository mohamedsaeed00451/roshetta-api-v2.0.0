<?php

use App\Http\Controllers\MobileDetect;

function hi($type) //get Hi Type
{
    switch ($type) {
        case 'doctor':
            $hi = 'مـــــرحبـــــا بــــك دكتـــــور';
            break;
        case 'pharmacist':
            $hi = 'مـــــرحبـــــا بــــك دكتـــــور';
            break;
        case 'admin':
            $hi = 'مـــــرحبـــــا بــــك مـــــدير';
            break;
        default:
            $hi = 'مـــــرحبــــــا بــــك';
    }
    return $hi;
}

function getIp()   // Function Get The Client IP Address
{
    $ipaddress = '';
    if (isset($_SERVER['HTTP_CLIENT_IP']))
        $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
    else if (isset($_SERVER['HTTP_X_FORWARDED_FOR']))
        $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
    else if (isset($_SERVER['HTTP_X_FORWARDED']))
        $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
    else if (isset($_SERVER['HTTP_FORWARDED_FOR']))
        $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
    else if (isset($_SERVER['HTTP_FORWARDED']))
        $ipaddress = $_SERVER['HTTP_FORWARDED'];
    else if (isset($_SERVER['REMOTE_ADDR']))
        $ipaddress = $_SERVER['REMOTE_ADDR'];
    else
        $ipaddress = 'UNKNOWN';
    return $ipaddress;
}

function mobileDetect($name){
    // Create an instance of MobileDetect class
    $mdetect = new MobileDetect();                  // Function Get The Client Type Device And Operating System

    if ($mdetect->isMobile()) {
        // Detect mobile/tablet
        if ($mdetect->isTablet()) {
            $type = 'Tablet';
        } else {
            $type = 'Mobile';
        }
        // Detect platform
        if ($mdetect->isiOS()) {
            $operating_system = 'IOS';
        } elseif ($mdetect->isAndroidOS()) {
            $operating_system = 'Android';
        }
    } else {
        $type = 'Desktop';
        $operating_system = 'Windows';
    }

    if ($name == 'type') {
        return $type ;
    } else {
        return $operating_system ;
    }

}

function getHostByaddress()
{
    $device_name = gethostbyaddr($_SERVER['REMOTE_ADDR']);   // Function Get The Client Name Device

    return $device_name;
}

