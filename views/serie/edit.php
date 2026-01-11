<?php
require_once('../../controllers/SerieController.php');
require_once('../../controllers/PlatformController.php');
require_once('../../controllers/DirectorController.php');

$id = $_GET['id'] ?? null;
$item = null;
if ($id) {
    $item = getSerie($id);
}
if (!$item && $_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: list.php');
    exit();
}

$platforms = listPlatforms();
$directors = listDirectors();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'] ?? null;
    $title = $_POST['title'] ?? '';
    $platform_id = $_POST['platform_id'] ?? '';
    $director_id = $_POST['director_id'] ?? '';

    if ($id && !empty($title) && !empty($platform_id) && !empty($director_id)) {
        $result = updateSerie($id, $title, $platform_id, $director_id);
        if ($result) {
            header('Location: list.php');
            exit();
        } else {
            $error = "Error al actualizar.";
            $item = getSerie($id);
        } // Refetch to prevent data loss on error
    } else {
        $error = "Todos los campos son obligatorios.";
        $item = getSerie($id);
    }
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Editar Serie - Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="styles.css">
    <style>
        body {
            background-color: #f8f9fa;
        }
    </style>
</head>

<body>
    <?php include '../menu/menu.php'; ?>
    <div class="wrapper">
        <?php include '../../views/sidebar/sidebar.php'; ?>
        <div class="container pb-5 mt-4">
            <div class="row justify-content-center">
                <div class="card shadow-sm">
                    <div class="card-header bg-success text-white">
                        <h4 class="mb-0"><i class="fas fa-edit me-2"></i>Editar Serie</h4>
                    </div>
                    <div class="card-body p-4">
                        <?php if (isset($error)): ?>
                            <div class="alert alert-danger"><?php echo $error; ?></div><?php endif; ?>

                        <form method="POST" action="edit.php?id=<?php echo $id; ?>">
                            <input type="hidden" name="id" value="<?php echo $item->getId(); ?>">

                            <div class="mb-4">
                                <label for="title" class="form-label">Título</label>
                                <input type="text" id="title" name="title" class="form-control"
                                    value="<?php echo htmlspecialchars($item->getTitle()); ?>" required>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-4">
                                    <label for="platform_id" class="form-label">Plataforma</label>
                                    <select class="form-select" id="platform_id" name="platform_id" required>
                                        <?php foreach ($platforms as $platform): ?>
                                            <option value="<?php echo $platform->getId(); ?>" <?php echo ($platform->getId() == $item->getPlatformId()) ? 'selected' : ''; ?>>
                                                <?php echo htmlspecialchars($platform->getName()); ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="col-md-6 mb-4">
                                    <label for="director_id" class="form-label">Director</label>
                                    <select class="form-select" id="director_id" name="director_id" required>
                                        <?php foreach ($directors as $director): ?>
                                            <option value="<?php echo $director->getId(); ?>" <?php echo ($director->getId() == $item->getDirectorId()) ? 'selected' : ''; ?>>
                                                <?php echo htmlspecialchars($director->getFirstName() . ' ' . $director->getLastName()); ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>

                            <div class="d-flex justify-content-end gap-2">
                                <a href="list.php" class="btn btn-light">Cancelar</a>
                                <button type="submit" class="btn btn-success">Actualizar Serie</button>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
</body>

</html>