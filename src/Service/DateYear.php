<?php

namespace App\Service;

class DateYear
{
    public function dateYear(array $dates, int $month): int
    {
        $nbr = 0;
        foreach ($dates as $value) {
            if (date_format($value->getCreatedAt(), 'm') == $month) {
                $nbr = $nbr + 1;
            }
        }

        return $nbr;
    }
}