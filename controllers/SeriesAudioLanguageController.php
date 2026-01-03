<?php
require_once(__DIR__ . '/../models/SeriesAudioLanguage.php');

function listSeriesAudioLanguages()
{
    $model = new SeriesAudioLanguage();
    return $model->getAll();
}

function getSeriesAudioLanguage($series_id, $language_id)
{
    $list = listSeriesAudioLanguages();
    foreach ($list as $item) {
        if ($item->getSeriesId() == $series_id && $item->getLanguageId() == $language_id) return $item;
    }
    return null;
}

function storeSeriesAudioLanguage($series_id, $language_id)
{
    $new = new SeriesAudioLanguage($series_id, $language_id);
    return $new->store() ? $new : false;
}

function deleteSeriesAudioLanguage($series_id, $language_id)
{
    $item = getSeriesAudioLanguage($series_id, $language_id);
    if ($item) return $item->delete();
    return false;
}
?>
