<?php

namespace Database\Seeders;

use App\Models\PenyakitCategory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class PenyakitCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();
        PenyakitCategory::truncate();

        PenyakitCategory::create([
            'name' => 'Identifikasi Gejala Serangan Penyakit',
        ]);

        PenyakitCategory::create([
            'name' => 'Penyakit Tebu',
        ]);

        PenyakitCategory::create([
            'name' => 'Gejala Lainnya',
        ]);

        PenyakitCategory::create([
            'name' => 'Tanaman Mengering',
            'parent_id' => 1
        ]);

        PenyakitCategory::create([
            'name' => 'Tanaman/batang/tunas mati',
            'parent_id' => 1
        ]);

        PenyakitCategory::create([
            'name' => 'Pertumbuhan tanaman terhambat',
            'parent_id' => 1
        ]);

        PenyakitCategory::create([
            'name' => 'Gap pertumbuhan/keprasan tidak tumbuh',
            'parent_id' => 1
        ]);

        PenyakitCategory::create([
            'name' => 'Tanaman roboh',
            'parent_id' => 1
        ]);

        PenyakitCategory::create([
            'name' => 'Mati puser (daun menggulung kering)',
            'parent_id' => 1
        ]);

        PenyakitCategory::create([
            'name' => 'Tanaman muncul siwilan',
            'parent_id' => 1
        ]);

        PenyakitCategory::create([
            'name' => 'Gerekan (bekas dimakan) pada batang',
            'parent_id' => 1
        ]);

        PenyakitCategory::create([
            'name' => 'Penyakit Sistemik',
            'parent_id' => 2
        ]);

        PenyakitCategory::create([
            'name' => 'Penyakit Lokal',
            'parent_id' => 2
        ]);

        Schema::enableForeignKeyConstraints();
    }
}
