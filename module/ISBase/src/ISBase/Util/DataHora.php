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
    
}
