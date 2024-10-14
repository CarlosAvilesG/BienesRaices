<?php

namespace Database\Factories;

use App\Models\Lote;
use Illuminate\Database\Eloquent\Factories\Factory;

class LoteFactory extends Factory
{
    protected $model = Lote::class;

    public function definition()
    {
        return [
            'idPredio' => 1,  // Cambia según tus necesidades
            'manzana' => $this->faker->numberBetween(1, 20),
            'lote' => $this->faker->numberBetween(1, 10),
            'descripcion' => $this->faker->sentence,
            'regular' => true,
            'inhabilitado' => false,
            'precio' => $this->faker->randomFloat(2, 10000, 50000),
            'idContrato' => null,  // Lote disponible
            'metrosFrente' => $this->faker->randomFloat(2, 5, 20),  // Valor para metrosFrente
            'metrosAtras' => $this->faker->randomFloat(2, 5, 20),   // Incluye todos los campos requeridos
            'metrosDerecho' => $this->faker->randomFloat(2, 5, 20),
            'metrosIzquierda' => $this->faker->randomFloat(2, 5, 20),
            'metrosCuadrados' => $this->faker->randomFloat(2, 100, 500),
        ];
    }
}
