<?php

namespace App\Twig;

use DateTime;
use Twig\TwigFunction;
use Twig\Extension\AbstractExtension;

class DateDiffExtension extends AbstractExtension
{
    public function getFunctions(): array
    {
        return [
            new TwigFunction('date_timer', [$this, 'date_timer']),
        ];
    }

    public function date_timer(string $date1)
    {
        $date1 = new DateTime($date1); 
        $now  = new DateTime('now');
        $intvl = $now->diff($date1); 
        return $intvl->i . ":" . $intvl->s;
    }
}
