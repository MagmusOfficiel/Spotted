<?php

namespace App\Twig;

use Twig\Extension\AbstractExtension; 
use Twig\TwigFunction;

class ConstanteExtension extends AbstractExtension
{ 

    public function getFunctions(): array
    {
        return [
            new TwigFunction('eddyhash', [$this, 'eddyhash']),
        ];
    }

    public function eddyhash($test): string
    {
        return password_hash($test, PASSWORD_DEFAULT);
    }
}
