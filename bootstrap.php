<?php
/**
 * Customer Invitation
 *
 * @package        App
 * @author         Madhur Tandon
 */

define('DIR_PREFIX', dirname(__FILE__));

// Autoload the Libraries that are used or supported by App
require_once(DIR_PREFIX . '/vendor/autoload.php');

require_once DIR_PREFIX . DIRECTORY_SEPARATOR . 'Application.php';

(new \App\Application())->Initialize();