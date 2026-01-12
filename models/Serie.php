<?php
require_once(__DIR__ . '/DBConection.php');
class Serie
{
    private $id;
    private $title;
    private $platform_id;
    private $director_id;

    public function __construct($id = null, $title = null, $platform_id = null, $director_id = null)
    {
        $this->id = $id;
        $this->title = $title;
        $this->platform_id = $platform_id;
        $this->director_id = $director_id;
    }

    public function getId() { return $this->id; }
    public function getTitle() { return $this->title; }
    public function getPlatformId() { return $this->platform_id; }
    public function getDirectorId() { return $this->director_id; }

    public function setId($id) { $this->id = $id; }
    public function setTitle($title) { $this->title = $title; }
    public function setPlatformId($platform_id) { $this->platform_id = $platform_id; }
    public function setDirectorId($director_id) { $this->director_id = $director_id; }

    public function getAll()
    {
        $mysqli = DBConection::getConnection();
        $query = $mysqli->query('SELECT * FROM series');
        $listData = [];
        foreach ($query as $item) {
            $itemObject = new Serie($item['id'], $item['title'], $item['platform_id'], $item['director_id']);
            array_push($listData, $itemObject);
        }
        return $listData;
    }

    public function store()
    {
        $created = false;
        $mysqli = DBConection::getConnection();

        // Comprobar que no existe otra serie con el mismo titulo antes de crear
        $checkStmt = $mysqli->prepare("SELECT id FROM series WHERE title = ?");
        $checkStmt->bind_param('s', $this->title);
        $checkStmt->execute();
        $checkStmt->store_result();

        if ($checkStmt->num_rows > 0) {
            $checkStmt->close();
            return false;
        }
        $checkStmt->close();

        $stmt = $mysqli->prepare("INSERT INTO series (title, platform_id, director_id) VALUES (?, ?, ?)");
        $stmt->bind_param('sii', $this->title, $this->platform_id, $this->director_id);
        if ($stmt->execute()) {
            $created = true;
            $this->id = $mysqli->insert_id;
        }
        $stmt->close();
        return $created;
    }

    public function update()
    {
        $updated = false;
        $mysqli = DBConection::getConnection();
        $stmt = $mysqli->prepare("UPDATE series SET title = ?, platform_id = ?, director_id = ? WHERE id = ?");
        $stmt->bind_param('siii', $this->title, $this->platform_id, $this->director_id, $this->id);
        if ($stmt->execute()) {
            $updated = true;
        }
        $stmt->close();
        return $updated;
    }

    public function delete()
    {
        $deleted = false;
        $mysqli = DBConection::getConnection();
        $stmt = $mysqli->prepare("DELETE FROM series WHERE id = ?");
        $stmt->bind_param('i', $this->id);
        if ($stmt->execute()) {
            $deleted = true;
        }
        $stmt->close();
        return $deleted;
    }
}
?>