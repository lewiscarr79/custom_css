<?php
class block_custom_css_edit_form extends block_edit_form {
    protected function specific_definition($mform) {
        $mform->addElement('header', 'configheader', get_string('blocksettings', 'block'));

        $mform->addElement('textarea', 'config_custom_css', get_string('customcss', 'block_custom_css'));
        $mform->addHelpButton('config_custom_css', 'customcss', 'block_custom_css');
        $mform->setType('config_custom_css', PARAM_RAW);

        $mform->addElement('text', 'config_custom_css_title', get_string('custom_css_title', 'block_custom_css'));
        $mform->setType('config_custom_css_title', PARAM_TEXT);
    }
}