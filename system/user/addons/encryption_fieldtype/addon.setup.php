<?php

use Mithra62\EncryptionFieldtype\Services\Field;

const ENCRYPTION_FIELDTYPE_VERSION = '1.1.1';

return [
    'author'            => 'mithra62',
    'author_url'        => 'https://mithra62.com/',
    'name'              => 'Encryption FieldType',
    'description'       => 'Encrypts data for storage and decrypts for reads',
    'version'           => ENCRYPTION_FIELDTYPE_VERSION,
    'namespace'         => 'Mithra62\EncryptionFieldtype',
    'settings_exist'    => false,
    'fieldtypes'        => [
        'encryption_fieldtype' => [
            'name' => 'Encryption',
            'compatibility' => 'text',
        ],
    ],
    'services' => [
        'Field' => function ($addon) {
            return new Field();
        },
    ]
];
