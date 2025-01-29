<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use App\Traits\Auditable;
use App\Helpers\GeneralHelper;

class PagoLote extends Model
{
    use HasFactory;

    // Propiedad para almacenar la razón temporal de auditoría
    protected $auditReason;



    // Definir el nombre de la tabla si es diferente al plural del modelo
   // protected $table = 'pagos_lote';

    // Permitir asignación masiva para estos campos
    protected $fillable = [
        'idPredio',
        'idLote',
        'folio',
        'idContrato',
        'idCliente',
        'motivo',
        'tipoPago',
        'referenciaBancaria',
        'monto',
        'pagoNumero',
        'deudaAnterior',
        'fechaPago',
        'horaPago',
        'idUsuario',
        'observacion',
        'cancelar',
        'idUsuarioCancela',
        'pagoValidado',
        'idUsuarioValidaPago',
        'historico',
    ];

    // Definir las relaciones con otros modelos
    public function predio()
    {
        return $this->belongsTo(Predio::class, 'idPredio');
    }

    public function lote()
    {
        return $this->belongsTo(Lote::class, 'idLote');
    }

    public function cliente()
    {
        return $this->belongsTo(Cliente::class, 'idCliente');
    }

    public function usuario()
    {
        return $this->belongsTo(User::class, 'idUsuario');
    }

    public function usuarioCancela()
    {
        return $this->belongsTo(User::class, 'idUsuarioCancela');
    }

    public function usuarioValidaPago()
    {
        return $this->belongsTo(User::class, 'idUsuarioValidaPago');
    }

    public function contrato()
    {
        return $this->belongsTo(Contrato::class, 'idContrato', 'id');
    }

    public function getMontoFormateadoAttribute()
    {
        return  GeneralHelper::convertirNumeroALetras($this->monto);
    }

    //propiedades virtuales
     // calcular mes y año de la mensaudlidad basado en pagoNumero , segun la tabla de amortizacion de la mensualidad, emplo: si el contrato se realizo en enero de 2024, la letra 1  seria enero de 2024, la letra 2 seria febrero de 2024, la letra 13 seria enero de 2025; la letra 14 seria febrero de 2025
    public function getPagoCorrespondienteAttribute()
    {
        $meses = [
            1 => 'Enero', 2 => 'Febrero', 3 => 'Marzo', 4 => 'Abril', 5 => 'Mayo', 6 => 'Junio',
            7 => 'Julio', 8 => 'Agosto', 9 => 'Septiembre', 10 => 'Octubre', 11 => 'Noviembre', 12 => 'Diciembre'
        ];
          // Convertir fechaCelebracion a objeto Carbon si es cadena
          $fechaCelebracion = Carbon::parse($this->contrato->fechaCelebracion);
          $anio = $fechaCelebracion->year;
          $mes = $fechaCelebracion->month;


          if($this->motivo == 'Enganche')
          {
             $TotalEnganche = $this->contrato->getTotalEnganchePagadoAttribute();

             if($TotalEnganche == $this->contrato->enganche)
             {
                    return "Enganche, pagado";
             }
             else
             {
                return "Enganche, abono";
             }
          }


        if($this->motivo == 'Anualidad')
        {
            // verificar si pago_lotes->pagoNumero y regresa "Anualidad 1 de 2024" si es la ultoma anualidad de contrato->anualeades , regresa " Anualidad X de anio, Ultima anualidad"
            if($this->pagoNumero == $this->contrato->anualidades)
            {
                return "Anualidad $this->pagoNumero de $anio, Ultima anualidad";
            }
            else
            {
                return "Anualidad $this->pagoNumero de $anio";
            }

        }

        if ($this->motivo == 'Mensualidad') {
            $pagoNumero = $this->pagoNumero;

            $temporalidadPago = $this->contrato->convenioTemporalidadPago;

            if ($temporalidadPago == 'Mensual') {
                // Ajustar el mes y año considerando pagos que excedan varios años
                $mes += $pagoNumero - 1; // Resta 1 porque el primer pago corresponde al mes inicial
                $anio += intdiv($mes, 12); // Incrementa el año según los ciclos completos de 12 meses
                $mes = $mes % 12 ?: 12; // Ajusta el mes dentro del rango 1-12

                return "{$meses[$mes]} de $anio";
            } else {
                // Lógica para pagos quincenales
                $quincena = ($pagoNumero % 2 == 0) ? '2da quincena' : '1ra quincena';
                $mesesPagados = intdiv($pagoNumero - 1, 2); // Ajustar los pagos quincenales
                $mes += $mesesPagados;
                $anio += intdiv($mes, 12); // Incrementa el año según los ciclos completos de 12 meses
                $mes = $mes % 12 ?: 12;

                return "{$quincena} de {$meses[$mes]} de $anio";
            }
        }
    }

}
