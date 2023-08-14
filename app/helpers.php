<?php

if (!function_exists('date_today')) {
    function date_today() {
        $str = \Carbon\Carbon::now()->isoFormat('dddd, LL');

        return $str;
    }
}

if (!function_exists('format_rupiah')) {
    function format_rupiah($value) {
        return "Rp. " . number_format($value, 0, ',', '.');
    }
}

if (!function_exists('format_date_spell')) {
    function format_date_spell() {
        $days = array('sunday', 'monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday');
        $str = \Carbon\Carbon::now()->isoFormat('dddd, LL');

        return $str;
    }
}


if (!function_exists('format_usd')) {
    function format_usd($value) {
        $formatter = new NumberFormatter('en_US', NumberFormatter::CURRENCY);
        return $formatter->formatCurrency($value, 'USD');
    }
}

if (!function_exists('formatOnlyNumber')) {
    function formatOnlyNumber($value) {
        if (!isset($value) || $value == null || empty($value)) {
            return 0;
        }

        if (strpos($value, '.') !== false || strpos($value, ',') !== false) {
            return preg_replace("/[^0-9.]/", "", $value);
        }

        return preg_replace("/[^0-9]/", "", $value);
    }
}
