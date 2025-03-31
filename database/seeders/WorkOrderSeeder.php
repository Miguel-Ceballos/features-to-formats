<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class WorkOrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $startDate = strtotime('2024-03-30');
        $endDate = strtotime('2025-03-30');

        foreach (range(1, 12) as $month) {
            for ($j = 0; $j < 10; $j++) {
                $randomTimestamp = mt_rand($startDate, $endDate);
                $randomDate = date('Y-m-d H:i:s', $randomTimestamp);

                DB::table('work_orders')->insert([
                    'category_id' => rand(1, 3),
                    'user_id' => rand(1, 3),
                    'client' => rand(1, 3),
                    'created_at' => $randomDate,
                    'updated_at' => $randomDate,
                ]);

                // Avanza el contador de las fechas para asegurar variedad
                $startDate = strtotime("+1 month", $startDate);
                $endDate = strtotime("+1 month", $endDate);
            }
        }
    }
}
