<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Mobil;
use Faker\Generator as Faker;
use Carbon\Carbon;

$factory->define(Mobil::class, function (Faker $faker) {
    $faker->addProvider(new \Faker\Provider\Fakecar($faker));
    return [
        'tahun_keluaran' => $faker->numberBetween(1990,2021),
        'warna' => $faker->colorName,
        'harga' => $faker->numberBetween(20,500)*1000000,
        'mesin' => $faker->vehicleModel,
        'kapasitas_penumpang' => $faker->vehicleSeatCount,
        'tipe' => $faker->vehicleType,
        'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
    ];
});