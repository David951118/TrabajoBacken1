<?php
require_once(__DIR__ . '/DBConection.php');
class Director
{
    private $id;
    private $first_name;
    private $last_name;
    private $birth_date;
    private $nationality;

    public function __construct($id = null, $first_name = null, $last_name = null, $birth_date = null, $nationality = null)
    {
        $this->id = $id;
        $this->first_name = $first_name;
        $this->last_name = $last_name;
        $this->birth_date = $birth_date;
        $this->nationality = $nationality;
    }

    public function getId() { return $this->id; }
    public function getFirstName() { return $this->first_name; }
    public function getLastName() { return $this->last_name; }
    public function getBirthDate() { return $this->birth_date; }
    public function getNationality() { return $this->nationality; }

    public function setId($id) { $this->id = $id; }
    public function setFirstName($first_name) { $this->first_name = $first_name; }
    public function setLastName($last_name) { $this->last_name = $last_name; }
    public function setBirthDate($birth_date) { $this->birth_date = $birth_date; }
    public function setNationality($nationality) { $this->nationality = $nationality; }

    public function getAll()
    {
        $mysqli = DBConection::getConnection();
        $query = $mysqli->query('SELECT * FROM directors');
        $listData = [];
        foreach ($query as $item) {
            $itemObject = new Director($item['id'], $item['first_name'], $item['last_name'], $item['birth_date'], $item['nationality']);
            array_push($listData, $itemObject);
        }
        return $listData;
    }

    public function store()
    {
        $created = false;
        $mysqli = DBConection::getConnection();
        $stmt = $mysqli->prepare("INSERT INTO directors (first_name, last_name, birth_date, nationality) VALUES (?, ?, ?, ?)");
        $stmt->bind_param('ssss', $this->first_name, $this->last_name, $this->birth_date, $this->nationality);
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
        $stmt = $mysqli->prepare("UPDATE directors SET first_name = ?, last_name = ?, birth_date = ?, nationality = ? WHERE id = ?");
        $stmt->bind_param('ssssi', $this->first_name, $this->last_name, $this->birth_date, $this->nationality, $this->id);
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
        $stmt = $mysqli->prepare("DELETE FROM directors WHERE id = ?");
        $stmt->bind_param('i', $this->id);
        if ($stmt->execute()) {
            $deleted = true;
        }
        $stmt->close();
        return $deleted;
    }
}
?>
