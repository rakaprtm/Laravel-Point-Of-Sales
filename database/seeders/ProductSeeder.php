<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Products; // pastikan namespace modelnya bener

class ProductSeeder extends Seeder
{
    public function run()
    {
        Products::factory()->count(50)->create();
    }
}
