<?php
namespace Mithra62\EncryptionFieldtype\Services;

class Field
{
    public function display($data, $settings, $ft_name)
    {
        $field = '';
        $field_settings = $settings;
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

            $options['value'] = ee('Encrypt')->decrypt(htmlspecialchars_decode($data));

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
}