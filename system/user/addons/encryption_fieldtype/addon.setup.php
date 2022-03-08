<?php

return [
    'author'            => 'mithra62',
    'author_url'        => '',
    'name'              => 'Encryption FieldType',
    'description'       => 'Encrypts data for storage and decrypts for reads',
    'version'           => '1.0.0',
    'namespace'         => 'Mithra\EncryptionFieldtype',
    'settings_exist'    => true,
    'fieldtypes'        => [
        'encryption_fieldtype' => [
            'name' => 'Encryption FieldType',
            'compatibility' => 'everything',
        ],
    ],
    // Advanced settings
];
