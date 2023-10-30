<?php

use Mithra62\EncryptionFieldtype\Services\Field;

const ENCRYPTION_FIELDTYPE_VERSION = '1.0.0';

return [
    'author'            => 'mithra62',
    'author_url'        => '',
    'name'              => 'Encryption FieldType',
    'description'       => 'Encrypts data for storage and decrypts for reads',
    'version'           => ENCRYPTION_FIELDTYPE_VERSION,
    'namespace'         => 'Mithra62\EncryptionFieldtype',
    'settings_exist'    => false,
    'fieldtypes'        => [
        'encryption_fieldtype' => [
            'name' => 'Encryption FieldType',
            'compatibility' => 'text',
        ],
    ],
    'services' => [
        'Field' => function ($addon) {
            return new Field();
        },
    ]
];
