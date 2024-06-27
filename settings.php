<?php
require_once(__DIR__ . '/../../config.php');
require_login();

if (confirm_sesskey() && has_capability('block/custom_css:addinstance', context_system::instance())) {
    $instanceid = required_param('instanceid', PARAM_INT);
    $custom_css = s(optional_param('custom_css', '', PARAM_RAW));
    set_config('custom_css_' . $instanceid, $custom_css, 'block_custom_css');

    redirect(new moodle_url('/my/'));
}