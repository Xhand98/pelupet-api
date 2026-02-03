<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $services = [
            [
                'name' => 'Baño Completo',
                'description' => 'Baño completo con shampoo especial, secado y cepillado',
                'category' => 'grooming',
                'price' => 25.00,
                'duration' => 60,
                'is_active' => true,
            ],
            [
                'name' => 'Corte de Pelo',
                'description' => 'Corte de pelo personalizado según raza',
                'category' => 'grooming',
                'price' => 30.00,
                'duration' => 45,
                'is_active' => true,
            ],
            [
                'name' => 'Limpieza Dental',
                'description' => 'Limpieza dental profesional',
                'category' => 'veterinary',
                'price' => 50.00,
                'duration' => 30,
                'is_active' => true,
            ],
            [
                'name' => 'Consulta Veterinaria',
                'description' => 'Consulta general con veterinario',
                'category' => 'veterinary',
                'price' => 35.00,
                'duration' => 30,
                'is_active' => true,
            ],
            [
                'name' => 'Vacunación',
                'description' => 'Aplicación de vacunas según calendario',
                'category' => 'veterinary',
                'price' => 20.00,
                'duration' => 15,
                'is_active' => true,
            ],
            [
                'name' => 'Spa Premium',
                'description' => 'Tratamiento spa completo con masajes',
                'category' => 'grooming',
                'price' => 60.00,
                'duration' => 90,
                'is_active' => true,
            ],
        ];

        foreach ($services as $service) {
            \App\Models\Service::create($service);
        }
    }
}
