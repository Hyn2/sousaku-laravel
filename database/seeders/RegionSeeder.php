<?php

namespace Database\Seeders;

use App\Models\Region;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RegionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $regions = array('서울', '인천', '대전', '대구', '광주', '울산', '부산',
                         '경기', '전북', '전남', '충북', '충남', '경북', '경남',
                         '강원', '제주', '세종');

        foreach ($regions as $value) {
            Region::create([
                'region' => $value,
            ]);
        }
    }
}
