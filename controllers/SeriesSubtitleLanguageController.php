<?php
require_once(__DIR__ . '/../models/SeriesSubtitleLanguage.php');

function listSeriesSubtitleLanguages()
{
    $model = new SeriesSubtitleLanguage();
    return $model->getAll();
}

function getSeriesSubtitleLanguage($series_id, $language_id)
{
    $list = listSeriesSubtitleLanguages();
    foreach ($list as $item) {
        if ($item->getSeriesId() == $series_id && $item->getLanguageId() == $language_id) return $item;
    }
    return null;
}

function storeSeriesSubtitleLanguage($series_id, $language_id)
{
    $new = new SeriesSubtitleLanguage($series_id, $language_id);
    return $new->store() ? $new : false;
}

function deleteSeriesSubtitleLanguage($series_id, $language_id)
{
    $item = getSeriesSubtitleLanguage($series_id, $language_id);
    if ($item) return $item->delete();
    return false;
}
?>
