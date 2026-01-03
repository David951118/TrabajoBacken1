<?php
require_once(__DIR__ . '/DBConection.php');
class SeriesSubtitleLanguage
{
    private $series_id;
    private $language_id;

    public function __construct($series_id = null, $language_id = null)
    {
        $this->series_id = $series_id;
        $this->language_id = $language_id;
    }

    public function getSeriesId() { return $this->series_id; }
    public function getLanguageId() { return $this->language_id; }

    public function setSeriesId($series_id) { $this->series_id = $series_id; }
    public function setLanguageId($language_id) { $this->language_id = $language_id; }

    public function getAll()
    {
        $mysqli = DBConection::getConnection();
        $query = $mysqli->query('SELECT * FROM series_subtitle_languages');
        $listData = [];
        foreach ($query as $item) {
            $itemObject = new SeriesSubtitleLanguage($item['series_id'], $item['language_id']);
            array_push($listData, $itemObject);
        }
        return $listData;
    }

    public function store()
    {
        $created = false;
        $mysqli = DBConection::getConnection();
        $stmt = $mysqli->prepare("INSERT INTO series_subtitle_languages (series_id, language_id) VALUES (?, ?)");
        $stmt->bind_param('ii', $this->series_id, $this->language_id);
        if ($stmt->execute()) {
            $created = true;
        }
        $stmt->close();
        return $created;
    }

    public function delete()
    {
        $deleted = false;
        $mysqli = DBConection::getConnection();
        $stmt = $mysqli->prepare("DELETE FROM series_subtitle_languages WHERE series_id = ? AND language_id = ?");
        $stmt->bind_param('ii', $this->series_id, $this->language_id);
        if ($stmt->execute()) {
            $deleted = true;
        }
        $stmt->close();
        return $deleted;
    }
}
?>
