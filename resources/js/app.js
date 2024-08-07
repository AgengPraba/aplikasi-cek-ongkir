import $ from "jquery";
import select2 from "select2";

window.$ = $;
select2();

$("#provinsi_asal").change(function () {
    var province_id = $(this).val();
    var url = `/api/getCities/${province_id}`;

    $.ajax({
        url: url,
        type: "GET",
        success: function (result) {
            $("#kota_kab_asal").empty();
            $("#kota_kab_asal").append(
                "<option selected disabled>Pilih Kota/Kabupaten</option>"
            );
            $.each(result, function (key, value) {
                $("#kota_kab_asal").append(
                    '<option value="' +
                        value.city_id +
                        '">' +
                        value.name +
                        "</option>"
                );
            });
        },
    });
});

$("#provinsi_tujuan").change(function () {
    var province_id = $(this).val();
    var url = `/api/getCities/${province_id}`;

    $.ajax({
        url: url,
        type: "GET",
        success: function (result) {
            $("#kota_kab_tujuan").empty();
            $("#kota_kab_tujuan").append(
                "<option selected disabled>Pilih Kota/Kabupaten</option>"
            );
            $.each(result, function (key, value) {
                $("#kota_kab_tujuan").append(
                    '<option value="' +
                        value.city_id +
                        '">' +
                        value.name +
                        "</option>"
                );
            });
        },
    });
});

$(".expedition").select2({
    placeholder: "Pilih Ekspedisi",
    allowClear: true,
});

$(".province").select2({
    placeholder: "Pilih Provinsi",
    allowClear: true,
});

$(".city").select2({
    placeholder: "Pilih Kota/Kabupaten",
    allowClear: true,
});

$("#cekOngkirForm").on("submit", function (e) {
    e.preventDefault();

    $("#hasil_cek_ongkir").empty();

    $("#hasil_cek_ongkir").append(`
                <div class="card shadow-sm mt-3">
                    <div class="card-header bg-warning">
                        <h4 class="text-capitalize pt-2 ps-2"><i class="fa-solid fa-list me-2"></i>hasil cek ongkir</h4>
                    </div>
                    <div class="card-body">
                        <div class="d-flex justify-content-center">
                            <div class="spinner-border text-dark" role="status">
                                <span class="sr-only">Loading...</span>
                            </div>
                        </div>
                    </div>
                </div>
            `);

    // Ambil data dari setiap elemen form
    var couriers = [];
    $("input[name='courier[]']:checked").each(function () {
        couriers.push($(this).val());
    });

    var data = {
        _token: $("input[name='_token']").val(),
        courier: couriers,
        weight: $("#weight").val(),
        provinsi_asal: $("#provinsi_asal").val(),
        kota_kab_asal: $("#kota_kab_asal").val(),
        provinsi_tujuan: $("#provinsi_tujuan").val(),
        kota_kab_tujuan: $("#kota_kab_tujuan").val(),
    };

    $.ajax({
        url: `/cekOngkir`,
        type: "POST",
        data: data,
        success: function (response) {
            $("#hasil_cek_ongkir").empty();
            // Pastikan response.result ada dan merupakan array
            if (response.result && Array.isArray(response.result)) {
                let tableContent = `
                <div class="card shadow-sm mt-3">
                    <div class="card-header bg-warning">
                        <h4 class="text-capitalize pt-2 ps-2"><i class="fa-solid fa-list me-2"></i>hasil cek ongkir</h4>
                    </div>
                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Nama</th>
                                    <th>Layanan</th>
                                    <th>Deskripsi</th>
                                    <th>Harga</th>
                                    <th>Estimasi Hari</th>
                                </tr>
                            </thead>
                            <tbody>
            `;

                response.result.forEach(function (result) {
                    result.costs.forEach(function (cost) {
                        tableContent += `
                            <tr>
                                <td>${result.name}</td>
                                <td>${cost.service}</td>
                                <td>${cost.description}</td>
                                <td>${cost.cost[0].value}</td>
                                <td>${cost.cost[0].etd}</td>
                            </tr>
                    `;
                    });
                });

                tableContent += `
                            </tbody>
                        </table>
                    </div>
                </div>
            `;

                $("#hasil_cek_ongkir").append(tableContent);
            } else {
                $("#hasil_cek_ongkir").append(`
                    <div class="card shadow-sm mt-3">
                        <div class="card-body">
                            <p>Data hasil cek ongkir tidak ditemukan.</p>
                        </div>
                    </div>
                `);
            }
        },
        error: function (xhr) {
            $("#hasil_cek_ongkir").append(`
                <div class="card-body">
                    <p>Terjadi kesalahan dalam proses cek ongkir.</p>
                </div>
            `);
        },
    });
});
