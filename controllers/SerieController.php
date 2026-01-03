<?php
require_once(__DIR__ . '/../models/Serie.php');

function listSeries()
{
    $model = new Serie();
    return $model->getAll();
}

function getSerie($id)
{
    $list = listSeries();
    foreach ($list as $item) {
        if ($item->getId() == $id) return $item;
    }
    return null;
}

function storeSerie($title, $platform_id, $director_id)
{
    $new = new Serie(null, $title, $platform_id, $director_id);
    return $new->store() ? $new : false;
}

function updateSerie($id, $title, $platform_id, $director_id)
{
    $serie = getSerie($id);
    if ($serie) {
        $serie->setTitle($title);
        $serie->setPlatformId($platform_id);
        $serie->setDirectorId($director_id);
        return $serie->update();
    }
    return false;
}

function deleteSerie($id)
{
    $serie = getSerie($id);
    if ($serie) return $serie->delete();
    return false;
}
?>
