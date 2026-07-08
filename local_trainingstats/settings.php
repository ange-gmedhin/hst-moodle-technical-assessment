<?php

defined('MOODLE_INTERNAL') || die();

if ($hassiteconfig) {

    // Create settings page.
    $settings = new admin_settingpage(
        'local_trainingstats',
        get_string('pluginname', 'local_trainingstats')
    );

    // Enable/disable plugin setting.
    $settings->add(
        new admin_setting_configcheckbox(
            'local_trainingstats/enabled',
            get_string('enableplugin', 'local_trainingstats'),
            get_string('enabledescription', 'local_trainingstats'),
            1
        )
    );

    // Add settings page under Local plugins.
    $ADMIN->add(
        'localplugins',
        $settings
    );