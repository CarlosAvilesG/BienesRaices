<?php

namespace App\Helpers;

use NumberFormatter;

class GeneralHelper
{
    public static function convertirNumeroALetras($numero)
    {
        $formatter = new NumberFormatter('es', NumberFormatter::SPELLOUT);
        $letras = $formatter->format($numero);

        return ucfirst($letras);  // Retorna el número en letras con la primera letra en mayúscula.
    }
}
