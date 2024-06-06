<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Feature;

class FeaturesTableSeeder extends Seeder
{
    public function run()
    {
        $features = [
            ['nama_fitur' => 'user-management'],
            ['nama_fitur' => 'kkn-management'],
        ];

        foreach ($features as $feature) {
            Feature::create($feature);
        }
    }
}
