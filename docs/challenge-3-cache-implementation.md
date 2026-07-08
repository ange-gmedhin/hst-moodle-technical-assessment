# Challenge 3 — Engineering Improvement

## Option B: Moodle Cache API Implementation

## 1. Problem Statement

The Training Statistics plugin requires calculating course statistics from Moodle database records. Executing these calculations repeatedly for every page request can create unnecessary database load, especially in environments with a large number of courses and users.

To improve performance and scalability, Moodle's Cache API was introduced to store generated statistics temporarily and reduce repeated database queries.

# 2. Solution Overview

A Moodle Application Cache was implemented using Moodle's Cache API.

The implementation introduces:

* A cache definition using `db/caches.php`
* A dedicated cache wrapper class
* Integration with the statistics service layer

The cache stores calculated course statistics using the course ID as the cache key.

The workflow is:

1. Check whether statistics already exist in cache.
2. If cached data exists, return it immediately.
3. If no cached data exists, generate statistics from the database.
4. Store the generated result in cache.
5. Return the statistics.

# 3. Implementation Architecture

```
User Request
      |
      v
statistics_manager
      |
      v
Check Cache
      |
      +----------------+
      |                |
      v                v
 Cache HIT        Cache MISS
      |                |
      |                v
      |          Database Query
      |                |
      |                v
      |          Store Result
      |
      v
Return Statistics
```

# 4. Files Added

| File                                        | Purpose                                          |
| ------------------------------------------- | ------------------------------------------------ |
| `db/caches.php`                             | Defines Moodle cache configuration               |
| `classes/cache/course_statistics_cache.php` | Provides a reusable wrapper for cache operations |
| `classes/statistics_manager.php`            | Handles statistics generation and cache usage    |

# 5. Cache Configuration

The cache was configured as an application-level cache.

Configuration details:

| Setting        | Value                       |
| -------------- | --------------------------- |
| Cache Type     | Application Cache           |
| Cache Name     | course_statistics           |
| Cache Key      | Course ID                   |
| Cache Data     | Generated course statistics |
| Cache Lifetime | 3600 seconds                |

The cache definition enables Moodle to manage storage and retrieval through its standard Cache API.

# 6. Performance Improvement

## Before Implementation

Every request required executing database queries to calculate course statistics.

This approach increases database workload because the same calculations may be performed repeatedly for identical requests.

## After Implementation

The first request generates the statistics and stores the result in cache.

Following requests retrieve the existing data from cache until the cache expires.

Benefits:

* Reduced repeated database queries
* Improved page response time
* Lower database resource consumption
* Better scalability for larger Moodle installations

# 7. Testing Approach

The implementation was tested using the following steps:

1. Install or upgrade the Moodle plugin.
2. Open the Training Statistics page.
3. Confirm that statistics are generated correctly.
4. Reload the page and verify that cached data is returned.
5. Clear Moodle caches and confirm that statistics are regenerated.

# 8. Engineering Considerations

The implementation follows Moodle development practices by:

* Using Moodle's built-in Cache API instead of custom caching solutions.
* Keeping cache logic separated from business logic.
* Providing a reusable cache wrapper class.
* Following Moodle naming conventions and coding standards.

# 9. Future Improvements

Possible future improvements include:

* Adding automatic cache invalidation when course data changes.
* Adding PHPUnit tests for cache behaviour.
* Supporting alternative cache stores such as Redis for high-scale deployments.
* Adding cache performance monitoring.

# Conclusion

The Moodle Cache API implementation improves the Training Statistics plugin by reducing unnecessary database operations while maintaining clean separation between data retrieval, business logic, and caching responsibilities.

This approach improves scalability and follows Moodle's recommended development architecture.