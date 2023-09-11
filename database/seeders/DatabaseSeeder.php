<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Faker\Factory as FakerFactory;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(RolSeeder::class);
        $faker = FakerFactory::create();
        
        User::create([
            'name' => 'Administrador',
            'email' => 'issac_ca93@hotmail.com',
            'password' => bcrypt('1234'),
            'cedula' => $faker->unique()->numerify('##########'), // Generar una cédula única de 10 dígitos
            'fechaNacimiento' => '2000-01-01',
            'telefono' => '0999114298',
            'genero' => 'O'
        ])->assignRole('Admin');
        User::create([
            'name' => 'Entrenador',
            'email' => 'e1723248702@uisrael.edu.ec',
            'password' => bcrypt('1234'),
            'cedula' => $faker->unique()->numerify('##########'), // Generar una cédula única de 10 dígitos
            'fechaNacimiento' => '2000-01-01',
            'telefono' => '0999114298',
            'genero' => 'O'
        ])->assignRole('Entrenador');   
        // User::factory(5)->create();
        User::factory(5)->create([
            'cedula' => $faker->unique()->numerify('##########'), // Generar cédulas únicas para los usuarios generados por la fábrica
        ]);    
    }
}
