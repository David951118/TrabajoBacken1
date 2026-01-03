<?php
require_once('../../controllers/LanguageController.php');
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'] ?? null;
    if ($id) { deleteLanguage($id); }
}
header('Location: list.php');
exit();
?>
