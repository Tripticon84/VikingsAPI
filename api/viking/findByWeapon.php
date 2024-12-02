<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/api/dao/viking.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/api/utils/server.php';

header('Content-Type: application/json');

if (!methodIsAllowed('read')) {
    returnError(405, 'Method not allowed');
    return;
}


$limit = 10;
$offset = 0;
if (isset($_GET['weaponId'])) {
    $weaponId = ($_GET['weaponId']);
}
if (isset($_GET['limit'])) {
    $limit = intval($_GET['limit']);
    if ($limit < 1) {
        returnError(400, 'Limit must be a positive and non zero number');
    }
}
if (isset($_GET['offset'])) {
    $offset = intval($_GET['offset']);
    if ($offset < 0) {
        returnError(400, 'Offset must be a positive number');
    }
}

$vikings = findByWeapon($weaponId, $limit, $offset);

foreach ($vikings as $viking) { 
    $result[] = [
        "name" => $viking['name'],
        "link" => "/viking/findOne.php?id=" . $viking['id']
    ];  
}
echo json_encode($result);