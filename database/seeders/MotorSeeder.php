<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Carbon\Carbon;

class MotorSeeder extends Seeder
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
          DB::collection('motor')->insert([
              'tahun_keluaran' => $faker->numberBetween(1990,2021),
              'warna' => $faker->colorName,
              'harga' => $faker->numberBetween(20,500)*1000000,
              'mesin' => $faker->vehicleModel,
              'tipe_suspensi' => $faker->vehicleType,
              'tipe_transmisi' => $faker->vehicleGearBoxType,
              'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
              'updated_at' => Carbon::now()->format('Y-m-d H:i:s') 
          ]);
        }
    }
}
