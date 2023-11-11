<?php

namespace Fintech\Core\Seeders;

use Illuminate\Database\Seeder;
use Fintech\Core\Facades\Core;

class ApiLogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = $this->data();

        foreach (array_chunk($data, 200) as $block) {
            set_time_limit(2100);
            foreach ($block as $entry) {
                Core::apiLog()->create($entry);
            }
        }
    }

    private function data()
    {
        return array();
    }
}