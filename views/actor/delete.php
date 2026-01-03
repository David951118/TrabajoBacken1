<?php
require_once('../../controllers/ActorController.php');
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'] ?? null;
    if ($id) { deleteActor($id); }
}
header('Location: list.php');
exit();
?>
