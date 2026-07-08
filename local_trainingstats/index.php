<?php

require_once('../../config.php');

defined('MOODLE_INTERNAL') || die();

require_login();

$context = context_system::instance();

/**
 * Require permission to view statistics.
 */
require_capability(
    'local/trainingstats:view',
    $context
);


/**
 * Set page information.
 */
$PAGE->set_context($context);

$PAGE->set_url(
    new moodle_url('/local/trainingstats/index.php')
);

$PAGE->set_title(
    get_string(
        'trainingstats',
        'local_trainingstats'
    )
);

$PAGE->set_heading(
    get_string(
        'trainingstats',
        'local_trainingstats'
    )
);


/**
 * Get course statistics.
 */
$statistics = new \local_trainingstats\course_statistics();

$courses = $statistics->get_course_statistics();


/**
 * Render dashboard.
 */
echo $OUTPUT->header();

$renderer = $PAGE->get_renderer(
    'local_trainingstats'
);

echo $renderer->render_dashboard(
    $courses
);

echo $OUTPUT->footer();