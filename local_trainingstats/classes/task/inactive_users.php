<?php

defined('MOODLE_INTERNAL') || die();

namespace local_trainingstats\task;

use local_trainingstats\report\inactive_users_report;

class inactive_users extends \core\task\scheduled_task {

    /**
     * Return task name.
     *
     * @return string
     */
    public function get_name(): string {

        return get_string(
            'inactivereporttask',
            'local_trainingstats'
        );
    }

    /**
     * Execute scheduled task.
     *
     * @return void
     */
    public function execute(): void {

        global $DB;

        mtrace('Starting inactive users report generation...');

        try {

            $cutoffdate = time() - (30 * DAYSECS);
            $users = $DB->get_records_select(
                'user',
                'lastaccess < :cutoff
                 AND deleted = 0
                 AND suspended = 0',
                [
                    'cutoff' => $cutoffdate
                ],
                'lastaccess ASC'
            );

            if (empty($users)) {

                mtrace(
                    'No inactive users found.'
                );

                return;
            }

            $report = new inactive_users_report();

            $file = $report->generate(
                $users
            );

            mtrace(
                'Inactive users report generated: ' . $file
            );

        } catch (\Throwable $exception) {

            mtrace(
                'Inactive users report failed: '
                . $exception->getMessage()
            );

            throw $exception;
        }
    }
}