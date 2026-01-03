<?php
require_once('../../controllers/SeriesAudioLanguageController.php');
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $series_id = $_POST['series_id'] ?? null;
    $language_id = $_POST['language_id'] ?? null;
    if ($series_id && $language_id) { deleteSeriesAudioLanguage($series_id, $language_id); }
}
header('Location: list.php');
exit();
?>
