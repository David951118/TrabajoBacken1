<?php
require_once(__DIR__ . '/DBConection.php');
class Platform
{
    private $id;
    private $name;

    public function __construct($idPlatform = null, $namePlatform = null)
    {
        $this->id = $idPlatform;
        $this->name = $namePlatform;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setId($id)
    {
        $this->id = $id;
    }
    public function setName($name)
    {
        $this->name = $name;
    }
    public function getAll()
    {
        $mysqli = DBConection::getConnection();
        $query = $mysqli->query('SELECT * FROM PLATFORMS');
        $listData = [];

        foreach ($query as $item) {
            $itemObject = new Platform($item['id'], $item['name']);
            array_push($listData, $itemObject);

        }
        return $listData;
    }

    public function store()
    {
        $platformCreated = false;
        $mysqli = DBConection::getConnection();

        $stmt = $mysqli->prepare("INSERT INTO PLATFORMS (name) VALUES (?)");
        $stmt->bind_param('s', $this->name);


        $checkStmt = $mysqli->prepare("SELECT id FROM PLATFORMS WHERE name = ?");
        $checkStmt->bind_param('s', $this->name);
        $checkStmt->execute();
        $checkStmt->store_result();
        
        if ($checkStmt->num_rows == 0) {
            if ($stmt->execute()) {
                $platformCreated = true;
                $this->id = $mysqli->insert_id;
            }
        }
        $checkStmt->close();

        $stmt->close();

        return $platformCreated;
    }

    public function update()
    {
        $platformUpdated = false;
        $mysqli = DBConection::getConnection();

        $stmt = $mysqli->prepare("UPDATE PLATFORMS SET name = ? WHERE id = ?");
        $stmt->bind_param('si', $this->name, $this->id);

        if ($stmt->execute()) {
            $platformUpdated = true;
        }

        $stmt->close();

        return $platformUpdated;
    }

    public function delete()
    {
        $platformDeleted = false;
        $mysqli = DBConection::getConnection();

        $stmt = $mysqli->prepare("DELETE FROM PLATFORMS WHERE id = ?");
        $stmt->bind_param('i', $this->id);

        if ($stmt->execute()) {
            $platformDeleted = true;
        }

        $stmt->close();

        return $platformDeleted;
    }
}
?>