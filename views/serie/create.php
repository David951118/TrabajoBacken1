<?php
require_once('../../controllers/SerieController.php');
require_once('../../controllers/PlatformController.php');
require_once('../../controllers/DirectorController.php');

$platforms = listPlatforms();
$directors = listDirectors();

$sendData = false;
$serieCreated = false;

if (isset($_POST['createBtn'])) {
    $sendData = true;
}

if ($sendData) {
    $title = $_POST['title'] ?? '';
    $platform_id = $_POST['platform_id'] ?? '';
    $director_id = $_POST['director_id'] ?? '';
    
    if (!empty($title) && !empty($platform_id) && !empty($director_id)) {
        $serieCreated = storeSerie($title, $platform_id, $director_id);
    }
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Nueva Serie - Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="styles.css">
    <style>
        body {
            background-color: #f8f9fa;
        }

        .card {
            border: none;
            shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
        }

        .form-label {
            font-weight: 600;
        }
    </style>
</head>

<body>
    <?php include '../../views/menu/menu.php'; ?>
    <div class="wrapper">
        <?php include '../../views/sidebar/sidebar.php'; ?>
        <div class="container pb-5 mt-4">
            <div class="row justify-content-center">
                <div class="card shadow-sm">
                    <div class="card-header bg-success text-white">
                        <h4 class="mb-0"><i class="fas fa-plus-circle me-2"></i>Crear Nueva Serie</h4>
                    </div>
                    <div class="card-body p-4">
                        <?php if (!$sendData) { ?>
                        <form method="POST" action="create.php">
                            <div class="mb-4">
                                <label for="title" class="form-label">Título de la Serie</label>
                                <input type="text" id="title" name="title" class="form-control form-control-lg"
                                    placeholder="Ej. Stranger Things" required>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-4">
                                    <label for="platform_id" class="form-label">Plataforma</label>
                                    <select class="form-select" id="platform_id" name="platform_id" required>
                                        <option value="" selected disabled>Seleccione una plataforma...</option>
                                        <?php foreach ($platforms as $platform): ?>
                                            <option value="<?php echo $platform->getId(); ?>">
                                                <?php echo htmlspecialchars($platform->getName()); ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="col-md-6 mb-4">
                                    <label for="director_id" class="form-label">Director</label>
                                    <select class="form-select" id="director_id" name="director_id" required>
                                        <option value="" selected disabled>Seleccione un director...</option>
                                        <?php foreach ($directors as $director): ?>
                                            <option value="<?php echo $director->getId(); ?>">
                                                <?php echo htmlspecialchars($director->getFirstName() . ' ' . $director->getLastName()); ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>

                            <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-3">
                                <a href="list.php" class="btn btn-light me-md-2">Cancelar</a>
                                <button type="submit" name="createBtn" class="btn btn-success px-4">Guardar Serie</button>
                            </div>
                        </form>
                        <?php } else { ?>
                            <?php if ($serieCreated) { ?>
                                <div class="alert alert-success" role="alert">
                                    Serie creada correctamente.<br>
                                    <a href="list.php">Volver al listado de series.</a>
                                </div>
                            <?php } else { ?>
                                <div class="alert alert-danger" role="alert">
                                    La serie no se ha creado correctamente.<br>
                                    <a href="create.php">Volver a intentarlo.</a>
                                </div>
                            <?php } ?>
                        <?php } ?>
                    </div>
                </div>

            </div>
        </div>
</body>

</html>