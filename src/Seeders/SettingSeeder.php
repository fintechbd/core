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
            [
                'package' => 'auth',
                'label' => 'User Authentication Field',
                'description' => 'Unique field that can be used to authenticated a end user to system',
                'key' => 'auth_field',
                'type' => 'string',
                'value' => 'login_id'
            ],
            [
                'package' => 'auth',
                'label' => 'OTP Key Length',
                'description' => 'Number of digits that otp key will have',
                'key' => 'otp_length',
                'type' => 'integer',
                'value' => '6'
            ],
            [
                'package' => 'auth',
                'label' => 'Password',
                'description' => 'Which field in user table will maintain the password field value',
                'key' => 'password_field',
                'type' => 'string',
                'value' => 'password'
            ],
            [
                'package' => 'auth',
                'label' => 'Wrong Password Warning Limit',
                'description' => 'Number to times a user can attempt with wrong password before account become in active',
                'key' => 'password_threshold',
                'type' => 'integer',
                'value' => '10'
            ],
            [
                'package' => 'auth',
                'label' => 'Wrong Pin Warning Limit',
                'description' => 'Number to times a user can attempt with wrong pin on transaction before account become in active',
                'key' => 'pin_threshold',
                'type' => 'integer',
                'value' => '3'
            ],
            [
                'package' => 'auth',
                'label' => 'Send Account De-activated Notification',
                'description' => 'When account is freeze for suspicious activity send notification to email or mobile',
                'key' => 'threshold_notification',
                'type' => 'boolean',
                'value' => 'false'
            ],
            [
                'package' => 'auth',
                'label' => 'Frontend Register Default Role',
                'description' => 'Set the Default Role(s) for the Registration Customer',
                'key' => 'customer_roles',
                'type' => 'array',
                'value' => '[7]'
            ],
            [
                'package' => 'core',
                'label' => 'Pagination Style',
                'description' => 'What typo of pagination will display in list view',
                'key' => 'pagination_type',
                'type' => 'string',
                'value' => 'paginate'
            ],
            [
                'package' => 'auth',
                'label' => 'How User will reset their password',
                'description' => 'When a user forgot password. he have follow this configured option to reset password.',
                'key' => 'password_reset_method',
                'type' => 'string',
                'value' => 'temporary_password'
            ],
            [
                'package' => 'auth',
                'label' => 'Length of Temporary Password',
                'description' => 'Number of Alpha-numeric characters in Temporary Password when generated',
                'key' => 'temporary_password_length',
                'type' => 'integer',
                'value' => '8'
            ],
        ];
    }
}
