# hst-moodle-technical-assessment
# Moodle Training Statistics Plugin  A production-style Moodle 4.5 local plugin developed for the HST Moodle Developer Technical Assessment. It demonstrates clean architecture, Moodle API integration, scheduled tasks, capability management, renderer and Mustache-based UI, and maintainable, production-oriented software engineering practices.

# Moodle Training Statistics Plugin

## Overview

This repository contains a production-style Moodle local plugin (`local_trainingstats`) developed for the HST Moodle Developer Technical Assessment.

The implementation follows Moodle 4.5 development standards and demonstrates clean architecture, separation of concerns, maintainability, and proper use of Moodle core APIs.

## Features

* Administrator dashboard for course statistics
* Displays:

  * Course Name
  * Number of Enrolled Users
  * Course Completion Percentage
* Daily scheduled task
* Identifies users inactive for more than 30 days
* Generates CSV reports
* Stores reports using Moodle File API
* Uses Moodle capabilities for access control
* Renderer and Mustache-based presentation layer
* Structured business logic separated from presentation

## Project Structure

```text
local_trainingstats/
├── classes/
├── db/
├── lang/
├── templates/
├── pix/
├── amd/
├── tests/
├── index.php
├── lib.php
├── settings.php
└── version.php
```

## Architecture

The plugin follows a layered architecture:

* Presentation Layer (Renderer + Mustache Templates)
* Business Logic Layer (Service Classes)
* Moodle Core APIs
* Scheduled Task Layer
* Configuration and Capability Management

This separation improves readability, maintainability, and future extensibility.

## Moodle APIs Used

* Database API
* Enrolment API
* Completion API
* Capability API
* File API
* Scheduled Task API
* Renderer API
* Mustache Template System
* Language String API
* Events and Logging API

## Engineering Decisions

The implementation prioritizes:

* Clean separation of concerns
* Reusable business logic
* Secure access control
* Scalable architecture
* Moodle coding standards
* Production-ready folder organization

For the engineering improvement challenge, the plugin uses Renderers and Mustache Templates to separate presentation from business logic, improving maintainability, testability, and consistency with Moodle best practices.

## Assumptions

* Moodle 4.5 environment already exists.
* Core Moodle services are available.
* User authentication is handled by Moodle.
* Course completion tracking is enabled.

## Future Improvements

* PHPUnit and Behat test coverage
* Cache API integration
* Pagination for large datasets
* Advanced filtering and searching
* Export to additional formats
* Performance optimizations for very large Moodle installations

## Author

Prepared by **Angosom Gebremedhin Berhe**

Submitted for the **HST Moodle Developer Technical Assessment**.
