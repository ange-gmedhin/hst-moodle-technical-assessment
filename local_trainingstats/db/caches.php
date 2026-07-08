<?php
defined('MOODLE_INTERNAL') || die();

$definitions = [
    'course_statistics' => [
        'mode' => cache_store::MODE_APPLICATION,
        'simplekeys' => true,
        'simpledata' => true,
        'staticacceleration' => true,
        'ttl' => 3600,
    ],
];