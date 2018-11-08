<?php

if (!function_exists('notify')) {
    function notify($title = null, $message = '', $type = null)
    {
        $alert = app('notify');
        if (!is_null($title)) {
            return $alert->alert($title, $message, $type);
        }
        return $alert;
    }
}