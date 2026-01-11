<?php
require_once('../../controllers/DirectorController.php');

$id = $_GET['id'] ?? null;
$director = null;

if ($id) {
    $director = getDirector($id);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'] ?? null;
    $firstName = $_POST['first_name'] ?? '';
    $lastName = $_POST['last_name'] ?? '';
    $birthDate = $_POST['birth_date'] ?? '';
    $nationality = $_POST['nationality'] ?? '';

    if (!empty($firstName) && !empty($lastName) && $id) {
        if (updateDirector($id, $firstName, $lastName, $birthDate, $nationality)) {
            header('Location: list.php');
            exit();
        } else {
            $error = "Error al actualizar el director.";
        }
    } else {
        $error = "Nombre y Apellido son obligatorios.";
    }
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Editar Director - Dashboard</title>
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
                        <h4 class="mb-0"><i class="fas fa-edit me-2"></i>Editar Director(a)</h4>
                    </div>
                    <div class="card-body">
                        <?php if (isset($error)): ?>
                            <div class="alert alert-danger"><i
                                    class="fas fa-exclamation-triangle me-2"></i><?php echo $error; ?></div>
                        <?php endif; ?>

                        <?php if ($director): ?>
                            <form method="POST" action="edit.php?id=<?php echo $id; ?>">
                                <input type="hidden" name="id" value="<?php echo $director->getId(); ?>">
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="first_name" class="form-label fw-bold">Nombre</label>
                                        <input type="text" class="form-control" id="first_name" name="first_name"
                                            value="<?php echo htmlspecialchars($director->getFirstName()); ?>" required>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="last_name" class="form-label fw-bold">Apellido</label>
                                        <input type="text" class="form-control" id="last_name" name="last_name"
                                            value="<?php echo htmlspecialchars($director->getLastName()); ?>" required>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="birth_date" class="form-label fw-bold">Fecha de Nacimiento</label>
                                    <input type="date" class="form-control" id="birth_date" name="birth_date"
                                        value="<?php echo htmlspecialchars($director->getBirthDate()); ?>">
                                </div>
                                <div class="mb-4">
                                    <label for="nationality" class="form-label fw-bold">Nacionalidad</label>
                                    <input type="text" class="form-control" id="nationality" name="nationality"
                                        value="<?php echo htmlspecialchars($director->getNationality()); ?>">
                                </div>

                                <div class="d-flex justify-content-end gap-2">
                                    <a href="list.php" class="btn btn-secondary">Cancelar</a>
                                    <button type="submit" class="btn btn-info text-white px-4">Actualizar</button>
                                </div>
                            </form>
                        <?php else: ?>
                            <div class="alert alert-warning">Director no encontrado.</div>
                            <a href="list.php" class="btn btn-secondary">Volver</a>
                        <?php endif; ?>
                    </div>
                </div>

            </div>
        </div>
</body>

</html>