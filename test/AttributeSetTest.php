<?php
define('ROOT_DIR', dirname(dirname(__FILE__)));
require ROOT_DIR . '/vendor/autoload.php';

$dns = [
    'dsn' => 'mysql:dbname=magento_1922;host=127.0.0.1',
    'user' => 'root',
    'password' => '12345abc'
];

$pdo = new Shell\DB($dns);
foreach ($pdo->getDb()->query('SELECT * FROM eav_entity_type') as $row) {
        print_r($row);
        echo PHP_EOL;
}
unset($pdo);
