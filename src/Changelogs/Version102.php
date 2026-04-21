<?php

namespace Fintech\Core\Changelogs;

use Fintech\Core\Commands\AppUpdateCommand;
use Fintech\Core\Contracts\Changelog;
use Fintech\Core\Exceptions\PackageNotInstalledException;

class Version102 implements Changelog
{
    /**
     * This command will run and apply the changes when the app update command is executed.
     * You can use this to run any database migrations, seeders, or any other changes
     * that need to be applied when the app is updated.
     *
     * @param AppUpdateCommand $command
     * @return void
     * @throws PackageNotInstalledException
     */
    public function handle(AppUpdateCommand $command): void
    {
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
    }
}
