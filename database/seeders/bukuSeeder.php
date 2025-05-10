<?php

namespace Database\Seeders;

use App\Models\buku;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class bukuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = \Faker\Factory::create('id_ID');
        for($i=0;$i < 10; $i++) {
            buku::create([
                'judul' => $faker->sentence(),
                'pengarang' => $faker->name(),
                'tanggal_publikasi' => $faker->date(),
            ]);
        }
    }
}
