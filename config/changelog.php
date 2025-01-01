<?php

return [
    '1.0.1' => function (\Closure $next) {
        $this->call('db:seed', ['--class' => \Fintech\Transaction\Seeders\PolicySeeder::class]);
    }
];
