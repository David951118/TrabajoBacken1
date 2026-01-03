<?php
require_once(__DIR__ . '/DBConection.php');
class SeriesActor
{
    private $series_id;
    private $actor_id;

    public function __construct($series_id = null, $actor_id = null)
    {
        $this->series_id = $series_id;
        $this->actor_id = $actor_id;
    }

    public function getSeriesId() { return $this->series_id; }
    public function getActorId() { return $this->actor_id; }

    public function setSeriesId($series_id) { $this->series_id = $series_id; }
    public function setActorId($actor_id) { $this->actor_id = $actor_id; }

    public function getAll()
    {
        $mysqli = DBConection::getConnection();
        $query = $mysqli->query('SELECT * FROM series_actors');
        $listData = [];
        foreach ($query as $item) {
            $itemObject = new SeriesActor($item['series_id'], $item['actor_id']);
            array_push($listData, $itemObject);
        }
        return $listData;
    }

    public function store()
    {
        $created = false;
        $mysqli = DBConection::getConnection();
        $stmt = $mysqli->prepare("INSERT INTO series_actors (series_id, actor_id) VALUES (?, ?)");
        $stmt->bind_param('ii', $this->series_id, $this->actor_id);
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
        $stmt = $mysqli->prepare("DELETE FROM series_actors WHERE series_id = ? AND actor_id = ?");
        $stmt->bind_param('ii', $this->series_id, $this->actor_id);
        if ($stmt->execute()) {
            $deleted = true;
        }
        $stmt->close();
        return $deleted;
    }
}
?>
