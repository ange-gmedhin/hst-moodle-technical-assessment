<?php

defined('MOODLE_INTERNAL') || die();

namespace local_trainingstats;

use advanced_testcase;

class course_statistics_test extends advanced_testcase {

    /**
     * Test that course statistics returns course information.
     */
    public function test_get_course_statistics_returns_courses(): void {

        $this->resetAfterTest();

        // Create a test course.
        $course = $this->getDataGenerator()->create_course([
            'fullname' => 'Test Training Course',
        ]);

        // Create statistics service.
        $statistics = new course_statistics();

        // Get statistics.
        $result = $statistics->get_course_statistics();

        // Verify course exists in result.
        $this->assertCount(1, $result);

        $this->assertEquals(
            'Test Training Course',
            $result[0]['name']
        );
    }

    /**
     * Test enrolled user calculation.
     */
    public function test_enrolled_users_count(): void {

        $this->resetAfterTest();

        $course = $this->getDataGenerator()->create_course();

        // Create users.
        $user1 = $this->getDataGenerator()->create_user();
        $user2 = $this->getDataGenerator()->create_user();

        // Enrol users.
        $this->getDataGenerator()
            ->enrol_user($user1->id, $course->id);

        $this->getDataGenerator()
            ->enrol_user($user2->id, $course->id);

        $statistics = new course_statistics();

        $result = $statistics->get_course_statistics();

        $this->assertEquals(
            2,
            $result[0]['users']
        );
    }

    /**
     * Test completion percentage calculation.
     */
    public function test_completion_percentage_calculation(): void {

        $this->resetAfterTest();

        $course = $this->getDataGenerator()->create_course();

        $user1 = $this->getDataGenerator()->create_user();
        $user2 = $this->getDataGenerator()->create_user();

        $this->getDataGenerator()
            ->enrol_user($user1->id, $course->id);

        $this->getDataGenerator()
            ->enrol_user($user2->id, $course->id);

        // Add one completed user.
        global $DB;

        $DB->insert_record(
            'course_completions',
            [
                'userid' => $user1->id,
                'course' => $course->id,
                'timecompleted' => time(),
            ]
        );

        $statistics = new course_statistics();

        $result = $statistics->get_course_statistics();

        $this->assertEquals(
            50,
            $result[0]['completion']
        );
    }
}