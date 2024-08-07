<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Rdj\Rajaongkir\Facades\Rajaongkir;

class HomeController extends Controller
{
    public function index()
    {
        $provinces = DB::table('provinces')->get();
        $couriers = DB::table('couriers')->get();

        $data=[
            'title' => 'Home',
            'provinces' => $provinces,
            'couriers' => $couriers
        ];
        
        return view('index', $data);
    }

    public function getCities($province_id)
    {
        $cities = DB::table('cities')->where('province_id', $province_id)->get();

        return response()->json($cities);
    }

    public function cekOngkir(Request $request)
    {
        // dd($request->all());
        $courier = $request->courier;

        $data = [
            'origin' => $request->kota_kab_asal,
            'destination' => $request->kota_kab_tujuan,
            'weight' => $request->weight,
            'result' => []
        ];

        if ($courier) {
            $result = [];

            foreach ($courier as $row) {
                $ongkir = Http::withOptions(['verify' => false,])->withHeaders([
                    'key' => env('RAJAONGKIR_API_KEY')
                ])->post('https://api.rajaongkir.com/starter/cost', [
                            'origin' => $request->kota_kab_asal,
                            'destination' => $request->kota_kab_tujuan,
                            'weight' => $data['weight'],
                            'courier' => $row
                        ])->json()['rajaongkir']['results'][0];
                        // dd($ongkir);
                $data['result'][] = $ongkir;
            }
  
            return response()->json($data);
        }
         
    }
}