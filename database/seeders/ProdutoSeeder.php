<?php

namespace Database\Seeders;

use App\Models\Produto;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class ProdutoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         $faker = Faker::create();

        // Criar 10 produtos de exemplo
        for ($i = 0; $i < 10; $i++) {
            Produto::create([
                'nome' => $faker->word(),
                'descricao' => $faker->sentence(10),
                'preco' => $faker->randomFloat(2, 10, 500),
                'quantidade' => $faker->numberBetween(0, 100),
                'quantidade_minima' => $faker->numberBetween(1, 10),
            ]);
        }
    }
}
