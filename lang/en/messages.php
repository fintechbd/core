<?php

/*
|--------------------------------------------------------------------------
| Core Language Lines
|--------------------------------------------------------------------------
|
| The following language lines are used during authentication for various
| messages that we need to display to the user. You are free to modify
| these language lines according to your application's requirements.
|
*/
return [
    'resource' => [
        'created' => ':model created successfully.',
        'notfound' => 'No :model found with ID :id.',
        'updated' => ':model updated successfully.',
        'deleted' => ':model deleted successfully.',
        'restored' => ':model restored successfully.',
        'exported' => ':model exported successfully.',
    ],
    'exception' => [
        'store' => 'There\'s been an error. :model might not have been saved.',
        'update' => 'There\'s been an error. :model with ID::id might not have been updated.',
        'delete' => 'There\'s been an error. :model with ID::id might not have been deleted.',
        'restore' => 'There\'s been an error. :model with ID::id might not have been restored.',
        'default' => 'There\'s been an error. Please try again later.',
        'relation_missing' => ':model:::method() missing relational return type hinting.',
    ],
    'action' => [
        'show' => 'Preview',
        'update' => 'Edit',
        'destroy' => 'Delete',
        'restore' => 'Restore',
    ],
    'setting' => [
        'saved' => ':package configurations saved successfully.',
        'deleted' => ':package configurations restored to defaults.',
        'failed' => ':package configurations failed to update.'
    ],
    'transaction' => [
        'insufficient_balance' => 'User :currency account does not have a sufficient balance available.',
        'currency_unavailable' => 'This user don\'t have :slug currency account! Please enable, try again later.',
        'master_currency_unavailable' => 'This system user don\'t have :slug currency account! Please contact administrator.',
        'request_amount_already_exists' => 'The requested amount is already submitted and processing! Please wait for update.',
        'request_order_already_exists' => 'Consecutive transaction in the same account requires :delay minutes interval. So please try after :next_available.',
        'request_failed' => 'Your transaction for :service request has failed! Please try again later.',
        'request_created' => 'Your transaction for :service request has been submitted. Please wait for update.',
    ],
    'assign_vendor' => [
        'not_found' => ':slug vendor is not available on the configurations.',
        'not_assigned' => 'This order have not been assigned to any vendor.',
        'already_assigned' => 'This order has already assigned by another user.',
        'assigned_user_failed' => 'Unable to assign this order to requested user.',
        'failed' => 'Unable to assign order to requested vendor [:slug].',
        'release_failed' => 'There\'s been an error. while :model with ID::id failed to release.',
        'success' => 'Successfully assigned order to requested vendor [:slug].',
        'quote_failed' => 'Something went wrong. Please try again later.',
    ],
];
