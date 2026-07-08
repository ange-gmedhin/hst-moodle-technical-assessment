<?php

defined('MOODLE_INTERNAL') || die();

$capabilities = [
    'local/trainingstats:view' => [
        'riskbitmask' => RISK_PERSONAL,
        'captype' => 'read',
        'contextlevel' => CONTEXT_SYSTEM,

        'archetypes' => [
            'manager' => CAP_ALLOW,
        ],
    ],
];