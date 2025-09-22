<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Vehicle;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class DashboardControllerTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    #[Test]
    public function it_returns_combined_search_results_for_query()
    {
        // Crear un usuario y vehículo relacionado
        $user = User::factory()->create([
            'nombre' => 'Juan',
            'email' => 'juan@example.com',
        ]);

        $vehicle = Vehicle::factory()->create([
            'marca' => 'Toyota',
            'modelo' => 'Corolla',
            'matricula' => '1234ABC',
            'user_id' => $user->id,
        ]);

        // Ejecutar la petición
        $response = $this->json('GET', '/dashboard/search', [
            'query' => 'Toyota'
        ]);

        // Aserciones
        $response->assertStatus(200);
        $response->assertJsonFragment([
            'marca' => 'Toyota',
            'modelo' => 'Corolla',
        ]);
    }

    #[Test]
    public function it_returns_500_on_exception()
    {
        // Simular error lanzando excepción (mock del modelo User)
        $this->mock(\App\Models\User::class, function ($mock) {
            $mock->shouldReceive('where')->andThrow(new \Exception('DB error'));
        });

        $response = $this->json('GET', '/dashboard/search', [
            'query' => 'error'
        ]);

        $response->assertStatus(500);
        $response->assertJson([
            'error' => 'Se produjo un error en el servidor.',
        ]);
    }
}
