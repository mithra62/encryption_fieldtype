<?php

if (defined('PATH_THIRD')) {
    require_once PATH_THIRD . 'encryption_fieldtype/vendor/autoload.php';
}

use Mithra62\EncryptionFieldtype\Services\Field;

return [
    'author'            => 'mithra62',
    'author_url'        => '',
    'name'              => 'Encryption FieldType',
    'description'       => 'Encrypts data for storage and decrypts for reads',
    'version'           => '1.0.0',
    'namespace'         => 'Mithra62\EncryptionFieldtype',
    'settings_exist'    => false,
    'fieldtypes'        => [
        'encryption_fieldtype' => [
            'name' => 'Encryption FieldType',
            'compatibility' => 'everything',
        ],
    ],
    'services' => [
        'Field' => function ($addon) {
            return new Field();
        },
    ]
    // Advanced settings
];
