<?php

namespace App\Helpers;

use NumberFormatter;

class GeneralHelper
{
    public static function convertirNumeroALetras($numero)
    {
        // $formatter = new NumberFormatter('es', NumberFormatter::SPELLOUT);
        // $letras = $formatter->format($numero);

        // return ucfirst($letras);  // Retorna el número en letras con la primera letra en mayúscula.
        $unidad = ["", "uno", "dos", "tres", "cuatro", "cinco", "seis", "siete", "ocho", "nueve"];
        $decena = ["", "", "veinte", "treinta", "cuarenta", "cincuenta", "sesenta", "setenta", "ochenta", "noventa"];
        $centena = ["", "cien", "doscientos", "trescientos", "cuatrocientos", "quinientos", "seiscientos", "setecientos", "ochocientos", "novecientos"];
        $especiales = [
            10 => "diez", 11 => "once", 12 => "doce", 13 => "trece", 14 => "catorce", 15 => "quince",
            16 => "dieciséis", 17 => "diecisiete", 18 => "dieciocho", 19 => "diecinueve"
        ];

        // Redondear el número a dos decimales para obtener los centavos
        $numero = round($numero, 2);

        // Separar la parte entera y los centavos
        $parteEntera = floor($numero);
        $centavos = round(($numero - $parteEntera) * 100);

        // Convertir la parte entera a letras
        $letras = self::convertirParteEnteraALetras($parteEntera);

        // Agregar centavos al final si los hay
        $resultado = ucfirst($letras);
        if ($centavos > 0) {
            $resultado .= " con $centavos/100";
        }

        // Agregar 'M.N.' al final
        $resultado .= " M.N.";

        return $resultado;
    }

    private static function convertirParteEnteraALetras($numero)
    {
        $unidad = ["", "uno", "dos", "tres", "cuatro", "cinco", "seis", "siete", "ocho", "nueve"];
        $decena = ["", "", "veinte", "treinta", "cuarenta", "cincuenta", "sesenta", "setenta", "ochenta", "noventa"];
        $centena = ["", "cien", "doscientos", "trescientos", "cuatrocientos", "quinientos", "seiscientos", "setecientos", "ochocientos", "novecientos"];
        $especiales = [
            10 => "diez", 11 => "once", 12 => "doce", 13 => "trece", 14 => "catorce", 15 => "quince",
            16 => "dieciséis", 17 => "diecisiete", 18 => "dieciocho", 19 => "diecinueve"
        ];

        if ($numero == 0) {
            return "cero";
        }

        if ($numero < 10) {
            return $unidad[$numero];
        }

        if ($numero >= 10 && $numero < 20) {
            return $especiales[$numero];
        }

        if ($numero >= 20 && $numero < 100) {
            $dec = (int)($numero / 10);
            $uni = $numero % 10;
            return $decena[$dec] . ($uni > 0 ? " y " . $unidad[$uni] : "");
        }

        if ($numero >= 100 && $numero < 1000) {
            $cen = (int)($numero / 100);
            $resto = $numero % 100;
            return $centena[$cen] . ($resto > 0 ? " " . self::convertirParteEnteraALetras($resto) : "");
        }

        if ($numero >= 1000 && $numero < 1000000) {
            $mil = (int)($numero / 1000);
            $resto = $numero % 1000;
            return ($mil == 1 ? "mil" : self::convertirParteEnteraALetras($mil) . " mil") . ($resto > 0 ? " " . self::convertirParteEnteraALetras($resto) : "");
        }

        if ($numero >= 1000000) {
            $millon = (int)($numero / 1000000);
            $resto = $numero % 1000000;
            return ($millon == 1 ? "un millón" : self::convertirParteEnteraALetras($millon) . " millones") . ($resto > 0 ? " " . self::convertirParteEnteraALetras($resto) : "");
        }

        return "";
    }

    /**
     * Convierte un número al formato de moneda.
     *
     * @param float $numero
     * @param string $simboloMoneda
     * @return string
     */
    public static function convertirNumeroAMoneda($numero, $simboloMoneda = '$')
    {
        // Formatear con dos decimales y separadores de miles
        return $simboloMoneda . number_format($numero, 2, '.', ',');
    }
}
