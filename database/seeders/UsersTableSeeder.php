<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'cesarin',
            'email' => 'perez@gmail.com',
            'email_verified_at' => now(),
            'password' => bcrypt('12345678'),
            'cedula' => '0400000712',
            'address' => 'Av. Palma Tamara',
            'phone' => '9841824470',
            'role' => 'admin',
        ]);

        User::create([
            'name' => 'Paciente1',
            'email' => 'paciente1@gmail.com',
            'email_verified_at' => now(),
            'password' => bcrypt('12345678'),
            'role' => 'paciente',
        ]);

        User::create([
            'name' => 'Medico 1',
            'email' => 'medico1@gmail.com',
            'email_verified_at' => now(),
            'password' => bcrypt('12345678'),
            'role' => 'doctor',
        ]);

        User::factory()
            ->count(200)
            ->state(['role' => 'paciente'])
            ->create();
    }
}
