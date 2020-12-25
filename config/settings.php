<?php
return [
    'site_url' => [
        'key' => 'site_url',
        'value' => 'http://127.0.0.1:8000',
        'group' => 'general',
        'description' => 'The Site Url'
    ],
    'site_logo' => [
        'key' => 'site_url',
        'value' => 'http://127.0.0.1:8000/images/site_logo.png',
        'group' => 'general',
        'description' => 'The Site Url'
    ],
    'site_name' => [
        'key' => 'site_name',
        'value' => 'Ticket System',
        'group' => 'general',
        'description' => ''
    ],
    'logo' => [
        'key' => 'logo',
        'value' => 'https://via.placeholder.com/150',
        'group' => 'general',
        'description' => ''
    ],
    'ticket_reply_notification' => [
        'key' => 'ticket_reply_notification',
        'value' => '1',
        'group' => 'ticketing',
        'description' => ''
    ],
    /*
    |--------------------------------------------------------------------------
    | Mailer Configurations
    |--------------------------------------------------------------------------
    |
    |Mail configuration that will loaded dynamically
    |
    */
    'mail_from_address' => [
        'key' => 'mail_from_address',
        'value' => 'demo@example.com',
        'group' => 'mail',
        'description' => ''
    ],
    'mail_from_name' => [
        'key' => 'mail_from_name',
        'value' => 'Demo',
        'group' => 'mail',
        'description' => ''
    ],
    'mail_driver' => [
        'key' => 'mail_driver',
        'value' => 'smtp',
        'group' => 'mail',
        'description' => ''
    ],
    'smtp_username' => [
        'key' => 'smtp_username',
        'value' => '50a808558b004f',
        'group' => 'mail',
        'description' => ''
    ],
    'smtp_password' => ['key' => 'smtp_password',
        'value' => '25cb97e1e25134',
        'group' => 'mail',
        'description' => ''
    ],
    'smtp_server' => [
        'key' => 'smtp_server',
        'value' => 'smtp.mailtrap.io',
        'group' => 'mail',
        'description' => ''],
    'smtp_port' => ['key' => 'smtp_port',
        'value' => '2525',
        'group' => 'mail',
        'description' => ''
    ],
    'smtp_security' => [
        'key' => 'smtp_security',
        'value' => 'tls',
        'group' => 'mail',
        'description' => ''
    ],
];
