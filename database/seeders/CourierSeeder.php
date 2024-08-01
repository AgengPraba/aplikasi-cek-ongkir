<?php

namespace Database\Seeders;

use App\Models\Courier;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CourierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Courier::insert([
            [
                'courier_id'=>'jne',
                'name'=>'Jalur Nugraha Ekakurir (JNE)'
            ],
            [
                'courier_id'=>'pos',
                'name'=>'POS Indonesia (POS)'
            ],
            [
                'courier_id'=>'tiki',
                'name'=>'Citra Van Titipan Kilat (TIKI)'
            ]
        ]);
    }
}
