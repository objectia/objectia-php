<?php
/**
 * Objectia Client Library for PHP
 */
// Setup autoloading
$loader = require __DIR__ . '/../vendor/autoload.php';
// Add Autoloading of test classes
$loader->addPsr4('ObjectiaTest\\', __DIR__);
