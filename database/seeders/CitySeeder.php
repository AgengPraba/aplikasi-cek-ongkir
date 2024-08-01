<?php

namespace Database\Seeders;

use App\Models\City;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $fileKota = file_get_contents(base_path('database/data/kota.json'));
        $dataKota = json_decode($fileKota, true);

        $fileKabupaten= file_get_contents(base_path('database/data/kabupaten.json'));
        $dataKabupaten= json_decode($fileKabupaten, true);

        $data = array_merge($dataKota, $dataKabupaten);

        City::insert($data);

    }
}