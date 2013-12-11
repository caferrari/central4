<?php

require_once(__DIR__ . '/../vendor/autoload.php');

use CafTest\AbstractBootstrap;

mb_internal_encoding('UTF-8');
mb_http_output('UTF-8');
mb_http_input('UTF-8');
mb_language('uni');
mb_regex_encoding('UTF-8');
ob_start('mb_output_handler');

error_reporting(-1);
ini_set('diaplay_errors', 1);

class Bootstrap extends AbstractBootstrap
{

}

Bootstrap::init();
