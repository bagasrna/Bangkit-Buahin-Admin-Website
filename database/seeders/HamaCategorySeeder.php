<?php

namespace Database\Seeders;

use App\Models\HamaCategory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class HamaCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();
        HamaCategory::truncate();

        HamaCategory::create([
            'name' => 'Identifikasi Gejala Serangan Hama',
        ]);

        HamaCategory::create([
            'name' => 'Hama Tebu',
        ]);

        HamaCategory::create([
            'name' => 'Musuh Alami Hama Tebu',
        ]);

        HamaCategory::create([
            'name' => 'Tanaman Mengering',
            'parent_id' => 1
        ]);

        HamaCategory::create([
            'name' => 'Tanaman/batang/tunas mati',
            'parent_id' => 1
        ]);

        HamaCategory::create([
            'name' => 'Pertumbuhan tanaman terhambat',
            'parent_id' => 1
        ]);

        HamaCategory::create([
            'name' => 'Gap pertumbuhan/keprasan tidak tumbuh',
            'parent_id' => 1
        ]);

        HamaCategory::create([
            'name' => 'Tanaman roboh',
            'parent_id' => 1
        ]);

        HamaCategory::create([
            'name' => 'Mati puser (daun menggulung kering)',
            'parent_id' => 1
        ]);

        HamaCategory::create([
            'name' => 'Tanaman muncul siwilan',
            'parent_id' => 1
        ]);

        HamaCategory::create([
            'name' => 'Gerekan (bekas dimakan) pada batang',
            'parent_id' => 1
        ]);

        Schema::enableForeignKeyConstraints();
    }
}
