<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/api/dao/viking.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/api/utils/server.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/api/viking/service.php';

require_once $_SERVER['DOCUMENT_ROOT'] . '/api/dao/weapon.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/api/weapon/findOne.php.php';


header('Content-Type: application/json');

if (!methodIsAllowed('create')) {
    returnError(405, 'Method not allowed');
    return;
}

$data = getBody();

if (validateMandatoryParams($data, ['name', 'weaponId', 'health', 'attack', 'defense'])) {
    verifyViking($data);

    if (findOneWeapon($data['weaponId'])) {

        $newVikingId = createViking($data['name'], $data['weaponId'], $data['health'], $data['attack'], $data['defense']);
        if (!$newVikingId) {
            returnError(500, 'Could not create the viking');
        }
        echo json_encode(['id' => $newVikingId]);
        http_response_code(201);
    } else {
        returnError(400, 'WeaponId does not exist');
    }
} else {
    returnError(412, 'Mandatory parameters : name, health, attack, defense');
}
