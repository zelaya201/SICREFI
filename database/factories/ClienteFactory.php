<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Cliente>
 */
class ClienteFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
          'dui_cliente' => $this->faker->unique()->regexify('^\d{9}$'),
          'primer_nom_cliente' => $this->faker->firstName(),
          'segundo_nom_cliente' => $this->faker->firstName(),
          'primer_ape_cliente' => $this->faker->lastName(),
          'segundo_ape_cliente' => $this->faker->lastName(),
          'fech_nac_cliente' => $this->faker->date(),
          'dir_cliente' => $this->faker->address(),
          'email_cliente' => $this->faker->email(),
          'estado_civil_cliente' => 'Soltero',
          'tipo_vivienda_cliente' => 'Alquilada',
          'ocupacion_cliente' => 'Empresario',
          'gasto_aliment_cliente' => $this->faker->numberBetween(1,100),
          'gasto_agua_cliente' => $this->faker->numberBetween(1,100),
          'gasto_luz_cliente' => $this->faker->numberBetween(1,100),
          'gasto_cable_cliente' => $this->faker->numberBetween(1,100),
          'gasto_vivienda_cliente' => $this->faker->numberBetween(1,100),
          'gasto_otro_cliente' => $this->faker->numberBetween(1,100),
          'estado_cliente' => 'Activo',
          'created_at' => $this->faker->dateTime(),
          'updated_at' => $this->faker->dateTime(),
        ];
    }
}
