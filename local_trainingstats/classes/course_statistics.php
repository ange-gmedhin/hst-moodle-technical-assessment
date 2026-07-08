<?php

defined('MOODLE_INTERNAL') || die();

namespace local_trainingstats;

class course_statistics {

    /**
     * Return statistics for available courses.
     *
     * @return array
     */
    public function get_course_statistics(): array {

        global $DB;

        $courses = $DB->get_records(
            'course',
            null,
            'fullname ASC'
        );

        $statistics = [];

        foreach ($courses as $course) {

            // Skip Moodle site course.
            if ($course->id == SITEID) {
                continue;
            }

            $statistics[] = [
                'name' => format_string($course->fullname),
                'users' => $this->get_enrolled_users($course->id),
                'completion' => $this->get_completion_percentage($course->id),
            ];
        }

        return $statistics;
    }


    /**
     * Count enrolled users in a course.
     *
     * Uses Moodle enrolment API instead of direct SQL.
     *
     * @param int $courseid
     * @return int
     */
    private function get_enrolled_users(int $courseid): int {

        $context = \context_course::instance($courseid);

        return count(
            get_enrolled_users($context)
        );
    }


    /**
     * Calculate course completion percentage.
     *
     * Formula:
     *
     * Completed users / Enrolled users * 100
     *
     * @param int $courseid
     * @return float
     */
    private function get_completion_percentage(int $courseid): float {

        global $DB;

        $totalusers = $this->get_enrolled_users($courseid);

        if ($totalusers === 0) {
            return 0;
        }


        $completedusers = $DB->count_records(
            'course_completions',
            [
                'course' => $courseid,
                'timecompleted' => 1
            ]
        );


        return round(
            ($completedusers / $totalusers) * 100,
            2
        );
    }
}