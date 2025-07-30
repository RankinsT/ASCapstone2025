<?php

$ini = parse_ini_file(__DIR__. '/dbconfig.ini'); // Load database configuration from ini file

$db = new PDO("mysql:host=" . $ini['servername'] . 
                    ";port=" . $ini['port'] . ";dbname=" . $ini['dbname'],
                    $ini['username'],
                    $ini['password']); // Create a new PDO instance

$db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false); // Set attribute to emulate prepared statements