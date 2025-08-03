<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\GajiKurir;
use App\Models\User;
use App\Models\Gaji;

class GajiKurirSeeder extends Seeder
{
    /**
     * Run the database seeder.
     */
    public function run(): void
    {
        // Check if gaji settings exist
        $gajiSettings = Gaji::first();
        if (!$gajiSettings) {
            $gajiSettings = Gaji::create([
                'paket_bawaan' => 5000,
                'paket_jemputan' => 7000,
                'potongan_bpjs' => 50000
            ]);
        }

        // Get some users to act as kurirs
        $users = User::take(3)->get();

        if ($users->count() > 0) {
            foreach ($users as $user) {
                // Create sample gaji kurir data
                GajiKurir::create([
                    'kurir_id' => $user->id,
                    'tanggal_kerja' => now()->subDays(rand(1, 30)),
                    'pikup' => rand(10, 50),
                    'pud' => rand(5, 30),
                    'total' => 0 // Will be calculated by model observer or controller
                ]);

                GajiKurir::create([
                    'kurir_id' => $user->id,
                    'tanggal_kerja' => now()->subDays(rand(1, 30)),
                    'pikup' => rand(10, 50),
                    'pud' => rand(5, 30),
                    'total' => 0 // Will be calculated by model observer or controller
                ]);
            }

            // Update totals after creation
            $gajiKurirs = GajiKurir::all();
            foreach ($gajiKurirs as $gajiKurir) {
                $totalPaketBawaan = $gajiKurir->pikup * $gajiSettings->paket_bawaan;
                $totalPaketJemputan = $gajiKurir->pud * $gajiSettings->paket_jemputan;
                $totalGaji = $totalPaketBawaan + $totalPaketJemputan - $gajiSettings->potongan_bpjs;
                
                $gajiKurir->update(['total' => $totalGaji]);
            }
        }
    }
}
