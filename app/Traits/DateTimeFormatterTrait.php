<?php

namespace App\Traits;

use DateTime;

trait DateTimeFormatterTrait
{
    public function formatDateTime($date_time)
    {
        $date = DateTime::createFromFormat('l d F Y - H:i:s', $date_time);
        if ($date) {
            return $date->format('Y-m-d H:i:s');
        } else {
            return null;
        }
    }
}