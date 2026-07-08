<?php

defined('MOODLE_INTERNAL') || die();

$tasks = [
    [
        'classname' => '\local_trainingstats\task\inactive_users',
        'blocking' => 0,
        'minute' => '0',
        'hour' => '2',
        'day' => '*',
        'dayofweek' => '*',
        'month' => '*',
    ],
];