@extends('layouts.app')
@section('styles')
    <style>
        .nav-link {
            text-decoration: none !important;
            color: #000 !important;
        }

        .active {
            color: #fff !important;
            background-color: rgb(217, 0, 0) !important;
        }
    </style>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12 text-center my-4">
            <h1 class="fs-2 fw-bold"><span class="text-danger fs-1 fw-bold">CEK</span>ongkir.com</h1>
            <p>Cek Ongkir Paket Anda ke Seluruh Wilayah Indonesia</p>
        </div>
    </div>
    <div class="row row-cols-1 row-cols-md-3 mb-3 text-center">
        <div class="col">
            <div class="card mb-4 rounded-3 shadow-sm">
                <div class="card-header py-3 text-bg-warning border-warning">
                    <h4 class="my-0 fw-normal">Free</h4>
                </div>
                <div class="card-body">
                    <i class="fa-solid fa-truck fa-5x"></i>
                    </h1>
                    <ul class="list-unstyled mt-3 mb-4">
                        <li>Cek Ongkir Lebih Mudah</li>
                    </ul>
                    <button type="button" class="w-100 btn btn-lg btn-warning">Sign up for
                        free</button>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card mb-4 rounded-3 shadow-sm">
                <div class="card-header py-3 text-bg-warning border-warning">
                    <h4 class="my-0 fw-normal">Pro</h4>
                </div>
                <div class="card-body">
                    <i class="fa-solid fa-box fa-5x"></i>
                    <ul class="list-unstyled mt-3 mb-4">
                        <li>Lacak Lokasi Paket lebih Akurat</li>
                    </ul>
                    <button type="button" class="w-100 btn btn-lg btn-warning">Get started</button>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card mb-4 rounded-3 shadow-sm">
                <div class="card-header py-3 text-bg-warning border-warning">
                    <h4 class="my-0 fw-normal">Enterprise</h4>
                </div>
                <div class="card-body">
                    <i class="fa-solid fa-plane-departure fa-5x"></i>
                    <ul class="list-unstyled mt-3 mb-4">
                        <li>Cek Ongkir Pengiriman Internasional</li>
                    </ul>
                    <button type="button" class="w-100 btn btn-lg btn-warning">Contact us</button>
                </div>
            </div>
        </div>
    </div>
    <div class="card shadow-sm">
        <div class="card-header bg-warning">
            <h4 class="text-capitalize pt-2 ps-2"><i class="fa-solid fa-list me-2"></i>formulir cek ongkir</h4>
        </div>
        <div class="card-body px-4">
            <form action="{{ route('cekOngkir') }}" method="POST" id="cekOngkirForm">
                @csrf
                <div class="form-group d-flex flex-column mb-4">
                    <label for="ekspedisi" class="h5 text-secondary">Ekspedisi:</label>
                    @foreach ($couriers as $courier)
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" name="courier[]" id="{{ $courier->courier_id }}"
                                value="{{ $courier->courier_id }}">
                            <label class="form-check-label" for="{{ $courier->courier_id }}">
                                {{ $courier->name }}
                            </label>
                        </div>
                    @endforeach
                </div>
                <div class="form-group d-flex flex-column mb-4">
                    <label for="wight" class="h5 text-secondary">Berat:</label>
                    <input type="number" class="form-control" name="weight" id="weight"
                        placeholder="Berat Paket (gram)" required>
                </div>
                <div class="my-3">
                    <h5 class="text-secondary">Asal Pengiriman:</h5>
                    <div class="form-group">
                        <label for="provinsi_asal" class="mb-1">Provinsi</label>
                        <select class="form-select province" id="provinsi_asal" name="provinsi_asal" required>
                            <option selected disabled></option>
                            @foreach ($provinces as $province)
                                <option value="{{ $province->province_id }}">{{ $province->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group my-3">
                        <label for="kota_kab_asal" class="mb-1">Kota/Kabupaten</label>
                        <select class="form-select city" id="kota_kab_asal" name="kota_kab_asal" required>
                            <option selected disabled></option>
                        </select>
                    </div>
                </div>
                <div class="mt-4">
                    <h5 class="text-secondary">Tujuan Pengiriman:</h5>
                    <div class="form-group">
                        <label for="provinsi_tujuan" class="mb-1">Provinsi</label>
                        <select class="form-select province" id="provinsi_tujuan" name="provinsi_tujuan" required>
                            <option selected disabled></option>
                            @foreach ($provinces as $province)
                                <option value="{{ $province->province_id }}">{{ $province->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group my-3">
                        <label for="kota_kab_tujuan" class="mb-1">Kota/Kabupaten</label>
                        <select class="form-select city" id="kota_kab_tujuan" name="kota_kab_tujuan" required>
                            <option selected disabled></option>
                        </select>
                    </div>
                </div>
                <div class="form-group d-flex mt-5 justify-content-center">
                    <button type="submit" class="btn btn-danger px-4">Cek</button>
                </div>
            </form>
        </div>
    </div>
    <div id="hasil_cek_ongkir">
    </div>
@endsection
