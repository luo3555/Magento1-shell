<?php
define('ROOT_DIR', dirname(dirname(__FILE__)));
require ROOT_DIR . '/vendor/autoload.php';

$dns = [
    'dsn' => 'mysql:dbname=magento_1922;host=127.0.0.1',
    'user' => 'root',
    'password' => '12345abc'
];

$pdo = new Shell\DB($dns);
// foreach ($pdo->getDb()->query('SELECT * FROM eav_entity_type') as $row) {
//         print_r($row);
//         echo PHP_EOL;
// }
// unset($pdo);
try {

$data = [
    'entity_type_id' => 4,
    'attribute_set_name' => 'Test aaabb',
    'sort_order' => 0
];

$attrSet = new Shell\AttribureSet();
$attrSet->init($pdo->getDb());

$insertId = $attrSet->createAttributeSet($data);
// echo $insertId;
$attrSetId = 1;
// $attrSet->setAttributeSetId($attrSetId);
// $attrInfo = $attrSet->getAttrGroupInfo();
// print_r($attrInfo);

$attrInfo = $attrSet->getAttributeEntity($attrSetId);
print_r($attrInfo);

    echo 'Completed' . PHP_EOL;
} catch ( \Exception $e ) {
    echo $e->getMessage() . PHP_EOL;
}


