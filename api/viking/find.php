<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/api/dao/viking.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/api/utils/server.php';

header('Content-Type: application/json');

if (!methodIsAllowed('read')) {
    returnError(405, 'Method not allowed');
    return;
}

$name = '';
$limit = 10;
$offset = 0;
if (isset($_GET['name'])) {
    $name = trim($_GET['name']);
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

$vikings = findAllVikings($name, $limit, $offset);

foreach ($vikings as $viking) { 
     
    if ($viking['weaponId']) {
        $result[] = [
            "id" => $viking['id'],
            "name" => $viking['name'],
            "attack" => $viking['attack'],
            "defense" => $viking['defense'],
            "health" => $viking['health'],
            "weapon" => "/weapon/findOne.php?id=".$viking['weaponId']
        ]; 
    }else {
        $result[] = [
            "id" => $viking['id'],
            "name" => $viking['name'],
            "attack" => $viking['attack'],
            "defense" => $viking['defense'],
            "health" => $viking['health'],
            "weapon" => ""
        ];
    }
}
echo json_encode($result);