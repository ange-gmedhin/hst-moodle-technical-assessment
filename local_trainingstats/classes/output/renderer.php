<?php

defined('MOODLE_INTERNAL') || die();

namespace local_trainingstats\output;

class renderer extends \plugin_renderer_base {

    /**
     * Render training statistics dashboard.
     *
     * @param array $courses
     * @return string
     */
    public function render_dashboard(array $courses): string {

        $data = [
            'courses' => $courses,

            'coursename' => get_string(
                'coursename',
                'local_trainingstats'
            ),

            'enrolledusers' => get_string(
                'enrolledusers',
                'local_trainingstats'
            ),

            'completionpercentage' => get_string(
                'completionpercentage',
                'local_trainingstats'
            ),
        ];


        if (empty($courses)) {
            $data['empty'] = get_string(
                'nostatistics',
                'local_trainingstats'
            );
        }


        return $this->render_from_template(
            'local_trainingstats/dashboard',
            $data
        );
    }
}