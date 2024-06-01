<?php

namespace Database\Seeders;

use App\Models\Gulma;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class GulmaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();
        Gulma::truncate();

        Gulma::create([
            'title' => 'Embun Bulu'
        ]);

        Schema::enableForeignKeyConstraints();
    }
}
