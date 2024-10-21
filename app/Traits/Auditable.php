<?php

namespace App\Traits;

use Illuminate\Support\Facades\Auth;
use App\Repositories\BitacoraRepositoryInterface;

trait Auditable
{
    // Registrar eventos para crear, actualizar y eliminar registros
    public static function bootAuditable()
    {
        static::created(function ($model) {
            static::audit('Creación', $model);
        });

        static::updated(function ($model) {
            // Aquí puedes pasar una razón especial si es que la actualización es derivada de una creación
            $reason = $model->getAuditReason() ?? null;
            static::audit('Actualización', $model, $model->getOriginal(), $model->getChanges(), $reason);
        });

        static::deleted(function ($model) {
            static::audit('Eliminación', $model);
        });
    }

    // Función que se encargará de registrar la acción en la bitácora
    protected static function audit($operation, $model, $oldValues = null, $newValues = null, $reason = null)
    {
        $descripcion = 'Operación de ' . $operation . ' en ' . class_basename($model) . ' con ID ' . $model->getKey();

        // Si es una actualización, agregar los detalles de los valores antiguos y nuevos
        if ($operation === 'Actualización' && $oldValues && $newValues) {
            $cambios = [];
            foreach ($newValues as $campo => $valorNuevo) {
                $valorAntiguo = $oldValues[$campo] ?? null;
                if ($valorAntiguo !== $valorNuevo) {
                    $cambios[] = "$campo: ($valorAntiguo) -> ($valorNuevo)";
                }
            }
            $descripcion .= '. Cambios: ' . implode(', ', $cambios);
        }

        // Agregar una razón en la descripción si se proporcionó
        if ($reason) {
            $descripcion .= '. Motivo: ' . $reason;
        }

        app(BitacoraRepositoryInterface::class)->create([
            'fecha' => now(),
            'usuario' => Auth::check() ? Auth::user()->id : null,
            'tabla' => $model->getTable(),
            'tipoOperacion' => $operation,
            'campoLlave' => $model->getKey(),
            'descripcion' => $descripcion,
            'ip' => request()->ip(),
            'user_agent' => request()->userAgent(),
        ]);
    }
}
