<?php
require_once('../../controllers/SerieController.php');
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'] ?? null;
    if ($id) { deleteSerie($id); }
}
header('Location: list.php');
exit();
?>
