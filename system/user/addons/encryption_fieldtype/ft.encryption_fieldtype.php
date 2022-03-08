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

    public function save($data)
    {
        echo $data;
        exit;
    }

    /**
     * @param $data
     * @return array[]
     */
    public function display_settings($data): array
    {
        $selected = element('display_field_type', $data);
        $field_max_length = !empty($data['field_max_length']) ? $data['field_max_length'] : 128 ;
        $hidden_text = !empty($data['hidden_text']) ? $data['hidden_text'] : '******';
        $selected_group = (isset($data['decrypt_access']) && $data['decrypt_access'] != '') ? $data['decrypt_access'] : [];
        $settings = [
            [
                'title' => 'display_type',
                'desc' => 'display_type_instructions',
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
                'desc' => 'decrypt_access_instructions',
                'fields' => [
                    'decrypt_access' => [
                        'name' => 'decrypt_access',
                        'type' => 'checkbox',
                        'value' => $selected_group,
                        'choices' => $this->roleOptions()
                    ],
                ],
            ],
            [
                'title' => 'hidden_text',
                'desc' => 'hidden_text_instructions',
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

    /**
     * @return array
     */
    protected function roleOptions(): array
    {
        $groups = [];
        $query = ee('Model')
            ->get('Role')
            ->filter('role_id', '>=', '5')
            ->order('name', 'asc')
            ->all();

        foreach ($query as $row) {
            $groups[$row->role_id] = $row->name;
        }

        return $groups;
    }

    /**
     * @param $data
     * @return array
     */
    public function save_settings($data)
    {
        return array(
            'decrypt_access'		=> element('decrypt_access', $data),
            'field_max_length'		=> element('field_max_length', $data),
            'display_field_type'	=> element('display_field_type', $data),
            'hidden_text'			=> element('hidden_text', $data)
        );
    }

    /**
     * @param $data
     * @return string
     */
    public function display_field($data)
    {
        return form_input(array(
            'name'  => $this->field_name,
            'id'    => $this->field_id,
            'value' => $data
        ));
    }

    /**
     * @param $data
     * @param array $params
     * @param false $tagdata
     * @return string
     */
    public function replace_tag($data, $params = array(), $tagdata = false)
    {
        return 'Magic!';
    }

    /**
     * Accept all content types.
     *
     * @param string  The name of the content type
     * @return bool   Accepts all content types
     */
    public function accepts_content_type($name)
    {
        return true;
    }

    /**
     * Update the fieldtype
     *
     * @param string $version The version being updated to
     * @return boolean TRUE if successful, FALSE otherwise
     */
    public function update($version)
    {
        return true;
    }
}
