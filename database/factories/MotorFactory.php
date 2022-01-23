<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Motor;
use Faker\Generator as Faker;
use Carbon\Carbon;

$factory->define(Motor::class, function (Faker $faker) {
    $faker->addProvider(new \Faker\Provider\Fakecar($faker));
    return [
        'tahun_keluaran' => $faker->numberBetween(1990,2021),
        'warna' => $faker->colorName,
        'harga' => $faker->numberBetween(20,500)*1000000,
        'mesin' => $faker->vehicleModel,
        'tipe_suspensi' => $faker->vehicleType,
        'tipe_transmisi' => $faker->vehicleGearBoxType,
        'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        'updated_at' => Carbon::now()->format('Y-m-d H:i:s') 
    ];
});