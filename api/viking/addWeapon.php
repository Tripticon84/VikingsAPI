<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/api/dao/viking.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/api/utils/server.php';

if (!methodIsAllowed('update')) {
    returnError(405, 'Method not allowed');
    return;
}

if (isset($_GET['weaponId']) || isset($_GET['id'])) {
    $addweapon = addWeapon($_GET['weaponId'],$_GET['id']);
    if ($addweapon == 1) {
        http_response_code(204);
    }elseif ($deleted == 0) {
    returnError(404, 'weapon not found');
    }else {
    returnError(500, 'Could not update the viking');
    }
}else{
    returnError(400, 'Missing parameters : weaponId / id');
}

