<?php
require_once('../../controllers/DirectorController.php');

$sendData = false;
$directorCreated = false;

if (isset($_POST['createBtn'])) {
    $sendData = true;
}

if ($sendData) {
    $firstName = $_POST['first_name'] ?? '';
    $lastName = $_POST['last_name'] ?? '';
    $birthDate = $_POST['birth_date'] ?? '';
    $nationality = $_POST['nationality'] ?? '';

    if (!empty($firstName) && !empty($lastName)) {
        $directorCreated = storeDirector($firstName, $lastName, $birthDate, $nationality);
    }
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Nuevo Director - Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="styles.css">
</head>

<body class="bg-light">
    <?php include '../../views/menu/menu.php'; ?>
    <div class="wrapper">
        <?php include '../../views/sidebar/sidebar.php'; ?>
        <div class="container pb-5 mt-4">
            <div class="row justify-content-center">
                <div class="card shadow-sm">
                    <div class="card-header bg-info text-white">
                        <h4 class="mb-0"><i class="fas fa-user-plus me-2"></i>Nuevo Director(a)</h4>
                    </div>
                    <div class="card-body">
                        <?php if (!$sendData) { ?>
                        <form method="POST" action="create.php">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="first_name" class="form-label fw-bold">Nombre</label>
                                    <input type="text" class="form-control" id="first_name" name="first_name" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="last_name" class="form-label fw-bold">Apellido</label>
                                    <input type="text" class="form-control" id="last_name" name="last_name" required>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="birth_date" class="form-label fw-bold">Fecha de Nacimiento</label>
                                <input type="date" class="form-control" id="birth_date" name="birth_date">
                            </div>
                            <div class="mb-4">
                                <label for="nationality" class="form-label fw-bold">Nacionalidad</label>
                                <input type="text" class="form-control" id="nationality" name="nationality">
                            </div>

                            <div class="d-flex justify-content-end gap-2">
                                <a href="list.php" class="btn btn-secondary">Cancelar</a>
                                <button type="submit" name="createBtn" class="btn btn-info text-white px-4">Guardar</button>
                            </div>
                        </form>
                        <?php } else { ?>
                            <?php if ($directorCreated) { ?>
                                <div class="alert alert-success" role="alert">
                                    Director creado correctamente.<br>
                                    <a href="list.php">Volver al listado de directores.</a>
                                </div>
                            <?php } else { ?>
                                <div class="alert alert-danger" role="alert">
                                    El director no se ha creado correctamente.<br>
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