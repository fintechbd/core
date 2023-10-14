<?php

namespace Fintech\Core\Seeders;

use Fintech\Core\Facades\Core;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach ($this->data() as $setting) {
            Core::setting()->create($setting);
        }
    }

    private function data()
    {
        return [
        ];
    }
}
