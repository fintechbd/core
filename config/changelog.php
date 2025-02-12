<?php

use Fintech\Core\Commands\AppUpdateCommand;
use Illuminate\Support\Facades\Artisan;

return [
    '1.0.5' => function (AppUpdateCommand $command) {
     $this->task('Register schedule tasks', function (){

         $task = [
             'name' => 'Fire Scheduled Notification Event',
             'description' => 'This schedule program fire any scheduled notification event.',
             'command' => 'core:scheduled-notification',
             'enabled' => true,
             'timezone' => 'UTC',
             'interval' => '*/5 * * * *',
             'priority' => 5,
         ];

         $taskModel = \Fintech\Core\Facades\Core::schedule()->findWhere(['command' => $task['command']]);

            if ($taskModel) {
                return;
            }

            \Fintech\Core\Facades\Core::schedule()->create($task);
        });
    },
    '1.0.4' => function (AppUpdateCommand $command) {
        Artisan::call('migrate');
    },
    '1.0.3' => function (AppUpdateCommand $command) {
        if (\Fintech\Core\Facades\Core::packageExists('Business')) {
            \Fintech\Business\Facades\Business::serviceType()->list()->each(function ($service) use ($command) {
                $service->enabled = true;
                if ($service->save()) {
                    $command->successMessage("[<fg=bright-yellow;options=bold>{$service->service_type_name}</>] service type has been updated", 'DONE', false);
                }
            });

            \Fintech\Business\Facades\Business::serviceStat()->list()->each(function ($serviceStat) use ($command) {
                $serviceStat->enabled = true;
                if ($serviceStat->save()) {
                    $command->successMessage("[<fg=bright-yellow;options=bold>{$serviceStat->id}</>] service stat has been updated", 'DONE', false);
                }
            });
        }
    },
    '1.0.2' => function (AppUpdateCommand $command) {
        if (\Fintech\Core\Facades\Core::packageExists('Business')) {

            if ($serviceSetting = \Fintech\Business\Facades\Business::serviceSetting()->create([
                'service_setting_type' => 'service',
                'service_setting_name' => 'Visible Website Kommerce',
                'service_setting_field_name' => 'visible_website_kommerce',
                'service_setting_type_field' => 'select',
                'service_setting_feature' => 'Display this service in Kommerce asia',
                'service_setting_rule' => 'nullable|string|in:yes,no',
                'service_setting_value' => 'yes',
                'enabled' => true
            ])) {

                $command->successMessage("Visible Website Kommerce Service Setting created successfully.", false);

                \Fintech\Business\Facades\Business::service()->list()->each(function ($service) use ($command) {
                    $serviceData = $service->service_data ?? [];
                    $serviceData['visible_website_kommerce'] = 'yes';
                    $service->service_data = $serviceData;
                    $service->enabled = true;

                    if ($service->save()) {
                        $command->successMessage("[<fg=bright-yellow;options=bold>{$service->service_name}</>] service has been updated", 'DONE', false);
                    }
                });
            }
        }
    },
    '1.0.1' => function (AppUpdateCommand $command) {
        if (\Fintech\Core\Facades\Core::packageExists('Transaction')) {
            \Illuminate\Support\Facades\Artisan::call('db:seed --quiet --class=' . addslashes(\Fintech\Transaction\Seeders\PolicySeeder::class));
        }
    }
];
