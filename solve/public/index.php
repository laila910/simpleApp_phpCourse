<?php

declare(strict_types = 1);

$root = dirname(__DIR__) . DIRECTORY_SEPARATOR;

define('APP_PATH', $root . 'app' . DIRECTORY_SEPARATOR);
define('FILES_PATH', $root . 'transaction_files' . DIRECTORY_SEPARATOR);
define('VIEWS_PATH', $root . 'views' . DIRECTORY_SEPARATOR);

/* YOUR CODE (Instructions in README.md) */

require APP_PATH . "app.php";
require APP_PATH .'helpers.php';
$files= getTransactionFiles(FILES_PATH);
$transactions =[];
foreach($files as $file){
$transactions = array_merge($transactions,getTransactions($file));
}
// print_r($files); // Array ( [0] => sample_1.csv )
//  var_dump($files);//array(1) { [0]=> string(82) "C:\xampp\htdocs\simpleApp\simpleApp_phpCourse\solve\transaction_files\sample_1.csv" }
// print_r($transactions);
$totals=calculateTotals($transactions);
require VIEWS_PATH . 'transactions.php'; 