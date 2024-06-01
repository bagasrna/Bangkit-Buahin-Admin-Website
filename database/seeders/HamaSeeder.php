<?php

namespace Database\Seeders;

use App\Models\Hama;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class HamaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();
        Hama::truncate();

        $hama = Hama::create([
            'title' => 'Tonggaret',
            'description' => 'Tibicis sp. (Hermiptera: Cicadidae)',
            'pencegahan' => 'Pencegahan dilakukan dengan menggunakan apa',
            'pengendalian' => 'Pengendalian hanya didasari oleh adanya kenapa'
        ]);

        $hama->categories()->attach([3, 4]);
        Schema::enableForeignKeyConstraints();
    }
}
