<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RekeningSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('rekenings')->insert([
            [
                'invitation_id' => 2,
                'role' => 'bride',
                'bank' => 'BCA',
                'nama' => 'Siti Aisyah',
                'nomor_rekening' => '1234567890',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'invitation_id' => 2,
                'role' => 'groom',
                'bank' => 'BNI',
                'nama' => 'Ahmad Fulan',
                'nomor_rekening' => '9876543210',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

    }
}
