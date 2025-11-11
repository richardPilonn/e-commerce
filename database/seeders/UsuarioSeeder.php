<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Usuario;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker;

class UsuarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       $faker = Faker::create();

        // Criar 10 usuários de exemplo
        for ($i = 0; $i < 10; $i++) {

            // Criando o usuário na tabela 'users'
            $user = User::create([
                'name' => 'Usuario' . $i,
                'email' => 'Usuario' . $i . '@test.com',
                'password' => Hash::make('123456'), // Senha para o usuário
            ]);

            // Criando o registro na tabela 'usuarios', associando o ID do usuário e o email
            Usuario::create([
                'nome' => $faker->name(),
                'email' => $user->email,   // Email do usuário
                'password' => Hash::make('123456'), // Senha do usuário, se necessário
                'user_id' => $user->id,    // ID do usuário que está sendo relacionado
            ]);
        }
    }
}
