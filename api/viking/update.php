<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/api/dao/viking.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/api/utils/server.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/api/viking/service.php';

require_once $_SERVER['DOCUMENT_ROOT'] . '/api/dao/weapon.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/api/weapon/findOne.php';


header('Content-Type: application/json');

if (!methodIsAllowed('create')) {
    returnError(405, 'Method not allowed');
    return;
}

$data = getBody();

if (!isset($_GET['id'])) {
    returnError(400, 'Missing parameter : id');
}

$id = intval($_GET['id']);

if (validateMandatoryParams($data, ['name', 'weaponId', 'health', 'attack', 'defense'])) {
    verifyViking($data);

    if (findOneViking($data['weaponId'])) {

        $updated = updateViking($id, $data['name'], $data['health'], $data['attack'], $data['defense']);
        if ($updated == 1) {
            http_response_code(204);
        } elseif ($updated == 0) {
            returnError(404, 'Viking not found');
        } else {
            returnError(500, 'Could not update the viking');
        }
    } else {
        returnError(400, 'WeaponId does not exist');
    }
} else {
    returnError(412, 'Mandatory parameters : name, health, attack, defense');
}
