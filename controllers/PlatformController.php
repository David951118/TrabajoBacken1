<?php
require_once(__DIR__ . '/../models/Platform.php');

function listPlatforms()
{
    $model = new Platform();
    $platformList = $model->getAll();
    return $platformList;
}

function getPlatform($id)
{
    $platforms = listPlatforms();
    foreach ($platforms as $platform) {
        if ($platform->getId() == $id) {
            return $platform;
        }
    }
    return null;
}

function storePlatform($platformName)
{
    $newPlatform = new Platform(null, $platformName);
    $platformCreated = $newPlatform->store();
    return $platformCreated ? $newPlatform : false;
}

function updatePlatform($id, $platformName)
{
    $platform = getPlatform($id);
    if ($platform) {
        $platform->setName($platformName);
        return $platform->update();
    }
    return false;
}

function deletePlatform($id)
{
    $platform = getPlatform($id);
    if ($platform) {
        return $platform->delete();
    }
    return false;
}
?>