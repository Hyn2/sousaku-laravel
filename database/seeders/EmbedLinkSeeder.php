<?php

namespace Database\Seeders;

use App\Models\EmbedLink;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EmbedLinkSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $link = '';
        EmbedLink::create([
            'link' => $link,
        ]);
    }
}
