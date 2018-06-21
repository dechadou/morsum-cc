<?php
/**
 * Created by PhpStorm.
 * User: dechadou-pc
 * Date: 20/6/2018
 * Time: 1:16 PM
 */
require __DIR__ . '/../vendor/autoload.php';

use Dotenv\Dotenv;

if (!isset($_SESSION)) {
    session_start();
}
error_reporting(E_ALL);
ini_set('display_errors', 1);

define("BASEPATH", dirname(__DIR__));
define("ROOT", 'http://localhost/morsum-cc/');
define("ASSETS", ROOT . 'public/assets/');
define("APP", BASEPATH . '/App');


$app = new \Src\App;

// load config
try {
    $dotenv = new Dotenv(__DIR__ . '/..');
    $dotenv->load();
} catch (\Exception $e) {
    print_r('Seems there is a problem with your .env file: '.$e->getMessage());
    die();
}

// init app
$app->render();