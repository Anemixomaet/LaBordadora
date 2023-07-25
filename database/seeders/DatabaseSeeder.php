<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

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
        User::factory(10)->create();
        User::create([
            'name' => 'Administrador',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('1234')
        ])->assignRole('Admin');
        User::create([
            'name' => 'Entrenador',
            'email' => 'entrenador@gmail.com',
            'password' => bcrypt('1234')
        ])->assignRole('Entrenador');        
    }
}
