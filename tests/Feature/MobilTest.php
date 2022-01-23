<?php

namespace Tests\Feature;

use App\Models\Mobil;
use Tests\TestCase;

class MobilTest extends TestCase
{
    public function testSuccessfulInsert()
    {
        $mobilData = [
            "tahun_keluaran" => "1997",
            "warna" => "biru tua metalik",
            "harga" => 50000000,
            "mesin" => "4JA1",
            "kapasitas_penumpang" => 8,
            "tipe" => "MPV"
        ];

        $this->json('POST', 'api/mobil', $mobilData, ['Accept' => 'application/json'])
            ->assertStatus(200)
            ->assertJsonStructure([
                'data' => [
                    '_id',
                    'tahun_keluaran',
                    'warna',
                    'harga',
                    'mesin',
                    'kapasitas_penumpang',
                    'tipe'
                ],
            ]);
    }
}