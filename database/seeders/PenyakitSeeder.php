<?php

namespace Database\Seeders;

use App\Models\Penyakit;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class PenyakitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();
        Penyakit::truncate();

        $penyakit = Penyakit::create([
            'title' => 'Embun Bulu',
            'description' => 'Downey Mildew',
            'penyebab_penyakit' => 'Pencegahan dilakukan dengan menggunakan apa',
            'pengendalian' => 'Pengendalian hanya didasari oleh adanya kenapa',
            'penularan_penyakit' => 'Penularan hanya didasari oleh adanya kenapa',
            'waktu_terjadi_serangan' => 'Kejadian serangan hanya didasari oleh adanya kenapa'
        ]);

        $penyakit->categories()->attach([4, 5]);
        Schema::enableForeignKeyConstraints();
    }
}
