<?php
require_once __DIR__ . '/vendor/autoload.php';

$dotenv = new Dotenv\Dotenv(__DIR__);
$dotenv->load();
$dotenv->required(['DB_DSN', 'DB_USER', 'DB_PASSWORD', 'OAUTH_CLIENT_ID', 'OAUTH_CLIENT_SECRET',
  'DISPLAY_ERRORS']);

error_reporting(-1);
ini_set('display_errors', $_ENV['DISPLAY_ERRORS']);

function turing_db() {
  return new PDO($_ENV['DB_DSN'], $_ENV['DB_USER'], $_ENV['DB_PASSWORD']);
}
