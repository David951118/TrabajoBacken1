<?php
require_once(__DIR__ . '/../models/SeriesActor.php');

function listSeriesActors()
{
    $model = new SeriesActor();
    return $model->getAll();
}

function getSeriesActor($series_id, $actor_id)
{
    $list = listSeriesActors();
    foreach ($list as $item) {
        if ($item->getSeriesId() == $series_id && $item->getActorId() == $actor_id) return $item;
    }
    return null;
}

function storeSeriesActor($series_id, $actor_id)
{
    $new = new SeriesActor($series_id, $actor_id);
    return $new->store() ? $new : false;
}

function deleteSeriesActor($series_id, $actor_id)
{
    $item = getSeriesActor($series_id, $actor_id);
    if ($item) return $item->delete();
    return false;
}
?>
