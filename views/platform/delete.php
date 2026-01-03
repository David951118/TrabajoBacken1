<?php
require_once('../../controllers/PlatformController.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['platformId'] ?? null;

    if ($id) {
        $result = deletePlatform($id);
    }
}

// Redireccionar al listado independientemente del resultado
header('Location: list.php');
exit();
?>