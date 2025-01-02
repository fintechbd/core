<?php

use Fintech\Core\Commands\AppUpdateCommand;

return [
//    '1.0.5' => function (AppUpdateCommand $command) {
//
//    },
//    '1.0.4' => function (AppUpdateCommand $command) {
//        dump(get_class($command));
//        //        $this->call('db:seed', ['--class' => \Fintech\Transaction\Seeders\PolicySeeder::class]);
//    },
//    '1.0.3' => function (AppUpdateCommand $command) {
//        dump(get_class($command));
//        //        $this->call('db:seed', ['--class' => \Fintech\Transaction\Seeders\PolicySeeder::class]);
//    },
//    '1.0.2' => function (AppUpdateCommand $command) {
//        dump(get_class($command));
//        //        $this->call('db:seed', ['--class' => \Fintech\Transaction\Seeders\PolicySeeder::class]);
//    },
    '1.0.1' => function (AppUpdateCommand $command) {
        \Illuminate\Support\Facades\Artisan::call('db:seed --quiet --class=' . addslashes(\Fintech\Transaction\Seeders\PolicySeeder::class));
    }
];
