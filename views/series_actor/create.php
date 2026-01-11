<?php
require_once('../../controllers/SeriesActorController.php');
require_once('../../controllers/SerieController.php');
require_once('../../controllers/ActorController.php');

$series = listSeries();
$actors = listActors();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $series_id = $_POST['series_id'] ?? '';
    $actor_id = $_POST['actor_id'] ?? '';
    if (!empty($series_id) && !empty($actor_id)) {
        $result = storeSeriesActor($series_id, $actor_id);
        if ($result) {
            header('Location: list.php');
            exit();
        } else {
            $error = "Error al asignar el actor. Puede que ya esté asignado.";
        }
    } else {
        $error = "Todos los campos son obligatorios.";
    }
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Asignar Reparto - Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="styles.css">
</head>

<body class="bg-light">
    <?php include '../menu/menu.php'; ?>
    <div class="wrapper">
        <?php include '../sidebar/sidebar.php'; ?>
        <div class="container pb-5 mt-4">
            <div class="row justify-content-center">
                <div class="card shadow">
                    <div class="card-header bg-success text-white">
                        <h4 class="mb-0">Asignar Actor a Serie</h4>
                    </div>
                    <div class="card-body">
                        <?php if (isset($error)): ?>
                            <div class="alert alert-danger"><?php echo $error; ?></div><?php endif; ?>
                        <form method="POST" action="create.php">
                            <div class="mb-3">
                                <label class="form-label">Serie</label>
                                <select name="series_id" class="form-select" required>
                                    <option value="" disabled selected>Seleccione Serie...</option>
                                    <?php foreach ($series as $serie): ?>
                                        <option value="<?php echo $serie->getId(); ?>">
                                            <?php echo htmlspecialchars($serie->getTitle()); ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Actor</label>
                                <select name="actor_id" class="form-select" required>
                                    <option value="" disabled selected>Seleccione Actor...</option>
                                    <?php foreach ($actors as $actor): ?>
                                        <option value="<?php echo $actor->getId(); ?>">
                                            <?php echo htmlspecialchars($actor->getFirstName() . ' ' . $actor->getLastName()); ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="d-flex justify-content-end gap-2">
                                <a href="list.php" class="btn btn-secondary">Cancelar</a>
                                <button type="submit" class="btn btn-success">Asignar</button>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
</body>

</html>