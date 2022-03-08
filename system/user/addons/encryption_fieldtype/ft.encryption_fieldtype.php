<?php

if (! defined('BASEPATH')) {
    exit('No direct script access allowed');
}

use ExpressionEngine\Library\CP\EntryManager\ColumnInterface;

class Encryption_fieldtype_ft extends EE_Fieldtype implements ColumnInterface
{
    /**
     * @var string[]
     */
    public $info = array(
        'name'      => 'Encryption FieldType',
        'version'   => '1.0.0',
    );

    /**
     * The available "types" of fields the FT will make available
     * @var array
     */
    protected $field_types = array(
        'password' => 'Password',
        'input' => 'Input',
        'textarea' => 'Textarea'
    );

    public function __construct()
    {
        ee()->lang->loadfile('encryption_fieldtype');
        parent::__construct();
    }

    /**
     * @return string[]
     */
    public function install()
    {
        return array(
            'decrypt_access' 		=> '',
            'field_max_length' 		=> '128',
            'display_field_type' 	=> 'password',
            'hidden_text'			=> '******'
        );
    }

    /**
     * @return string
     */
    public function display_global_settings()
    {
        $val = array_merge($this->settings, $_POST);

        $form = '';

        return $form;
    }

    /**
     * @return array|mixed
     */
    public function save_global_settings(): array
    {
        return array_merge($this->settings, $_POST);
    }

    public function display_settings($data)
    {
        $selected = !empty($data['display_field_type']) ?? $data['display_field_type'];
        $field_max_length = !empty($data['field_max_length']) ? $data['field_max_length'] : 128 ;
        $hidden_text = !empty($data['hidden_text']) ? $data['hidden_text'] : '******';
        $settings = [
            [
                'title' => 'display_type',
                'fields' => [
                    'display_field_type' => [
                        'name' => 'display_field_type',
                        'type' => 'select',
                        'choices' => $this->field_types,
                        'value' => $selected
                    ],
                ],
            ],
            [
                'title' => 'field_max_length',
                'fields' => [
                    'field_max_length' => [
                        'name' => 'field_max_length',
                        'type' => 'text',
                        'value' => $field_max_length,
                    ],
                ],
            ],
            [
                'title' => 'decrypt_access',
                'fields' => [
                    'decrypt_access' => [
                        'name' => 'decrypt_access',
                        'type' => 'checkbox',
                        'choices' => []
                    ],
                ],
            ],
            [
                'title' => 'hidden_text',
                'fields' => [
                    'hidden_text' => [
                        'name' => 'hidden_text',
                        'type' => 'text',
                        'value' => $hidden_text
                    ],
                ],
            ]
        ];

        return ['field_options_encryption' => [
            'label' => 'field_options',
            'group' => 'encryption_ft',
            'settings' => $settings
        ]
        ];
    }

    public function save_settings($data)
    {
        return [];
    }

    public function display_field($data)
    {
        return form_input(array(
            'name'  => $this->field_name,
            'id'    => $this->field_id,
            'value' => $data
        ));
    }

    public function replace_tag($data, $params = array(), $tagdata = false)
    {
        return 'Magic!';
    }
}
