<?php

namespace ISBase\Util;

class DataHora {

    public static function dateTimeToString($date) {
        if (!empty($date)) {
            return date_format($date, 'd/m/Y H:i:s');
        } else {
            return null;
        }
    }

    public static function date_string($data) {
        if (!empty($data)) {
            $data = explode("-", $data);
            return $data[2] . "/" . $data[1] . "/" . $data[0];
        } else {
            return null;
        }
    }
    
}
