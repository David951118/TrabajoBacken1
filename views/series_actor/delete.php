<?php
require_once('../../controllers/SeriesActorController.php');
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $series_id = $_POST['series_id'] ?? null;
    $actor_id = $_POST['actor_id'] ?? null;
    if ($series_id && $actor_id) { deleteSeriesActor($series_id, $actor_id); }
}
header('Location: list.php');
exit();
?>
