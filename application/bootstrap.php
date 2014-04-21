<?php

require_once('core/ClassLoader.php');

$loader = new ClassLoader();

$loader->regsiterDir(dirname(__FILE__).'/core');
$loader->regsiterDir(dirname(__FILE__).'/models');
$loader->register();