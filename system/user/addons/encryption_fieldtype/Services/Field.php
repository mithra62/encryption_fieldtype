<?php
namespace Mithra62\EncryptionFieldtype\Services;

class Field
{
    /**
     * @param string $data
     * @param array $settings
     * @param string $ft_name
     * @return string
     */
    public function gridDisplay(?string $data, array $settings, string $ft_name): string
    {
        $field = '';
        $field_settings = [
            'decrypt_access' => $settings['decrypt_access'],
            'hidden_text' => $settings['hidden_text'],
            'display_field_type' => $settings['display_field_type'],
        ];

        $settings['field_settings'] = $field_settings;
        return $this->display($data, $settings, $ft_name);
    }

    /**
     * @param string|null $data
     * @param array $settings
     * @param string $ft_name
     * @return string
     */
    public function display(?string $data, array $settings, string $ft_name): string
    {
        $field = '';
        $field_settings = $settings['field_settings'];
        if($data != '')
        {
            if(ee()->session->userdata('role_id') != '1' &&
                (isset($field_settings['decrypt_access']) ||
                    is_array($field_settings['decrypt_access']) ||
                    in_array(ee()->session->userdata('role_id'), $field_settings['decrypt_access']))) {
                $field .= form_hidden('_encrypt_orig_'.$ft_name, $data);
            }
        }

        $options = array('name'	=> $ft_name,'id' => $ft_name);
        if(ee()->session->userdata('role_id') == '1' ||
            (isset($field_settings['decrypt_access']) &&
                is_array($field_settings['decrypt_access']) &&
                in_array(ee()->session->userdata('role_id'), $field_settings['decrypt_access']))) {

            $options['value'] = '';
            if($data) {
                $options['value'] = ee('Encrypt')->decode(($data));
            }

        } else {

            if($data != '') {
                $options['value'] = $field_settings['hidden_text'];
            }
        }

        switch($field_settings['display_field_type']) {
            case 'password':
                $field .= form_password($options);
                break;

            case 'textarea':
                $field .= form_textarea($options);
                break;

            case 'input':
                $field .= form_input($options);
                break;
        }

        return $field;
    }

    /**
     * @param $data
     * @param $settings
     * @param $field_name
     * @return mixed
     */
    public function save($data, $settings, $field_name)
    {
        if($settings['hidden_text'] != $data) {
            return ee('Encrypt')->encode($data);
        }

        $default = ee()->input->post('_encrypt_orig_'.$field_name);
        if(($settings['hidden_text'] == $data) && $default) {
            return $default;
        }

        return ee('Encrypt')->encode($data);
    }

    /**
     * @return array
     */
    public function roleOptions(): array
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
}