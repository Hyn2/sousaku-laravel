<?php

namespace Database\Seeders;

use App\Models\Position;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PositionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */

    public function run(): void
    {
        $positions = array('보컬', '기타', '베이스', '드럼', '건반', '믹싱, 마스터링');
        // 배열 안에 있는 값 만큼 생성
        foreach ($positions as $value) {
            Position::create([
                'position' => $value,
            ]);
        }
    }
}
