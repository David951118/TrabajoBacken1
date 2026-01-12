<?php
require_once(__DIR__ . '/DBConection.php');
class Language
{
    private $id;
    private $name;
    private $iso_code;

    public function __construct($id = null, $name = null, $iso_code = null)
    {
        $this->id = $id;
        $this->name = $name;
        $this->iso_code = $iso_code;
    }

    public function getId() { return $this->id; }
    public function getName() { return $this->name; }
    public function getIsoCode() { return $this->iso_code; }

    public function setId($id) { $this->id = $id; }
    public function setName($name) { $this->name = $name; }
    public function setIsoCode($iso_code) { $this->iso_code = $iso_code; }

    public function getAll()
    {
        $mysqli = DBConection::getConnection();
        $query = $mysqli->query('SELECT * FROM languages');
        $listData = [];
        foreach ($query as $item) {
            $itemObject = new Language($item['id'], $item['name'], $item['iso_code']);
            array_push($listData, $itemObject);
        }
        return $listData;
    }

    public function store()
    {
        $created = false;
        $mysqli = DBConection::getConnection();

        // Comprobar si existe idioma con mismo nombre O mismo codigo ISO
        $checkStmt = $mysqli->prepare("SELECT id FROM languages WHERE name = ? OR iso_code = ?");
        $checkStmt->bind_param('ss', $this->name, $this->iso_code);
        $checkStmt->execute();
        $checkStmt->store_result();

        if ($checkStmt->num_rows > 0) {
            $checkStmt->close();
            return false;
        }
        $checkStmt->close();

        $stmt = $mysqli->prepare("INSERT INTO languages (name, iso_code) VALUES (?, ?)");
        $stmt->bind_param('ss', $this->name, $this->iso_code);
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
        $stmt = $mysqli->prepare("UPDATE languages SET name = ?, iso_code = ? WHERE id = ?");
        $stmt->bind_param('ssi', $this->name, $this->iso_code, $this->id);
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
        $stmt = $mysqli->prepare("DELETE FROM languages WHERE id = ?");
        $stmt->bind_param('i', $this->id);
        if ($stmt->execute()) {
            $deleted = true;
        }
        $stmt->close();
        return $deleted;
    }
}
?>
