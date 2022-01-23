<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Carbon\Carbon;

class MobilSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$faker = Faker::create('id_ID');
        $faker->addProvider(new \Faker\Provider\Fakecar($faker));
        for($i = 1; $i <= 50; $i++){
          DB::collection('mobil')->insert([
              'tahun_keluaran' => $faker->numberBetween(1990,2021),
              'warna' => $faker->colorName,
              'harga' => $faker->numberBetween(20,500)*1000000,
              'mesin' => $faker->vehicleModel,
              'kapasitas_penumpang' => $faker->vehicleSeatCount,
              'tipe' => $faker->vehicleType,
              'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
              'updated_at' => Carbon::now()->format('Y-m-d H:i:s') 
          ]);
        }
    }
}
