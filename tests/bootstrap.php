<?php
use Trendwerk\AcfForms\AcfForms;

$testsDir = getenv('WP_TESTS_DIR');

if (! $testsDir) {
    $testsDir = '/tmp/wordpress-tests-lib';
}

// Give access to tests_add_filter() function.
require_once $testsDir . '/includes/functions.php';

/**
 * Manually load the plugin being tested.
 */
tests_add_filter('muplugins_loaded', function () {
    require_once __DIR__ . '/../vendor/autoload.php';
    require_once __DIR__ . '/../wp-content/plugins/advanced-custom-fields-pro/acf.php';

    $acfForms = new AcfForms();
    $acfForms->init();
});

// Start up the WP testing environment.
require $testsDir . '/includes/bootstrap.php';
