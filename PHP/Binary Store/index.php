<?php
session_start();// for all the pages to use session variables
require 'Database.php';
$config = require('config.php');
$db = new Database($config['database']);

define('ROOT_PATH', dirname(__FILE__) . '/'); // Define the base URL for the application

require 'models/signin.model.php';
require 'models/signup.model.php';
require 'functions.php';
require 'router.php';



