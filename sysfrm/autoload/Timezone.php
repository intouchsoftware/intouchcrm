<?php
// *************************************************************************
// *                                                                       *
// * InTouch Software CRM                              *
// * Copyright (c) InTouch Software (Pty) Ltd. All Rights Reserved                      *
// *                                                                       *
// *************************************************************************
// *                                                                       *
// * Email: info@intouchsoft.co.za                                                *
// * Website: https://www.intouchsoft.co.za                                  *
// *                                                                       *
// *************************************************************************
// *                                                                       *
// * This software is furnished under a license and may be used and copied *
// * only  in  accordance  with  the  terms  of such  license and with the *
// * inclusion of the above copyright notice.                       *
// *                                                                       *
// *************************************************************************
class Timezone {
    public static function timezoneList()
    {
        $timezoneIdentifiers = DateTimeZone::listIdentifiers();
        $utcTime = new DateTime('now', new DateTimeZone('UTC'));

        $tempTimezones = array();
        foreach ($timezoneIdentifiers as $timezoneIdentifier) {
            $currentTimezone = new DateTimeZone($timezoneIdentifier);

            $tempTimezones[] = array(
                'offset' => (int)$currentTimezone->getOffset($utcTime),
                'identifier' => $timezoneIdentifier
            );
        }

        // Sort the array by offset,identifier ascending
        usort($tempTimezones, function($a, $b) {
            return ($a['offset'] == $b['offset'])
                ? strcmp($a['identifier'], $b['identifier'])
                : $a['offset'] - $b['offset'];
        });

        $timezoneList = array();
        foreach ($tempTimezones as $tz) {
            $sign = ($tz['offset'] > 0) ? '+' : '-';
            $offset = gmdate('H:i', abs($tz['offset']));
            $timezoneList[$tz['identifier']] = '(UTC ' . $sign . $offset . ') ' .
                $tz['identifier'];
        }

        return $timezoneList;
    }
}
