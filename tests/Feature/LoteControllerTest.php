<?php

namespace Tests\Feature;

use App\Models\Lote;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LoteControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_returns_lotes_by_predio_in_json_format()
    {
        // Autenticar un usuario antes de realizar la solicitud
        $user = User::factory()->create(); // Creación del usuario
        $this->actingAs($user); // Simula la autenticación

        // Crea un predio y algunos lotes
        Lote::factory()->create([
            'idPredio' => 1,
            'inhabilitado' => false,
            'idContrato' => null,  // Lote disponible
            'metrosFrente' => 10.5,
            'metrosAtras' => 10.5,
            'metrosDerecho' => 15.0,
            'metrosIzquierda' => 15.0,
            'metrosCuadrados' => 150.0,
        ]);

        Lote::factory()->create([
            'idPredio' => 1,
            'inhabilitado' => false,
            'idContrato' => null,  // Lote disponible
            'metrosFrente' => 12.0,
            'metrosAtras' => 12.0,
            'metrosDerecho' => 17.0,
            'metrosIzquierda' => 17.0,
            'metrosCuadrados' => 200.0,
        ]);

        // Simula una solicitud GET al endpoint de lotes por predio
        $response = $this->getJson(route('lotes.byPredio', ['idPredio' => 1]));

        // Verifica que la respuesta sea correcta
        $response->assertStatus(200)
                 ->assertJsonCount(2, 'lotes') // Verifica que hay 2 lotes en el JSON
                 ->assertJsonStructure([
                     'lotes' => [
                         '*' => ['id', 'idPredio', 'manzana', 'lote', 'descripcion', 'precio'],
                     ]
                 ]);
    }

    public function test_it_returns_error_if_no_lotes_available()
    {
        // Autenticar un usuario antes de realizar la solicitud
        $user = User::factory()->create();
        $this->actingAs($user);  // Simula la autenticación

        // Simula una solicitud GET a un predio sin lotes
        $response = $this->getJson(route('lotes.byPredio', ['idPredio' => 999]));

        // Verifica que se devuelva un error 404
        $response->assertStatus(404)
                 ->assertJson(['error' => 'No se encontraron lotes para el predio seleccionado']);
    }
}
