<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/api/dao/viking.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/api/utils/server.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/api/viking/service.php';

header('Content-Type: application/json');

if (!methodIsAllowed('update')) {
    returnError(405, 'Method not allowed');
    return;
}

$data = getBody();

$id = intval($_GET['id']);

if (validateMandatoryParams($data, ['weaponId', 'id'])) {
    $addweapon = addWeapon($data['weaponId'], $data['id']);
    if ($addweapon == 1) {
        http_response_code(204);
    } elseif ($addweapon == 0) {
        returnError(404, 'Weapon not found');
    } else {
        returnError(500, 'Could not update the viking');
    }
} else {
    returnError(400, 'Missing parameters : weaponId / id');
}
